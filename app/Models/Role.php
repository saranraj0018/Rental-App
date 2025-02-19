<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(AdminDetail::class);
    }



    public function users()
    {
        return $this->hasMany(AdminDetail::class, 'role');
    }
}
