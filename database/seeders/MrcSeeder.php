<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MrcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Techies',
                'spell_name' => 'Remote Mines',
                'img_path' => '/img/mrc/techies.jpg',
                'spell_img_path' => '/img/mrc/minas.png',
                'start_date' => '2022-01-01',
                'end_date' => '2022-01-29',
            ],
        ];

        DB::table('mrcs')->insert($data);
    }
}
