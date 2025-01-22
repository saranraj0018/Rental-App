<?php

namespace App\Message;

use App\Contracts\Message;
use App\Models\Booking;

class BookingConfirmedMessage implements Message {




    public function __construct(public Booking $booking) {
    }



    /**
     * Template ID for Login
     * @return string
     */
    public function template(): string {
        return '1707173736742742190';
    }




    /**
     * Message Template for OTP
     * @param mixed $dataset
     * @return string
     */
    public function message(): string {

        $_name = ucfirst($this->booking->user->name);
        $_id = $this->booking->booking_id;
        $_from = $this->booking->start_date;
        $_to = $this->booking->end_date;
        $_car = $this->booking?->Car?->CarDetails?->model_name;

        return "Dear $_name, Your booking with Valam Cars has been confirmed! Booking Details: Booking ID: $_id, Drop-off Date/Time: $_to Pick-up Date/Time: $_from Car Model: $_car If you have any questions or need to make changes, please visit our website or contact customer support. Thank you for choosing Valam Cars. Drive safe and enjoy your journey! Valam Cars Team";
    }
}

