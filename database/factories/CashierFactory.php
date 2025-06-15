<?php
namespace Database\Factories;

use App\Models\Cashier;
use App\Models\Toko;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CashierFactory extends Factory
{
    protected $model = Cashier::class;

    public function definition(): array
    {
        return [
            'cashier_nama' => $this->faker->name(),
            'cashier_email' => $this->faker->unique()->safeEmail(),
            'cashier_no_telp' => $this->faker->phoneNumber(),
            'cashier_password' => Hash::make('password'),
            'toko_id' => Toko::factory(),
        ];
    }
}