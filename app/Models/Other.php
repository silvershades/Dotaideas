<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function other_flags()
    {
        return $this->belongsTo(OtherFlags::class);
    }
}
