<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model {
    use HasFactory;



    protected static function boot() {

        parent::boot();

        // Hook into the "created" event
        static::created(function ($model) {
            HolidayHistory::insert([
                "action" => 'created',
                "event" => $model->event_name,
                "event_date" => $model->event_date,
                "description" => $model->notes,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now()->tz('Asia/Kolkata'),
            ]);
        });

        // Hook into the "updated" event
        static::updating(function ($model) {
            HolidayHistory::insert([
                "action" => 'updated',
                "event" => $model->event_name,
                "event_date" => $model->event_date,
                "description" => $model->notes,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now()->tz('Asia/Kolkata'),
            ]);
        });


        // Hook into the "updated" event
        static::deleting(function ($model) {
            HolidayHistory::insert([
                "action" => 'deleted',
                "event" => $model->event_name,
                "event_date" => $model->event_date,
                "description" => $model->notes,
                "created_by" => auth()->guard('admin')->id(),
                'created_at' => now()->tz('Asia/Kolkata'),
            ]);
        });
    }


    public function user() {
        return $this->belongsTo(AdminDetail::class);
    }
}
