<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentReplyFactory extends Factory
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
            'post_id' => 1,
            'message' => $this->faker->text(150),
            'likes' => $this->faker->numberBetween(0,30),
        ];
    }
}
