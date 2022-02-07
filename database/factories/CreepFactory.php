<?php

namespace Database\Factories;

use App\Models\CreepType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreepFactory extends Factory
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
            'creep_type_id' => CreepType::all()->random()->id,

            'roles_gold' => $this->faker->numberBetween( 0,3),
            'roles_experience' => $this->faker->numberBetween( 0,3),
            'roles_dominate' => $this->faker->numberBetween( 0,3),
            'roles_early' => $this->faker->numberBetween( 0,3),
            'roles_mid' => $this->faker->numberBetween( 0,3),
            'roles_late' => $this->faker->numberBetween( 0,3),
            'roles_armor' => $this->faker->numberBetween( 0,3),
            'roles_magic_res' => $this->faker->numberBetween( 0,3),
            'roles_status_res' => $this->faker->numberBetween( 0,3),
            'damage_pure' => $this->faker->numberBetween( 0,3),
            'damage_physical' => $this->faker->numberBetween( 0,3),
            'damage_magical' => $this->faker->numberBetween( 0,3),
        ];
    }
}
