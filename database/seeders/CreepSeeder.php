<?php

namespace Database\Seeders;

use App\Models\Creep;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CreepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $creep_posts = Post::where('post_type_id', 4)->get();
        foreach ($creep_posts as $post){
            Creep::factory()
                ->count(1)
                ->for($post)
                ->create();
        }
    }
}
