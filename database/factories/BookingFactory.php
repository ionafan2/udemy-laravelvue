<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $startDate = Carbon::instance($this->faker->dateTimeBetween('-1 months', '+1 month'));
        $endDate = (clone $startDate)->addDays(random_int(0, 14));

        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'price' => random_int(200, 5000)
        ];
    }
}
