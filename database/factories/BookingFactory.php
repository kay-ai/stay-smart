<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = Carbon::now()->addDays(rand(1, 30));
        $endDate = (clone $startDate)->addDays(rand(2, 7));

        return [
            'property_id' => Property::factory(),
            'user_id' => User::factory(),
            'status' => ['Confirmed', 'Pending', 'Cancelled'][rand(0, 2)],
            'check_in_date' => $startDate,
            'check_out_date' => $endDate,
            'total_price' => fake()->randomFloat(2, 50, 500),
        ];
    }
}
