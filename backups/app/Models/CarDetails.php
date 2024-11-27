<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDetails extends Model
{
    use HasFactory;

    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'model_id', 'car_model_id');
    }

    // In CarDetails.php model
    public function availableBookings()
    {
        return $this->hasMany(Available::class, 'register_number', 'register_number');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }

}
