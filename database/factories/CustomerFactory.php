<?php

// FILE: database/factories/CustomerFactory.php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_nama' => $this->faker->name(),
            'customer_email' => $this->faker->unique()->safeEmail(),
            'customer_no_telp' => $this->faker->numerify('08##########'),
            'customer_password' => Hash::make('customer123'),
        ];
    }
}