<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Car()
    {
        return $this->belongsTo(CarDetails::class);
    }

    public function details()
    {
        return $this->hasMany(BookingDetail::class,'booking_id','booking_id');
    }

    public function comments()
    {
        return $this->hasMany(Commend::class);
    }
}
