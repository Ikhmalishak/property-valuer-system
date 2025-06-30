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
        //set current date and time
        $now = Carbon::now();

        // Fetch all unpaid invoices
        $invoices = Invoice::where('status', '!=', 'paid')->get();

        foreach ($invoices as $invoice) {
            $lastSent = $invoice->last_reminder_sent ?? $invoice->issued_date;
            $shouldSend = false;

            switch ($invoice->reminder_frequency) {
                case 'weekly':
                    // Send on Fridays, at least 7 days since last reminder
                    if ($now->diffInDays($lastSent,true) >= 7) {
                        $shouldSend = true;
                    }
                    break;

                case 'monthly':
                    // Send on 30 days after last reminder
                    if ($now->diffInDays($lastSent) >= 30)
                    {
                        $shouldSend = true;
                    }
                    break;

                default:
                    // 'none' or any other value: skip
                    break;
            }

            if ($shouldSend) {
                $invoice->sendRecurringReminder(); // calls method in your model
                $this->info("Reminder sent to Invoice ID {$invoice->id}");
            }
        }

        return self::SUCCESS;
    }
}

