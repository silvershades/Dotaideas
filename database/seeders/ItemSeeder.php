<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Post;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item_posts = Post::where('post_type_id', 2)->get();
        foreach ($item_posts as $post) {
            $posts = Item::factory()
                ->count(1)
                ->for($post)
                ->create();
        }
    }
}
