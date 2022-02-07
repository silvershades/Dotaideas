<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MrcSpell extends Model
{
    use HasFactory;


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

    public function mrc()
    {
        return $this->belongsTo(Mrc::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mrc_spell_attributes()
    {
        return $this->hasMany(MrcSpellAttribute::class);
    }


    public function mrc_votes()
    {
        return $this->hasMany(MrcVote::class);
    }

    public function mrc_voted_user()
    {
        if (Auth::check()) {
            $has_voted = MrcVote::where('user_id', Auth::id())->where('mrc_spell_id', $this->id)->first();
            return $has_voted;
        } else {
            return null;
        }

    }


}
