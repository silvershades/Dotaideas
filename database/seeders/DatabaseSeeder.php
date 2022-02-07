<?php

namespace Database\Seeders;

use App\Models\MrcOption;
use App\Models\UserAchievement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //SEEDERS IN ORDER OF IMPORTANCE
        $this->call([

            //STATIC DATA
            PostTypeSeeder::class,
            SpellDamageTypeSeeder::class,
            SpellTargetSeeder::class,
            SpellTypeSeeder::class,
            OtherFlagsSeeder::class,
            CreepTypeSeeder::class,
            ArticleSeeder::class,
            Dota2HeroSeeder::class,
            ShopItemCategorySeeder::class,
            AchievementSeeder::class,
            ItemShopSeeder::class,
            ItemTypeSeeder::class,


            //NON-STATIC DATA
            PostSeeder::class,


            HeroSeeder::class,
            OtherSeeder::class,
            CreepSeeder::class,
            CreepUnitSeeder::class,

            ItemSeeder::class,

            ItemAttributeSeeder::class,


            SpellSeeder::class,
            SpellAttributeSeeder::class,


            CommentSeeder::class,
//            CommentReplySeeder::class,
            CoinsSeeder::class,
            UserAchievementSeeder::class,


            ShopItemSeeder::class,


            MrcSeeder::class,
//            MrcSpellSeeder::class,
        ]);
    }
}
