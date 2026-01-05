<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'category_id' => Category::factory(),
            'name' => $this->faker->words(3, true),
            'slug' => Str::slug($this->faker->unique()->words(3, true) . '-' . $this->faker->unique()->numberBetween(1, 9999)),
            'description' => $this->faker->sentence(12),
            'image' => null,
            'price' => $this->faker->randomFloat(2, 80, 600),
            'stock_quantity' => $this->faker->numberBetween(5, 50),
            'is_featured' => $this->faker->boolean(20),
        ];
    }
}
