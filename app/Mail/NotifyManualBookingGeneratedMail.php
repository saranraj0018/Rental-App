<?php

namespace App\Mail;

use App\Models\AdminDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyManualBookingGeneratedMail extends Mailable {
    use Queueable, SerializesModels;

    public $user;
    public $admin;

    /**
     * Create a new message instance.
     */
    public function __construct(string $user) {
        $this->admin = auth('admin')->user()->name;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Manual Booking Created by Admin',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content {
        return new Content(
            view: 'admin.hub.booking-generated-mail',
            with: [
                'admin' => $this->admin,
                'user' => $this->user,
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
