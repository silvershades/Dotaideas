<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherFlagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Buildings'],
            ['name'=>'Map'],
            ['name'=>'Items'],
            ['name'=>'Creeps'],
            ['name'=>'Gameplay'],
            ['name'=>'Heroes'],
            ['name'=>'Mechanics'],
            ['name'=>'Roshan'],
            ['name'=>'Other'],
            ['name'=>'UI'],

        ];

        DB::table('other_flags')->insert($data);
    }
}
