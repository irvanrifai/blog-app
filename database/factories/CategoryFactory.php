<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['General', 'Web App', 'Mobile App', 'Desktop App', 'Software', 'Tips & Trick']),
            'slug' => $this->faker->realTextBetween(10, 20, 1),
        ];
    }
}
