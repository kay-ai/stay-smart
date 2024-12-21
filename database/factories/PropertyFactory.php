<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company() . ' Apartment',
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'price_per_night' => fake()->randomFloat(2, 50, 500),
            'image_path' => 'apartments/apartment-img' . fake()->unique()->numberBetween(1, 10) . '.png',
            'status' => ['Pending', 'Available', 'Booked', 'Under Maintenance'][rand(0, 3)],
        ];
    }
}
