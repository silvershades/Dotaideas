<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrcSpellAttribute extends Model
{
    use HasFactory;

    public function mrc_spell()
    {
        return $this->belongsTo(MrcSpell::class);
    }
}
