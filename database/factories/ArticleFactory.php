<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(150),
            'body' => $this->faker->text(3000),
            'author' => $this->faker->numberBetween(0,30),
            'views' => $this->faker->numberBetween(0,30),
        ];
    }
}
