<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDetails extends Model {
    use HasFactory;





    protected static function boot() {

        parent::boot();

        // Hook into the "created" event
        static::created(function ($model) {
            CarDetailsHistory::insert([
                "action" => 'created',
                "car_model_id" => $model->carModel->car_model_id,
                "register_number" => $model->register_number,
                "model_name" => $model->carModel->model_name,
                "car_details_id" => $model->id,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now()->tz('Asia/Kolkata'),
                "type" => 'details'
            ]);
        });

        // Hook into the "updated" event
        static::updating(function ($model) {
            CarDetailsHistory::insert([
                "action" => 'updated',
                "car_model_id" => $model->carModel->car_model_id,
                "register_number" => $model->register_number,
                "model_name" => $model->carModel->model_name,
                "car_details_id" => $model->id,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now()->tz('Asia/Kolkata'),
                "type" => 'details'
            ]);
        });


        // Hook into the "updated" event
        static::deleting(function ($model) {
            CarDetailsHistory::insert([
                "action" => 'deleted',
                "car_model_id" => $model->carModel->car_model_id,
                "register_number" => $model->register_number,
                "model_name" => $model->carModel->model_name,
                "car_details_id" => $model->id,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now()->tz('Asia/Kolkata'),
                "type" => 'details'
            ]);
        });
    }




    public function carModel() {
        return $this->belongsTo(CarModel::class, 'model_id', 'car_model_id');
    }

    // In CarDetails.php model
    public function availableBookings() {
        return $this->hasMany(Available::class, 'register_number', 'register_number');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }
}
