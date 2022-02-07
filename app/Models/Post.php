<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'is_published' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_type()
    {
        return $this->belongsTo(PostType::class);
    }

    public function hero()
    {
        return $this->hasOne(Hero::class);
    }

    public function item()
    {
        return $this->hasOne(Item::class);
    }

    public function other()
    {
        return $this->hasOne(Other::class);
    }

    public function creep()
    {
        return $this->hasOne(Creep::class);
    }

    public function special()
    {
        return $this->hasOne(Special::class);
    }

    public function ads()
    {
        return $this->hasOne(Ads::class);
    }

    public function spells()
    {
        return $this->hasMany(Spell::class);
    }

    public function votes()
    {
        return $this->hasMany(Votes::class);
    }

    public function votes_neg()
    {
        return $this->hasMany(Votes::class)->where('vote', '=', -10);
    }

    public function votes_one()
    {
        return $this->hasMany(Votes::class)->where('vote', '=', 10);
    }

    public function votes_two()
    {
        return $this->hasMany(Votes::class)->where('vote', '=', 20);
    }

    public function votes_three()
    {
        return $this->hasMany(Votes::class)->where('vote', '=', 30);
    }

    public function votes_total()
    {
        $votes = Votes::where('post_id', $this->id)->sum('vote');
        if ($votes >= 1000000 || $votes <= -1000000) {
            return number_format($votes / 1000000, 1) + 0 . 'm';
        } else if ($votes >= 1000 || $votes <= -1000) {
            return number_format($votes / 1000, 1) + 0 . 'k';
        } else {
            return $votes;
        }
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function comments_total()
    {
        $comments = Comment::where('post_id', $this->id)->count();
        $replies = CommentReply::where('post_id', $this->id)->count();
        return $comments + $replies;
    }

    public function awards()
    {
        return $this->hasMany(Votes::class)->where('vote', '=', 30);
    }

    public function created_at_days_ago()
    {
        $days_ago = $this->created_at;
        $now = time();
        $datediff = $now - strtotime($days_ago);
        $dif = round($datediff / (60 * 60 * 24));
        if ($dif == 0) {
            return 'today';
        } elseif ($dif == 1) {
            return $dif . ' day ago';
        } else {
            return $dif . ' days ago';
        }
    }

    public function edited_at_days_ago()
    {
        $days_ago = $this->updated_at;
        $now = time();
        $datediff = $now - strtotime($days_ago);
        $dif = round($datediff / (60 * 60 * 24));
        if ($dif == 0) {
            return 'today';
        } elseif ($dif == 1) {
            return $dif . ' day ago';
        } else {
            return $dif . ' days ago';
        }
    }

    public function has_golden_bg()
    {
        $S_I = UserShopItems::where('user_id', $this->user->id)->where('shop_item_id', 6)->where('consumed_on_post', $this->id)->count();
        if ($S_I > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function has_emerald_bg()
    {
        $S_I = UserShopItems::where('user_id', $this->user->id)->where('shop_item_id', 5)->where('consumed_on_post', $this->id)->count();
        if ($S_I > 0) {
            return true;
        } else {
            return false;
        }
    }
}
