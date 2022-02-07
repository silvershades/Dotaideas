<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpellTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Active'],
            ['name'=>'Autocast'],
            ['name'=>'Passive'],

        ];

        DB::table('spell_types')->insert($data);
    }
}
