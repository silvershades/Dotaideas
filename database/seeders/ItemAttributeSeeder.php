<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemAttribute;
use Illuminate\Database\Seeder;

class ItemAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        foreach ($items as $item){
            ItemAttribute::factory()
                ->count(3)
                ->for($item)
                ->create();
        }
    }
}
