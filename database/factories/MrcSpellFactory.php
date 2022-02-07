<?php

namespace Database\Factories;

use App\Models\SpellDamageType;
use App\Models\SpellTarget;
use App\Models\SpellType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MrcSpellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name,
            'spell_type_id' => SpellType::all()->random()->id,
            'spell_target_id' => SpellTarget::all()->random()->id,
            'spell_damage_type_id' => SpellDamageType::all()->random()->id,
            'description' => $this->faker->text(2000),
            'manacost' => $this->faker->randomNumber(3),
            'cooldown' => "50",
            'img_path' => "/img/w.png",
            'mod_by_aghanims_scepter_desc' => $this->faker->text(2000),
            'mod_by_aghanims_shard_desc' => $this->faker->text(2000),
            'pierces_bkb' => $this->faker->boolean(),
            'dispellable' => $this->faker->boolean(),
            'breakable' => $this->faker->boolean(),
            'blocked_by_linkens' => $this->faker->boolean(),
            'cast_while_rooted' => $this->faker->boolean(),
        ];
    }
}
