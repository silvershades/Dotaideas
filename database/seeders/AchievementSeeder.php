<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Welcome to the jungle',
                'description' => 'Create your first post.',
                'completion_points' => '500',
                'completion_coins' => '15',
            ],
            [
                'name' => 'Starts at level 1',
                'description' => 'Create 1 post from each category. 1 Hero, 1 Item, 1 Other & 1 Neutral Camp.',
                'completion_points' => '500',
                'completion_coins' => '15',
            ],
            [
                'name' => 'Interacting',
                'description' => 'Leave a comment in 10 posts.',
                'completion_points' => '500',
                'completion_coins' => '15',
            ],
            [
                'name' => 'In my opinion',
                'description' => 'Cast your vote in 10 posts.',
                'completion_points' => '500',
                'completion_coins' => '15',
            ],
            [
                'name' => 'Getting famous',
                'description' => 'Get over 10 votes in one post.',
                'completion_points' => '500',
                'completion_coins' => '50',
            ],
            [
                'name' => 'Superstar',
                'description' => 'Get over 100 votes in one post.',
                'completion_points' => '5000',
                'completion_coins' => '500',
            ],
            [
                'name' => 'The collector',
                'description' => 'Get awarded 10 times.',
                'completion_points' => '500',
                'completion_coins' => '100',
            ],
            [
                'name' => 'Grand Master',
                'description' => 'Get awarded 100 times.',
                'completion_points' => '5000',
                'completion_coins' => '1000',
            ],
            [
                'name' => 'Its getting crowded',
                'description' => 'Participate in 1 monthly challenge.',
                'completion_points' => '5000',
                'completion_coins' => '1000',
            ],
            [
                'name' => 'One to many',
                'description' => 'Participate in 10 monthly challenge.',
                'completion_points' => '5000',
                'completion_coins' => '1000',
            ],
            [
                'name' => 'Ding Ding Ding',
                'description' => 'Win 1 monthly challenge.',
                'completion_points' => '5000',
                'completion_coins' => '1000',
            ],
            [
                'name' => 'Mother F',
                'description' => 'Win 10 monthly challenge.',
                'completion_points' => '5000',
                'completion_coins' => '5000',
            ],


        ];

        DB::table('achievements')->insert($data);
    }
}
