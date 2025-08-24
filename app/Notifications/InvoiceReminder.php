<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceReminder extends Notification
{
    use Queueable;

    public $invoice;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
public function toMail(object $notifiable): MailMessage
{
    $invoice = $this->invoice;
    $currentFilePath = $invoice->getCurrentInvoiceFilePath();

    // Format amount (adjust field name if needed)
    $amount = 'RM ' . number_format($invoice->amount, 2); // e.g., $invoice->total

    // Generate URL to view invoice
    $url = asset('storage/' . $currentFilePath);

    return (new MailMessage)
        ->subject("Peringatan Invois: {$invoice->invoice_number}")
        ->view('emails.test-email', [
            'invoice' => $invoice,
            'amount' => $amount,
            'url' => $url,
        ])
        ->attach(storage_path('app/public/' . $currentFilePath))
        ->attach(storage_path('app/public/' . $invoice->property->file_path));
}
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}