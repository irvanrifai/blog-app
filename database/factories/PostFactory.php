<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => $this->faker->realTextBetween(10, 20, 1),
            'slug' => $this->faker->realTextBetween(10, 20, 1),
            'body' => $this->faker->realTextBetween(50, 300, 3),
            'user_id' => $this->faker->numberBetween(1, 5),
            'category_id' => $this->faker->numberBetween(1, 6),
        ];
    }
}
