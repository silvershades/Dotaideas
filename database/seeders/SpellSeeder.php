<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Spell;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hero_posts = Post::where('post_type_id', 1)->orWhere('post_type_id', 2)->orWhere('post_type_id', 4)->get();
        foreach ($hero_posts as $post) {
            if ($post->post_type_id == 1) {
                $posts = Spell::factory()
                    ->count(6)
                    ->state(new Sequence(
                        ['hotkey' => 'Q'],
                        ['hotkey' => 'W'],
                        ['hotkey' => 'E'],
                        ['hotkey' => 'R'],
                        ['hotkey' => 'D'],
                        ['hotkey' => 'F'],
                    ))
                    ->for($post)
                    ->create();
            } elseif ($post->post_type_id != 1) {
                $posts = Spell::factory()
                    ->count(3)
                    ->state(new Sequence(
                        ['spell_type_id' => '1'],
                        ['spell_type_id' => '3'],
                        ['spell_type_id' => '3'],
                    ))
                    ->for($post)
                    ->create();
            }
        }
    }
}
