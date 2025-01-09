<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponHistory extends Model {
    use HasFactory;



    public function user() {
        return $this->belongsTo(AdminDetail::class, 'created_by', 'id');
    }
}
