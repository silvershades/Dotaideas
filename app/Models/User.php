<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'born_rights',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];


    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function mrc_votes()
    {
        return $this->hasMany(MrcVote::class);
    }

    public function mrc_spells()
    {
        return $this->hasMany(MrcSpell::class);
    }

    public function get_mrc_wins()
    {
        return Mrc::where('winner_entry_id',$this->id)->count();
    }

    public function coins()
    {
        return $this->hasMany(Coins::class);
    }

    public function coins_income()
    {
        return $this->hasMany(Coins::class)->where('amount', '>', 0);
    }

    public function coins_spent()
    {
        return $this->hasMany(Coins::class)->where('amount', '<', 0);
    }

    public function points()
    {
        return $this->hasMany(Points::class);
    }

    public function votes()
    {
        return $this->hasMany(Votes::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function comment_replies()
    {
        return $this->hasMany(CommentReply::class);
    }


    public function shop_items()
    {
        return $this->hasMany(UserShopItems::class);
    }

    public function awards()
    {
        return Post::leftJoin('votes', 'votes.post_id', '=', 'posts.id')
            ->where('posts.user_id', $this->id)
            ->where('votes.vote', 30)
            ->count();
    }

    public function awards_made()
    {
        return $this->hasMany(Votes::class)->where('vote', '=', 30);
    }

    public function user_achievements()
    {
        return $this->hasMany(UserAchievement::class);
    }

    public function get_total_points()
    {
        $votes = Votes::where('post_owner_id', $this->id)->sum('vote');
        $points = $this->points->sum('amount');
        $total = $points + $votes;
        if ($total >= 1000000 || $total <= -1000000) {
            return number_format($total / 1000000, 1) + 0 . 'm';
        } else if ($total >= 1000 || $total <= -1000) {
            return number_format($total / 1000, 1) + 0 . 'k';
        } else {
            return $total;
        }
    }

    public function get_votes_received_count()
    {
        return Votes::where('post_owner_id', $this->id)->count();
    }

    public function get_votes_received_points()
    {
        return Votes::where('post_owner_id', $this->id)->sum('vote');
    }

    public function get_awards_received_count()
    {
        return Votes::where('post_owner_id', $this->id)->where('vote', 30)->count();
    }

    public function has_supporters_medal()
    {
        return UserShopItems::where('user_id', $this->id)->where('shop_item_id', 1)->count();
    }

    public function has_unlocked_text_editor()
    {
        return UserShopItems::where('user_id', $this->id)->where('shop_item_id', 2)->count();
    }

    public function has_unlocked_three_votes()
    {
        return UserShopItems::where('user_id', $this->id)->where('shop_item_id', 3)->count();
    }

    public function has_unlocked_img_upload()
    {
        return UserShopItems::where('user_id', $this->id)->where('shop_item_id', 4)->count();

    }

    public function add_points($amount, $reason)
    {
        try {
            $points = new Points();
            $points->user_id = $this->id;
            $points->amount = $amount;
            $points->reason = $reason;
            $points->save();

        } catch (\Exception $e) {

        }
    }

    public function add_coins($amount, $reason)
    {
        try {
            $points = new Coins();
            $points->user_id = $this->id;
            $points->amount = $amount;
            $points->reason = $reason;
            $points->save();

        } catch (\Exception $e) {

        }
    }

    public function get_points_where($reason)
    {
        return Points::where('reason', $reason)->where('user_id', $this->id)->sum('amount');
    }

}
