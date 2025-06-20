<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $user, public $invoice) {}

    /**
     * Get the envelope for the message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Reminder',
        );
    }

    /**
     * Get the content represented as a mail view.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.test-email',
            with: [
                'user' => $this->user,
                'invoice' => $this->invoice,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
