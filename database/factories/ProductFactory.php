<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->words(2, true), // e.g. "Vintage Jacket"
            'description' => $this->faker->sentence(10),
            'image' => 'https://picsum.photos/seed/' . $this->faker->unique()->numberBetween(1, 10000) . '/640/480',
            'price' => $this->faker->numberBetween(100000, 500000),
        ];
    }
}
