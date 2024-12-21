<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amenity>
 */
class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Wi-Fi', 'Pool', 'Air Conditioning', 'Gym',
                'Parking', 'Pet Friendly', 'Laundry Service',
                'Kitchen', 'TV', 'Heating', 'Balcony', 'Garden'
            ]),
        ];
    }
}
