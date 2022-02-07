<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroProjection extends Model
{
    use HasFactory;


    public function hero()
    {
        return $this->belongsTo(Hero::class);
    }
}
