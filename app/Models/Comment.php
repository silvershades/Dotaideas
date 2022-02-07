<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function comment_reply()
    {
        return $this->hasMany(CommentReply::class)->orderBy('created_at','desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
}
