<?php

namespace Database\Factories;

use App\Models\OtherFlags;
use Illuminate\Database\Eloquent\Factories\Factory;

class OtherFactory extends Factory
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
            'other_flags_id' => OtherFlags::all()->random()->id,
            'description' => $this->faker->text(2000),
        ];
    }
}
