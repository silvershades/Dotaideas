<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HeroFactory extends Factory
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
            'primary_attribute' => $this->faker->randomElement(['1', '2', '3']),
            'attack_type' => $this->faker->randomElement(['1', '2']),
            'complexity' => $this->faker->randomElement(['1', '2', '3']),
            'strength' => $this->faker->numberBetween(5,30),
            'agility' => $this->faker->numberBetween(5,30),
            'intelligence' => $this->faker->numberBetween(5,30),
            'lvlup_strength' => $this->faker->numberBetween(1,4),
            'lvlup_agility' => $this->faker->numberBetween(1,4),
            'lvlup_intelligence' => $this->faker->numberBetween(1,4),
            'attack_damage_min' => $this->faker->randomFloat(1,30,60),
            'attack_damage_max' => $this->faker->randomFloat(1,60,80),
            'attack_ias' => $this->faker->numberBetween(100,130),
            'attack_bat' => $this->faker->randomFloat(1,1,3),
            'attack_range' => $this->faker->numberBetween(50,1200),
            'attack_projectile_speed' => $this->faker->numberBetween(500,900),
            'defense_armor' => $this->faker->numberBetween(0,15),
            'defense_magic_resistance' => $this->faker->numberBetween(25,30),
            'mobility_speed' => $this->faker->numberBetween(280,360),
            'mobility_turn_rate' => $this->faker->randomFloat(1,0.1,2),
            'mobility_vision_day' => "1800",
            'mobility_vision_night' => "800",

            'roles_carry' => $this->faker->numberBetween( 0,3),
            'roles_support' => $this->faker->numberBetween( 0,3),
            'roles_nuker' => $this->faker->numberBetween( 0,3),
            'roles_disabler' => $this->faker->numberBetween( 0,3),
            'roles_jungler' => $this->faker->numberBetween( 0,3),
            'roles_durable' => $this->faker->numberBetween( 0,3),
            'roles_escape' => $this->faker->numberBetween( 0,3),
            'roles_pusher' => $this->faker->numberBetween( 0,3),
            'roles_initiator' => $this->faker->numberBetween( 0,3),
            'strengths_team_fight' => $this->faker->numberBetween( 0,3),
            'strengths_farm' => $this->faker->numberBetween( 0,3),
            'strengths_split_push' => $this->faker->numberBetween( 0,3),
            'strengths_siege' => $this->faker->numberBetween( 0,3),
            'strengths_base_defense' => $this->faker->numberBetween( 0,3),
            'strengths_roshan' => $this->faker->numberBetween( 0,3),
            'damage_pure' => $this->faker->numberBetween( 0,3),
            'damage_physical' => $this->faker->numberBetween( 0,3),
            'damage_magical' => $this->faker->numberBetween( 0,3),

            'description' => $this->faker->text(2000),
            'lore' =>  $this->faker->text(2000),

            'talent_25_left' => "+8 armor",
            'talent_25_right' => "+8 armor",
            'talent_20_left' => "+8 armor",
            'talent_20_right' => "+8 armor",
            'talent_15_left' => "+8 armor",
            'talent_15_right' =>"+8 armor",
            'talent_10_left' => "+8 armor",
            'talent_10_right' => "+8 armor",
        ];
    }
}
