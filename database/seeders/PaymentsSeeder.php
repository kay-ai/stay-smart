<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            Payment::create([
                'trx_ref' => Str::upper(Str::random(10)),
                'user_id' => $booking->user_id,
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'payment_method' => 'Credit Card',
                'status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Payment records created for all bookings with status "Completed".');
    }
}
