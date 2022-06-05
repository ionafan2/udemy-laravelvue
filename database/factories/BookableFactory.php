<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class BookableFactory extends Factory
{
    protected array $suffix = [
        'Cheap villa',
        'House',
        'Rooms',
        'Cottage'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->city . ' ' . Arr::random($this->suffix),
            'description' => $this->faker->paragraph(2, true),
            'price' => $this->faker->randomNumber(4)
        ];
    }
}
