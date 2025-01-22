<?php

namespace App\Contracts;

use App\Models\Booking;

interface Message {


    /**
     * Get the message Template id
     * @return string
     */
    public function template(): string;


    /**
     * Get the message subject
     * @return string
     */
    public function message(): string;
}
