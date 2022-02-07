<?php

namespace Database\Seeders;

use App\Models\Hero;
use App\Models\Post;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hero_posts = Post::where('post_type_id', 1)->get();
        foreach ($hero_posts as $post){
            $posts = Hero::factory()
                ->count(1)
                ->for($post)
                ->create();
        }

    }
}
