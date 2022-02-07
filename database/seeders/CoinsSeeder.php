<?php

namespace Database\Seeders;

use App\Models\Coins;
use App\Models\User;
use Illuminate\Database\Seeder;

class CoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::All();
        foreach ($users as $user){
            Coins::factory()
                ->count(20)
                ->for($user)
                ->create();
        }

    }
}
