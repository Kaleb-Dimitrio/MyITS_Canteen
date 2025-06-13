<?php

// FILE: database/factories/TokoFactory.php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Toko;
use Illuminate\Database\Eloquent\Factories\Factory;

class TokoFactory extends Factory
{
    protected $model = Toko::class;

    public function definition(): array
    {
        return [
            'toko_nama' => $this->faker->company() . ' Canteen',
            'toko_no_rekening' => $this->faker->creditCardNumber(),
            'toko_gambar' => $this->faker->imageUrl(640, 480, 'food'),
            'admin_id' => Admin::inRandomOrder()->first()->admin_id,
        ];
    }
}