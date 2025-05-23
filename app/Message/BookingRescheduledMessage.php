<?php

namespace App\Message;

use App\Contracts\Message;
use App\Models\Booking;

class BookingRescheduledMessage implements Message {




    public function __construct(public Booking $booking) {
    }



    /**
     * Template ID for Login
     * @return string
     */
    public function template(): string {
        return '1707173736770702467';
    }




    /**
     * Message Template for OTP
     * @param mixed $dataset
     * @return string
     */
    public function message(): string {

        $_name = ucfirst($this->booking->user->name);
        $_id = $this->booking->booking_id;
        $_from = $this->booking->booking_type == 'delivery' ? ($this->booking->reschedule_date ? $this->booking->reschedule_date : $this->booking->start_date) :  $this->booking->start_date;
        $_to = $this->booking->booking_type == 'pickup' ? ($this->booking->reschedule_date ? $this->booking->reschedule_date : $this->booking->end_date) : $this->booking->end_date;
        
        $_car = $this->booking->Car->carModel->model_name;

        return "Dear $_name, Your booking with Valam Cars has been successfully modified. Updated Booking Details: Booking ID: $_id, New Drop-off Date/Time: $_from, New Pick-up Date/Time: $_to, Car Model: $_car, If you have any questions or need further assistance, please visit our website or contact customer support. We look forward to serving you! Valam Cars Team";
    }
}

