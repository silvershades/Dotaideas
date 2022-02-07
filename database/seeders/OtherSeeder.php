<?php

namespace Database\Seeders;

use App\Models\Other;
use App\Models\Post;
use Illuminate\Database\Seeder;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $other_posts = Post::where('post_type_id',3)->get();
        foreach ($other_posts as $post){
            $posts = Other::factory()
                ->count(1)
                ->for($post)
                ->create();
        }
    }
}
