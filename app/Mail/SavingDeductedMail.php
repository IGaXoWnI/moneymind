<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class SavingDeductedMail extends Mailable
{
    public function __construct(public $amount) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Saving Amount Deducted',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.saving-deducted',
            with: [
                'amount' => $this->amount,
            ],
        );
    }
}
