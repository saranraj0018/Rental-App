<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
    use HasFactory;


    protected static function boot() {

        parent::boot();

        // Hook into the "created" event
        static::created(function ($model) {
            CouponHistory::insert([
                "action" => 'created',
                'title' => $model->title,
                'amount' => $model->amount,
                'description' => $model->description,
                'start_date' => $model->start_date,
                'end_date' => $model->end_date,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now(),
            ]);
        });

        // Hook into the "updated" event
        static::updating(function ($model) {
            CouponHistory::insert([
                "action" => 'updated',
                'title' => $model->title,
                'amount' => $model->amount,
                'description' => $model->description,
                'start_date' => $model->start_date,
                'end_date' => $model->end_date,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now(),
            ]);
        });


        // Hook into the "updated" event
        static::deleting(function ($model) {
            CouponHistory::insert([
                "action" => 'deleted',
                'title' => $model->title,
                'amount' => $model->amount,
                'description' => $model->description,
                'start_date' => $model->start_date,
                'end_date' => $model->end_date,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now(),
            ]);
        });
    }


    public function user() {
        return $this->belongsTo(AdminDetail::class);
    }
}
