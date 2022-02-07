<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherFlags extends Model
{
    use HasFactory;

    public function other()
    {
        return $this->belongsTo(Other::class);
    }
}
