<?php

namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        Bookable::all()->each(function (Bookable $bookable) {
            $booking = Booking::factory()->make();
            $bookings = collect([$booking]);

            for ($i =0; $i < random_int(1,20); $i++) {
                $startDate = (clone  $booking->endDate)->addDays(random_int(1,14));
                $endDate = (clone  $startDate)->addDays(random_int(0,14));

                $booking = Booking::factory()->make([
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'price' => random_int(200, 5000)
                ]);
                $bookings->push($booking);
            }

            $bookable->bookings()->saveMany($bookings);
        });
    }
}
