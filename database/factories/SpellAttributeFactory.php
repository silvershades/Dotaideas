<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpellAttributeFactory extends Factory
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
            'value' => $this->faker->randomNumber(3),
        ];
    }
}
