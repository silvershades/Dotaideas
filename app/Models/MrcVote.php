<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrcVote extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mrc()
    {
        return $this->belongsTo(Mrc::class);
    }

    public function mrc_spell()
    {
        return $this->belongsTo(MrcSpell::class);
    }
}
