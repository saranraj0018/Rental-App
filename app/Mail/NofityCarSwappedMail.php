<?php

namespace App\Mail;

use App\Models\AdminDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NofityCarSwappedMail extends Mailable {
    use Queueable, SerializesModels;

    public $booking;
    public $admin;

    /**
     * Create a new message instance.
     */
    public function __construct($booking) {
        $this->booking = $booking;
        $this->admin = AdminDetail::where('role', '=', 1)->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Car Swapped for Booking',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content {
        return new Content(
            view: 'admin.swap-cars.swap-mail',
            with: [
                'admin' => $this->admin,
                'booking' => $this->booking,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array {
        return [];
    }
}
