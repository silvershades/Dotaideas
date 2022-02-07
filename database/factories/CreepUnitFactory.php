<?php

namespace Database\Factories;

use App\Models\CreepType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreepUnitFactory extends Factory
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
            'description' => $this->faker->text(300),

            'kill_gold' => $this->faker->numberBetween(1,200),
            'kill_exp' => $this->faker->numberBetween(1,200),
            'total_hp' => $this->faker->numberBetween(200,1500),
            'total_hp_regen' => $this->faker->randomFloat(1,0,10),
            'total_mana' => $this->faker->numberBetween(0,500),
            'total_mana_regen' => $this->faker->randomFloat(1,0,10),
            'units_in_camp' => $this->faker->numberBetween(1,3),
            'attack_damage_min' => $this->faker->randomNumber(2),
            'attack_damage_max' => $this->faker->randomNumber(2),
            'attack_time' => $this->faker->randomFloat(1,0,1.5),
            'attack_range' => $this->faker->randomNumber(3),
            'attack_type' => $this->faker->randomElement(['1', '2']),
            'defense_armor' => $this->faker->numberBetween(0,10),

        ];
    }
}
