<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreepTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Small Camp'],
            ['name'=>'Medium Camp'],
            ['name'=>'Large Camp'],
            ['name'=>'Ancient Camp'],
            ['name'=>'Other'],
        ];

        DB::table('creep_types')->insert($data);
    }
}
