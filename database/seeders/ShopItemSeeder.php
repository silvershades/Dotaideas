<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //UNLOCKS
            [
                'name' => 'SUPPORTER \'S BADGE',
                'shop_item_category_id' => 1,
                'description' => 'Add a badge to your name in all of Dota Ideas.',
                'value' => 50000,
                'img_path' => '/img/shop_items/unlocks/badge.png',
                'charges' => 0,
                'one_time_buy' => 1,
            ],

            [
                'name' => 'TEXT EDITOR',
                'shop_item_category_id' => 1,
                'description' => 'Unlocks a full powered text editor for post descriptions & lore.',
                'value' => 200,
                'img_path' => '/img/shop_items/unlocks/text-editor.png',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'VOTE 3 POINTS & 1 AWARD',
                'shop_item_category_id' => 1,
                'description' => 'Unlocks new vote option.',
                'value' => 333,
                'img_path' => '/img/shop_items/unlocks/3.png',
                'charges' => 0,
                'one_time_buy' => 1,
            ],

            //POST BACKGROUND STYLER
            [
                'name' => 'EMERALD IDEA',
                'shop_item_category_id' => 2,
                'description' => 'Apply a emerald color filter to one of your post to get more noticeable.',
                'value' => 1500,
                'img_path' => '/img/shop_items/post_bg/a.png',
                'charges' => 1,
                'one_time_buy' => 0,
            ],
            [
                'name' => 'GOLDEN IDEA',
                'shop_item_category_id' => 2,
                'description' => 'Apply a golden color filter to one of your post to get more noticeable.',
                'value' => 3000,
                'img_path' => '/img/shop_items/post_bg/b.png',
                'charges' => 1,
                'one_time_buy' => 0,
            ],


            //DESBLOQUEA NUEVOS AVATARS
            [
                'name' => 'AVATAR I',
                'shop_item_category_id' => 3,
                'description' => 'Ancient Aparition avatar',
                'value' => 100,
                'img_path' => '/img/shop_items/avatars/avatar_1.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'AVATAR  II',
                'shop_item_category_id' => 3,
                'description' => 'Vengeful Spirit avatar',
                'value' => 100,
                'img_path' => '/img/shop_items/avatars/avatar_2.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'AVATAR  III',
                'shop_item_category_id' => 3,
                'description' => 'Dark Willow avatar',
                'value' => 100,
                'img_path' => '/img/shop_items/avatars/avatar_3.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ], [
                'name' => 'AVATAR  IV',
                'shop_item_category_id' => 3,
                'description' => 'Witch Doctor avatar',
                'value' => 100,
                'img_path' => '/img/shop_items/avatars/avatar_4.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'AVATAR V',
                'shop_item_category_id' => 3,
                'description' => 'Outworld Destroyer avatar',
                'value' => 300,
                'img_path' => '/img/shop_items/avatars/avatar_5.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'AVATAR  VI',
                'shop_item_category_id' => 3,
                'description' => 'Necrophos avatar',
                'value' => 300,
                'img_path' => '/img/shop_items/avatars/avatar_6.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'AVATAR  VII',
                'shop_item_category_id' => 3,
                'description' => 'Arc Warden avatar',
                'value' => 300,
                'img_path' => '/img/shop_items/avatars/avatar_7.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ], [
                'name' => 'AVATAR  VIII',
                'shop_item_category_id' => 3,
                'description' => 'Skywrath Mage avatar',
                'value' => 300,
                'img_path' => '/img/shop_items/avatars/avatar_8.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ], [
                'name' => 'AVATAR  IX',
                'shop_item_category_id' => 3,
                'description' => 'Phanton Lancer avatar',
                'value' => 500,
                'img_path' => '/img/shop_items/avatars/avatar_9.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'AVATAR  X',
                'shop_item_category_id' => 3,
                'description' => 'Abaddon avatar',
                'value' => 500,
                'img_path' => '/img/shop_items/avatars/avatar_10.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'AVATAR  XI',
                'shop_item_category_id' => 3,
                'description' => 'AntiMage avatar',
                'value' => 500,
                'img_path' => '/img/shop_items/avatars/avatar_11.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],
            [
                'name' => 'AVATAR  XII',
                'shop_item_category_id' => 3,
                'description' => 'Chaos Knight avatar',
                'value' => 500,
                'img_path' => '/img/shop_items/avatars/avatar_12.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],  [
                'name' => 'AVATAR  XIII',
                'shop_item_category_id' => 3,
                'description' => 'Cristal Maiden avatar',
                'value' => 1000,
                'img_path' => '/img/shop_items/avatars/avatar_13.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],  [
                'name' => 'AVATAR  XIV',
                'shop_item_category_id' => 3,
                'description' => 'Luna avatar',
                'value' => 1000,
                'img_path' => '/img/shop_items/avatars/avatar_14.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],  [
                'name' => 'AVATAR  XV',
                'shop_item_category_id' => 3,
                'description' => 'Riki avatar',
                'value' => 1000,
                'img_path' => '/img/shop_items/avatars/avatar_15.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],  [
                'name' => 'AVATAR  XVI',
                'shop_item_category_id' => 3,
                'description' => 'Queen of pain avatar',
                'value' => 1000,
                'img_path' => '/img/shop_items/avatars/avatar_16.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],  [
                'name' => 'AVATAR  XVII',
                'shop_item_category_id' => 3,
                'description' => 'Roshan avatar',
                'value' => 2000,
                'img_path' => '/img/shop_items/avatars/avatar_17.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],  [
                'name' => 'AVATAR  XVIII',
                'shop_item_category_id' => 3,
                'description' => 'Sven avatar',
                'value' => 2000,
                'img_path' => '/img/shop_items/avatars/avatar_18.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],  [
                'name' => 'AVATAR  XIX',
                'shop_item_category_id' => 3,
                'description' => 'Lycan avatar',
                'value' => 2000,
                'img_path' => '/img/shop_items/avatars/avatar_19.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ], [
                'name' => 'AVATAR  XX',
                'shop_item_category_id' => 3,
                'description' => 'Enigma avatar',
                'value' => 10000,
                'img_path' => '/img/shop_items/avatars/avatar_20.jpg',
                'charges' => 0,
                'one_time_buy' => 1,
            ],


        ];

        DB::table('shop_items')->insert($data);
    }
}
