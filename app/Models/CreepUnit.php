<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreepUnit extends Model
{
    use HasFactory;

    public function creep()
    {
        return $this->belongsTo(Creep::class);
    }
}
