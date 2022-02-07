<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mrc extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',

    ];

    public function mrc_spell()
    {
        return $this->hasMany(MrcSpell::class);
    }

    public function mrc_votes()
    {
        return $this->hasMany(MrcVote::class);
    }

    public function winner()
    {
        $winner_entry = MrcSpell::where('id', $this->winner_entry_id)->first();
        if (!$winner_entry) {
            return 'No winner';
        } else {
            return $winner_entry->user->name;
        }
    }

    public function days_left()
    {
        $earlier = new DateTime(now());
        $later = new DateTime($this->end_date);

        $days = $later->diff($earlier)->format("%a") ;
        $hours = $later->diff($earlier)->format("%h");
        if($days > 1){
            $days = $days . ' days';
        }else{
            $days = $days . ' day';
        }
        if($hours > 1){
            $hours = $hours . ' hours';
        }else{
            $hours = $hours . ' hour';
        }
        return  $days . ' ' . $hours . ' left';
    }
}
