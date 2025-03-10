<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class WishlistDeductedMail extends Mailable
{
    public function __construct(public $wishlist, public $amount) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Wishlist Contribution Deducted',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.wishlist-deducted',
            with: [
                'wishlist' => $this->wishlist,
                'amount' => $this->amount,
            ],
        );
    }
}
