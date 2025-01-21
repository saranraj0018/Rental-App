<?php

namespace App\Message;

use App\Contracts\Message;
use App\Models\Booking;

class BookingCancelledMessage implements Message {




    public function __construct(public Booking $booking) {
    }



    /**
     * Template ID for Login
     * @return string
     */
    public function template(): string {
        return '1707173736750603417';
    }




    /**
     * Message Template for OTP
     * @param mixed $dataset
     * @return string
     */
    public function message(): string {

        $_name = ucfirst($this->booking->user->name);
        $_id = $this->booking->booking_id;
        $_drop = $this->booking->location()->dropoff;
        $_from = $this->booking->start_date;
        $_car = $this->booking?->Car?->modal_name;

        return "Dear $_name, Your booking with Valam Cars has been successfully canceled. Your refund will be automatically processed to your payment source within 5-7 working days. Booking ID: $_id If this cancellation was a mistake or you wish to rebook, please visit our website or contact customer support. We look forward to serving you in the future! Valam Cars Team";
    }
}

