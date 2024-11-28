<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarDetailsHistory extends Model {


    protected $table = 'car_details_history';


    protected $fillable = [
        "created_at", "updated_at", "car_details_id"
    ];




    public function carDetails() {
        return $this->hasOne(CarDetails::class, "id", "car_details_id");
    }



    public function user() {
        return $this->belongsTo(AdminDetail::class, "created_by", "id");
    }
}
