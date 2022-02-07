<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreepType extends Model
{
    use HasFactory;

    public function creep()
    {
        return $this->hasMany(Creep::class);
    }
}
