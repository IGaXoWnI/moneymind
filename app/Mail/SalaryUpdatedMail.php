<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class SalaryUpdatedMail extends Mailable
{
    public function __construct(public $amount) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Salary Credit Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.salary-updated',
            with: [
                'amount' => $this->amount,
            ],
        );
    }
}
