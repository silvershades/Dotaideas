<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Spell;
use App\Models\SpellAttribute;
use Illuminate\Database\Seeder;

class SpellAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spells = Spell::all();
        foreach ($spells as $spell){
             SpellAttribute::factory()
                ->count(3)
                ->for($spell)
                ->create();
        }
    }
}
