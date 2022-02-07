<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopItemCategorySeeder extends Seeder
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
                'name' => 'DOTA IDEAS UNLOCKS',
                'description' => 'lreworw sdafijadsof iasdofjasdo fjasodifjasdofj asdofasoo adsofiaosdifjaso ifjods ofja.'
            ],
            [
                'name' => 'POST BACKGROUNDS',
                'description' => 'Apply a color filter to one of your post to get more noticeable.'
            ],

            [
                'name' => 'USER AVATARS',
                'description' => 'Change your avatar!'
            ],



        ];

        DB::table('shop_item_categories')->insert($data);
    }
}
