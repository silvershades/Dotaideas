<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ['name'=>'Hero'],
            ['name'=>'Item'],
            ['name'=>'Other'],
            ['name'=>'Creep'],
        ];

        DB::table('post_types')->insert($data);
    }
}
