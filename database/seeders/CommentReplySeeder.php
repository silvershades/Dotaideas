<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = Comment::all();
        foreach ($comments as $comment){
            CommentReply::factory()
                ->count(2)
                ->for($comment)
                ->create();
        }
    }
}
