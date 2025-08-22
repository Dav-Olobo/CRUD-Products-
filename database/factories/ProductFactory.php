<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true), 
            'price' => $this->faker->randomFloat(2, 10, 500), // 10.00 - 500.00
            'image' => $this->faker->imageUrl(400, 300, 'products', true),
            'description' => $this->faker->sentence(10),
            'user_id' => User::factory(), // each product belongs to a user
        ];
    }
}
