<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'jenis' => $this->faker->randomElement([
                'Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond'
            ]),
            'harga' => $this->faker->randomElement([
                50000, 100000, 150000, 200000, 500000
            ]),
        ];
    }
}