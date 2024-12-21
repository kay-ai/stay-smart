<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesAndBookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = Property::factory(10)->create();

        $users = User::all();

        if ($users->count() < 10) {
            $this->command->error('Not enough users available! Please seed at least 10 users before running this seeder.');
            return;
        }

        foreach ($properties as $property) {
            foreach (range(1, 4) as $index) {
                $randomUser = $users->random();

                $startDate = Carbon::now()->addDays(rand(1, 30));
                $endDate = (clone $startDate)->addDays(rand(2, 7));

                Booking::create([
                    'property_id' => $property->id,
                    'user_id' => $randomUser->id,
                    'status' => ['Confirmed', 'Pending', 'Cancelled'][rand(0, 2)],
                    'check_in_date' => $startDate,
                    'check_out_date' => $endDate,
                    'reference' => strtoupper(fake()->unique()->bothify('???-#####')),
                    'total_price' => $property->price_per_night * $startDate->diffInDays($endDate),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        $this->command->info('Seeded 10 properties with 4 bookings each.');
    }
}
