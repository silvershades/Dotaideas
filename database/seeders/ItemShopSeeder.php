<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Fountain'],
            ['name'=>'Secret'],
            ['name'=>'Looted'],
            ['name'=>'Other'],
        ];

        DB::table('item_shops')->insert($data);
    }
}
