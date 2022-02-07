<?php

namespace Database\Seeders;

use App\Models\MrcSpell;
use App\Models\Spell;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MrcSpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MrcSpell::factory()
            ->count(1)
            ->create();
    }
}
