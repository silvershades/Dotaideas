<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpellDamageType extends Model
{
    use HasFactory;

    public function spell()
    {
        return $this->belongsTo(Spell::class);
    }

    public function mrc_spell()
    {
        return $this->belongsTo(MrcSpell::class);
    }
}
