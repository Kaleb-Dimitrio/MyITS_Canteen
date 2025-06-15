<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        // The factory now only defines the most basic, random data.
        // The specific status logic will be handled by the seeder.
        return [
            'order_tanggal' => $this->faker->dateTimeThisYear(),
            'order_total_harga' => 0, // This will be calculated and updated by the seeder
            'order_no_meja' => $this->faker->numberBetween(1, 100),
        ];
    }
}
