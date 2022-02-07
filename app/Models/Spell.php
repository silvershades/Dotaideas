<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spell extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function spellType()
    {
        return $this->belongsTo(SpellType::class);
    }

    public function spellDamageType()
    {
        return $this->belongsTo(SpellDamageType::class);
    }

    public function spellTarget()
    {
        return $this->belongsTo(SpellTarget::class);
    }



    public function spellAttributes()
    {
        return $this->hasMany(SpellAttribute::class);
    }

}
