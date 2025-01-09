<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayHistory extends Model {
    use HasFactory;

    protected $fillable = [
        'email', 'event', 'event_date', 'description', 'created_by'
    ];


    public function user() {
        return $this->belongsTo(AdminDetail::class, 'created_by', 'id');
    }
}
