<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    public function carDetails()
    {
        return $this->hasOne(CarDetails::class, 'model_id', 'car_model_id');
    }

    public function carDoc()
    {
        return $this->hasMany(CarDocument::class, 'model_id');
    }
    
     protected static function boot() {

        parent::boot();

        // Hook into the "created" event
        static::created(function ($model) {
            CarDetailsHistory::insert([
                "action" => 'created',
                "car_model_id" => $model->car_model_id,
                "register_number" => $model?->carDetails?->register_number,
                "model_name" => $model->model_name,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now(),
                "type" => 'models'
            ]);
        });

        // Hook into the "updated" event
        static::updating(function ($model) {
            CarDetailsHistory::insert([
                "action" => 'updated',
                "car_model_id" => $model->car_model_id,
                "register_number" => $model?->carDetails?->register_number,
                "model_name" => $model->model_name,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now(),
                "type" => 'models'
            ]);
        });



        // Hook into the "updated" event
        static::deleting(function ($model) {
            CarDetailsHistory::insert([
                "action" => 'deleted',
                "car_model_id" => $model->car_model_id,
                "register_number" => $model?->carDetails?->register_number,
                "model_name" => $model->model_name,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now(),
                "type" => 'models'
            ]);
        });
    }
}
