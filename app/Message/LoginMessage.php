<?php

namespace App\Message;

use App\Contracts\Message;


class LoginMessage implements Message {




    public function __construct(public string $otp) {
    }



    /**
     * Template ID for Login
     * @return string
     */
    public function template(): string {
        return '1707173736712939027';
    }




    /**
     * Message Template for OTP
     * @param mixed $dataset
     * @return string
     */
    public function message(): string {
        return "Your Valam Cars OTP is: $this->otp Please enter this OTP to verify your self-driving car account. This OTP is valid for the next 10 minutes. For your security, do not share it with anyone.";
    }
}

