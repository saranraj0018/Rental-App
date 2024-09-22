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

    public function carDoc()
    {
        return $this->hasMany(CarDocument::class, 'model_id', 'model_id');
    }
}
