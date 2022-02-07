<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpellTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'No target'],
            ['name'=>'Target area'],
            ['name'=>'Target unit'],
            ['name'=>'Target unit or point'],
            ['name'=>'Vector targeting'],
            ['name'=>'Target Unit with area effect'],
        ];

        DB::table('spell_targets')->insert($data);

    }
}
