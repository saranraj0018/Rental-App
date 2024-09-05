<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    public function carDetails()
    {
        return $this->hasMany(CarDetails::class, 'model_id', 'car_model_id');
    }

    public function carDoc()
    {
        return $this->hasMany(CarDocument::class, 'model_id');
    }
}
