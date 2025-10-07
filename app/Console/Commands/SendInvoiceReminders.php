<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendInvoiceReminders extends Command
{
    protected $signature = 'invoices:send-reminders';
    protected $description = 'Send invoice reminders based on invoice reminder_frequency (1 minute, 7/14/30 days)';

    public function handle()
    {
        $now = Carbon::now();
        $testMinutes = (int) env('REMINDER_TEST_MINUTES', 0);
        Log::info('[Reminders] Scheduler tick', [
            'now' => $now->toDateTimeString(),
            'timezone' => config('app.timezone'),
            'env' => app()->environment(),
            'REMINDER_TEST_MINUTES' => $testMinutes,
        ]);

        // Fetch unpaid invoices with supported frequencies
        $supported = ['1_minute', '7_days', '14_days', '30_days'];
        $invoices = Invoice::where('status', '!=', 'paid')
            ->whereIn('reminder_frequency', $supported)
            ->with('client') // Prevent lazy loading issues
            ->get();
        Log::info('[Reminders] Eligible query result', [
            'count' => $invoices->count(),
        ]);

        $this->info(" Found " . $invoices->count() . " eligible invoices.");

        foreach ($invoices as $invoice) {
            Log::info('[Reminders] Inspecting invoice', [
                'invoice_id' => $invoice->invoice_id ?? $invoice->id ?? null,
                'status' => $invoice->status,
                'due_date' => optional($invoice->due_date)->toDateTimeString(),
                'issued_date' => optional($invoice->issued_date)->toDateTimeString(),
                'last_reminder_sent_at' => optional($invoice->last_reminder_sent_at)->toDateTimeString(),
                'reminder_frequency' => $invoice-> reminder_frequency,
                'file_path' => $invoice->file_path,
            ]);
            // Skip if due date has already passed
            if ($invoice->due_date < $now) {
                $this->comment(" Skipped Invoice #{$invoice->invoice_id}: Due date has passed.");
                Log::info('[Reminders] Skip: past due date', [
                    'invoice_id' => $invoice->invoice_id,
                    'now' => $now->toDateTimeString(),
                    'due_date' => $invoice->due_date->toDateTimeString(),
                ]);
                continue;
            }

            // Base date: issued_date or created_at
            $baseDate = Carbon::parse($invoice->issued_date ?? $invoice->created_at);

            // Use last_reminder_sent_at if exists, otherwise fall back to base date
            $anchor = $invoice->last_reminder_sent_at ? Carbon::parse($invoice->last_reminder_sent_at) : $baseDate;

            // Option A cutoff: reminders stop after due_date passes
            $stopAt = Carbon::parse($invoice->due_date);

            // Compute next due by frequency
            $nextDue = match ($invoice->reminder_frequency) {
                '1_minute' => $anchor->copy()->addMinutes(1),
                '7_days' => $anchor->copy()->addDays(7),
                '14_days' => $anchor->copy()->addDays(14),
                '30_days' => $anchor->copy()->addDays(30),
                default => $anchor->copy()->addDays(14),
            };

            // Optional test override: allow minute-based threshold via .env REMINDER_TEST_MINUTES
            if ($testMinutes > 0) {
                $elapsedMins = $now->diffInMinutes($anchor, true);
                if ($elapsedMins < $testMinutes) {
                    $target = $anchor->copy()->addMinutes($testMinutes);
                    $remainingSeconds = $now->diffInSeconds($target, false);
                    $stopRemaining = $now->diffInSeconds($stopAt, false);
                    $this->comment(
                        " Test mode: Skipped Invoice #{$invoice->invoice_id}: {$elapsedMins}/{$testMinutes} minute(s) passed. Next due at "
                        . $target->toDateTimeString() . ' (' . $this->formatSeconds(max(0, $remainingSeconds)) . '). '
                        . 'Reminders stop at ' . $stopAt->toDateTimeString() . ' (in ' . $this->formatSeconds(max(0, $stopRemaining)) . ').'
                    );
                    Log::info('[Reminders] Test skip: minutes threshold not met', [
                        'invoice_id' => $invoice->invoice_id,
                        'elapsed_minutes' => $elapsedMins,
                        'required_minutes' => $testMinutes,
                        'anchor' => $anchor->toDateTimeString(),
                        'next_due' => $target->toDateTimeString(),
                        'remaining_seconds' => max(0, $remainingSeconds),
                        'stop_at' => $stopAt->toDateTimeString(),
                        'stop_remaining_seconds' => max(0, $stopRemaining),
                    ]);
                    continue;
                }
            } else {
                if ($now->lt($nextDue)) {
                    $remainingSeconds = $now->diffInSeconds($nextDue, false);
                    $stopRemaining = $now->diffInSeconds($stopAt, false);
                    $this->comment(
                        " Skipped Invoice #{$invoice->invoice_id}: Next due at {$nextDue->toDateTimeString()} (in "
                        . $this->formatSeconds(max(0, $remainingSeconds)) . '). '
                        . 'Reminders stop at ' . $stopAt->toDateTimeString() . ' (in ' . $this->formatSeconds(max(0, $stopRemaining)) . ').'
                    );
                    Log::info('[Reminders] Prod skip: next due not reached', [
                        'invoice_id' => $invoice->invoice_id,
                        'now' => $now->toDateTimeString(),
                        'next_due' => $nextDue->toDateTimeString(),
                        'frequency' => $invoice->reminder_frequency,
                        'remaining_seconds' => max(0, $remainingSeconds),
                        'stop_at' => $stopAt->toDateTimeString(),
                        'stop_remaining_seconds' => max(0, $stopRemaining),
                    ]);
                    continue;
                }
            }

            // Same-day guard: avoid duplicate send within the same calendar day
            // Allow multiple sends per day only for the 1-minute testing frequency
            if (
                $invoice->reminder_frequency !== '1_minute'
                && $invoice->last_reminder_sent_at
                && Carbon::parse($invoice->last_reminder_sent_at)->isSameDay($now)
            ) {
                $this->comment(" Skipped Invoice #{$invoice->invoice_id}: Already sent today.");
                Log::info('[Reminders] Skip: already sent today', [
                    'invoice_id' => $invoice->invoice_id,
                    'last_reminder_sent_at' => Carbon::parse($invoice->last_reminder_sent_at)->toDateTimeString(),
                ]);
                continue;
            }

            // Always use the original invoice file (file_path)
            if (!$invoice->file_path) {
                $this->warn(" Missing original invoice file (file_path) for Invoice #{$invoice->invoice_id}");
                Log::warning('[Reminders] Skip: no file_path', [
                    'invoice_id' => $invoice->invoice_id,
                ]);
                continue;
            }

            // Verify file exists on disk
            $fullPath = storage_path('app/public/' . $invoice->file_path);
            if (!file_exists($fullPath)) {
                $this->warn(" File not found on disk: {$fullPath}");
                Log::warning('[Reminders] Skip: file not found', [
                    'invoice_id' => $invoice->invoice_id,
                    'path' => $fullPath,
                ]);
                continue;
            }

            // Send the reminder notification
            try {
                if (!$invoice->client || !$invoice->client->email) {
                    $this->warn(" No valid client email for Invoice #{$invoice->invoice_id}");
                    continue;
                }
                $invoice->client->notify(new \App\Notifications\InvoiceReminder($invoice));
                $reminderNumber = $invoice->reminders_sent_count + 1;
                $this->info(" Reminder #{$reminderNumber} sent to Invoice #{$invoice->invoice_id}");
                Log::info('[Reminders] Sent notification', [
                    'invoice_id' => $invoice->invoice_id,
                    'reminder_number' => $reminderNumber,
                ]);
            } catch (\Exception $e) {
                $this->error(" Failed to send notification for Invoice #{$invoice->invoice_id}: " . $e->getMessage());
                Log::error('[Reminders] Error sending notification', [
                    'invoice_id' => $invoice->invoice_id,
                    'error' => $e->getMessage(),
                ]);
                continue;
            }

            // Increment counter and save timestamp, mark as sent
            $invoice->increment('reminders_sent_count');
            $invoice->is_reminder_sent = true;
            $invoice->last_reminder_sent_at = $now;
            $invoice->save();
            Log::info('[Reminders] Invoice updated', [
                'invoice_id' => $invoice->invoice_id,
                'reminders_sent_count' => $invoice->reminders_sent_count,
                'last_reminder_sent_at' => $now->toDateTimeString(),
            ]);

            $this->info(" Updated: reminders_sent_count = {$invoice->reminders_sent_count}");

            // Show when the next eligible send will be for visibility
            $nextAfterSend = match ($invoice->reminder_frequency) {
                '1_minute' => $now->copy()->addMinutes(1),
                '7_days' => $now->copy()->addDays(7),
                '14_days' => $now->copy()->addDays(14),
                '30_days' => $now->copy()->addDays(30),
                default => $now->copy()->addDays(14),
            };
            $remainingSecondsAfter = $now->diffInSeconds($nextAfterSend, false);
            $stopRemainingAfter = $now->diffInSeconds($stopAt, false);
            $this->comment(
                ' Next eligible at ' . $nextAfterSend->toDateTimeString()
                . ' (in ' . $this->formatSeconds(max(0, $remainingSecondsAfter)) . '). '
                . 'Reminders stop at ' . $stopAt->toDateTimeString() . ' (in ' . $this->formatSeconds(max(0, $stopRemainingAfter)) . ').'
            );
        }
        $this->info(' Invoice reminder check completed.');
        Log::info('[Reminders] Cycle complete');
        return self::SUCCESS;
    }

    /**
     * Format seconds into a concise h/m/s string (e.g., "1h 2m 3s").
     */
    private function formatSeconds(int $seconds): string
    {
        if ($seconds < 0) {
            $seconds = 0;
        }
        $h = intdiv($seconds, 3600);
        $seconds %= 3600;
        $m = intdiv($seconds, 60);
        $s = $seconds % 60;

        $parts = [];
        if ($h > 0) $parts[] = $h . 'h';
        if ($m > 0) $parts[] = $m . 'm';
        if ($s > 0 || empty($parts)) $parts[] = $s . 's';
        return implode(' ', $parts);
    }
}
