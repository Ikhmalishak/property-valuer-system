<?php

namespace App\Console\Commands;

use Illuminate\Console\Command; 
use App\Models\Invoice;
use Carbon\Carbon;

class SendInvoiceReminders extends Command
{
    protected $signature = 'invoices:send-reminders';
    protected $description = 'Send invoice reminders based on reminder frequency';

    public function handle()
{
    $now = Carbon::now();

    // Fetch all unpaid invoices with bi-weekly frequency
    $invoices = Invoice::where('status', '!=', 'paid')
        ->where('reminder_frequency', 'bi-weekly')
        ->get();

    foreach ($invoices as $invoice) {
        $lastSent = $invoice->due_date ?? $invoice->issued_date;
        $lastSent = Carbon::parse($lastSent);

        // Check if 14 days have passed since last reminder (or initial due/issue date)
        if ($now->diffInDays($lastSent) < 14) {
            continue;
        }

        // Optional: Add buffer to avoid multiple sends in one day
        if ($invoice->last_reminder_sent_at) {
            $lastReminder = Carbon::parse($invoice->last_reminder_sent_at);
            if ($now->diffInDays($lastReminder) < 14) {
                continue;
            }
        }

        // Determine which file will be used
        $filePathField = match (true) {
            $invoice->reminders_sent_count === 0 => 'file_path',
            $invoice->reminders_sent_count === 1 => 'file_path2',
            $invoice->reminders_sent_count >= 2 => 'file_path3',
            default => 'file_path',
        };

        // Make sure the file exists before sending
        if (!$invoice->{$filePathField}) {
            $this->warn("No file found for reminder {$invoice->reminders_sent_count} on Invoice ID {$invoice->id}");
            continue;
        }

        // Send reminder
        $invoice->client->notify(new \App\Notifications\InvoiceReminder($invoice)); // This should use notify() with InvoiceReminder

        // Increment reminder count
        $invoice->increment('reminders_sent_count');

        // Optional: update last reminder timestamp
        $invoice->last_reminder_sent_at = $now;
        $invoice->save();

        $this->info("Reminder #{$invoice->reminders_sent_count} sent to Invoice ID {$invoice->id} with {$filePathField}");
    }

    return self::SUCCESS;
}
}

