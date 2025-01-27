<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
     protected $fillable = ['status'];

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

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id', 'booking_id');
    }



    public function location() {

        $_booking = Booking::where('booking_id', $this->booking_id)
        ->get(['address', 'booking_type']);

        return (object) [
            'pickup' => $_booking->filter(fn($_book) => $_book->booking_type != 'delivery')?->first()?->address,
            'dropoff' => $_booking->filter(fn($_book) => $_book->booking_type == 'delivery')?->first()?->address,
        ];
    }
}
