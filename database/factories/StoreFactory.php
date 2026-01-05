<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'image' => 'https://picsum.photos/400?random='.$this->faker->unique()->numberBetween(1, 100),
            'description' => $this->faker->sentence(10),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
        ];  
    }
}
