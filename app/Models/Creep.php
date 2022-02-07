<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creep extends Model
{
    use HasFactory;

    public function creep_type()
    {
        return $this->belongsTo(CreepType::class);
    }
    public function creep_units()
    {
        return $this->hasMany(CreepUnit::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
