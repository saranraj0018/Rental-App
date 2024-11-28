<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBlockHistory extends Model {

    protected $table = 'car_block_history';

    protected $fillable = [
        "block_type",
        "register_number",
        "reason",
        "start_date",
        "end_date",
        "created_by",
        "updated_by",
    ];


    public function user() {
        return $this->belongsTo(AdminDetail::class, "created_by", "id");
    }
}
