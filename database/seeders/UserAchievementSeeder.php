<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Coins;
use App\Models\User;
use App\Models\UserAchievement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::All();
        $achievements = Achievement::All();
        foreach ($users as $user) {
            foreach ($achievements as $achievement) {
                $data = [
                    [
                        'user_id' => $user->id,
                        'achievement_id' => $achievement->id,
                        'completed' => rand(0,100)
                    ],

                ];

                DB::table('user_achievements')->insert($data);
            }
        }
    }
}
