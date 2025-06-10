<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceNotification extends Notification
{
    use Queueable;

    public $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Invoice for ' . $this->payment->service->name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Thank you for your purchase.')
            ->line('Service: ' . $this->payment->service->name)
            ->line('Amount: RM ' . number_format($this->payment->amount, 2))
            ->line('Payment Method: ' . strtoupper($this->payment->payment_method))
            ->line('Status: ' . ucfirst($this->payment->status))
            ->line('Date: ' . $this->payment->created_at->format('d M Y, h:i A'))
            ->line('Reference: ' . $this->payment->gateway_reference)
            ->line('We appreciate your business!');
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
