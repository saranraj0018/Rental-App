<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingDetails , $_name;

    /**
     * Create a new message instance.
     */
    public function __construct($_name, $bookingDetails)
    {
        $this->bookingDetails = $bookingDetails;
        $this->_name = $_name;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmed',
        );
    }

    public function build()
    {
        return $this->subject('Booking Confirmation')
            ->view('emails.booking_confirmation')
            ->with('bookingDetails', $this->bookingDetails);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user.frontpage.booking.mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
