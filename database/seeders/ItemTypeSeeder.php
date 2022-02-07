<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Basic'],
            ['name'=>'Upgrade'],
            ['name'=>'Neutral'],
        ];

        DB::table('item_types')->insert($data);
    }
}
