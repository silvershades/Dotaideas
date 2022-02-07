<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
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

            'gold' => $this->faker->numberBetween(100,4000),
            'item_shop_id' => 1,
            'item_type_id' => 1,
            'bonus_strength' => $this->faker->numberBetween(0,30),
            'bonus_agility' => $this->faker->numberBetween(0,30),
            'bonus_intelligence' => $this->faker->numberBetween(0,30),
            'bonus_others' => $this->faker->text(100),
            'description' => $this->faker->text(100),
            'lore' => $this->faker->text(100),

            'roles_armor' => $this->faker->numberBetween( 0,3),
            'roles_damage' => $this->faker->numberBetween( 0,3),
            'roles_utility' => $this->faker->numberBetween( 0,3),
            'roles_support' => $this->faker->numberBetween( 0,3),
            'roles_siege' => $this->faker->numberBetween( 0,3),
            'roles_heal' => $this->faker->numberBetween( 0,3),
            'roles_mana' => $this->faker->numberBetween( 0,3),
            'roles_disable' => $this->faker->numberBetween( 0,3),
            'roles_resistance' => $this->faker->numberBetween( 0,3),
            'damage_pure' => $this->faker->numberBetween( 0,3),
            'damage_physical' => $this->faker->numberBetween( 0,3),
            'damage_magical' => $this->faker->numberBetween( 0,3),
        ];
    }
}
