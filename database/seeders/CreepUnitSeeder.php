<?php

namespace Database\Seeders;

use App\Models\Creep;
use App\Models\CreepUnit;
use Illuminate\Database\Seeder;

class CreepUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $creep_camps_posts = Creep::all();
        foreach ($creep_camps_posts as $creep){
            CreepUnit::factory()
                ->count(3)
                ->for($creep)
                ->create();
        }
    }
}
