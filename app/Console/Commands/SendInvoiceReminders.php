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

        $invoices = Invoice::where('status', '!=', 'paid')->get();

        foreach ($invoices as $invoice) {
            $lastSent = $invoice->last_reminder_sent ?? $invoice->issued_date;
            $shouldSend = false;

            switch ($invoice->reminder_frequency) {
                case 'weekly':
                    // Send on Fridays, at least 7 days since last reminder
                    if ($now->isFriday() && $now->diffInDays($lastSent) >= 7) {
                        $shouldSend = true;
                    }
                    break;

                case 'monthly':
                    // Send on 1st or last day of month, and at least 28 days since last reminder
                    if (
                        ($now->isSameDay($now->copy()->startOfMonth()) || $now->isSameDay($now->copy()->endOfMonth()))
                        && $now->diffInDays($lastSent) >= 28
                    ) {
                        $shouldSend = true;
                    }
                    break;

                default:
                    // 'none' or any other value: skip
                    break;
            }

            if ($shouldSend) {
                $invoice->sendReminder(); // calls method in your model
                $this->info("Reminder sent to Invoice ID {$invoice->id}");
            }
        }

        return self::SUCCESS;
    }
}

