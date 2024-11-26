<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapCar extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(CarDetails::class, 'car_id');
    }

    public function swapCar()
    {
        return $this->belongsTo(CarDetails::class, 'swap_car_id');
    }
}
