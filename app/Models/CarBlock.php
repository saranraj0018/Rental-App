<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBlock extends Model {
    use HasFactory;

    public function user() {
        return $this->belongsTo(AdminDetail::class);
    }
    
        public function details() {
        return $this->belongsTo(CarDetails::class, 'car_register_number', 'register_number');
    }

    protected static function boot() {

        parent::boot();

        // Hook into the "created" event
        static::created(function ($model) {
            CarBlockHistory::insert([
                "action" => 'created',
                "block_type" => $model->block_type,
                "register_number" => $model->car_register_number,
                "reason" => $model->reason,
                "start_date" => $model->start_date,
                "end_date" => $model->end_date,
                'created_by' => auth()->guard('admin')->id(),
                   'created_at' => now(),
                
            ]);
        });

        // Hook into the "updated" event
        static::updating(function ($model) {
            CarBlockHistory::insert([
                "action" => 'updated',
                "block_type" => $model->block_type,
                "register_number" => $model->car_register_number,
                "reason" => $model->reason,
                "start_date" => $model->start_date,
                "end_date" => $model->end_date,
                'created_by' => auth()->guard('admin')->id(),
                  'created_at' => now(),

            ]);
        });


        // Hook into the "updated" event
        static::deleting(function ($model) {
            CarBlockHistory::insert([
                "action" => 'deleted',
                "block_type" => $model->block_type,
                "register_number" => $model->car_register_number,
                "reason" => $model->reason,
                "start_date" => $model->start_date,
                "end_date" => $model->end_date,
                'created_by' => auth()->guard('admin')->id(),
                  'created_at' => now(),

            ]);
        });
    }

}
