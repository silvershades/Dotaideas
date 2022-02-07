<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'user_id' => User::all()->random()->id,
            'is_active' => true,
            'is_flagged' => false,
            'is_pinned' => false,
            'views' =>  $this->faker->randomNumber(3)
        ];

    }
}

