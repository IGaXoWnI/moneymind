<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class SubscriptionDeductedMail extends Mailable
{
    public function __construct(public $expense) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscription Payment Deducted',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription-deducted',
            with: [
                'expense' => $this->expense,
            ],
        );
    }
}
