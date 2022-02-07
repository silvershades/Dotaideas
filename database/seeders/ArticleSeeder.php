<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
////        Article::factory()
////            ->count(10)
////            ->create();
//
//        $body = Storage::disk('public')->get('/htmls/attack_speed.blade.php');
//
////        $body = file_get_contents(route("/htmls/attack_speed.blade.php"));
        $data = [
            [
                'title' => 'Attributes',
                'subtitle' => 'Strength, Agility & Intelligence',
                'bajada' => 'Find out how attack speed is calculated in Dota 2 so you can have a better understanding with the game.',
                'svg' => 'strength',
                'body_html' => 'resistances',
            ],
            [
                'title' => 'Attack Speed',
                'subtitle' => 'BAT & IAS explained',
                'bajada' => 'Find out how attack speed is calculated in Dota 2 so you can have a better understanding with the game.',
                'svg' => 'attack_time',
                'body_html' => 'attack_speed',
            ],
            [
                'title' => 'Abilities',
                'subtitle' => 'Classification & Targets',
                'bajada' => 'Find out how attack speed is calculated in Dota 2 so you can have a better understanding with the game.',
                'svg' => 'target',
                'body_html' => 'spell_targets',
            ],
            [
                'title' => 'Damage',
                'subtitle' => 'Classification',
                'bajada' => 'Find out how attack speed is calculated in Dota 2 so you can have a better understanding with the game.',
                'svg' => 'attack_damage',
                'body_html' => 'damage_types',
            ],
            [
                'title' => 'Defense',
                'subtitle' => 'Armor & Damage Reductions',
                'bajada' => 'Find out how attack speed is calculated in Dota 2 so you can have a better understanding with the game.',
                'svg' => 'defense_armor',
                'body_html' => 'armor',
            ],
            [
                'title' => 'Timings',
                'subtitle' => 'Vision, Runes, Roshan & Outposts',
                'bajada' => 'Find out how attack speed is calculated in Dota 2 so you can have a better understanding with the game.',
                'svg' => 'daynight',
                'body_html' => 'resistances',
            ],

        ];

        DB::table('articles')->insert($data);
    }
}
