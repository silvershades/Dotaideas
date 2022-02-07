<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpellDamageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ['name' => 'NONE'],
            ['name' => 'PURE'],
            ['name' => 'PHYSICAL'],
            ['name' => 'MAGICAL'],
            ['name' => 'MIX'],
            ['name' => 'HP REMOVAL'],
        ];

        DB::table('spell_damage_types')->insert($data);
    }
}
