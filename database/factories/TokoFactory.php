<?php


namespace Database\Factories;

use App\Models\Admin;
use App\Models\Toko;
use Illuminate\Database\Eloquent\Factories\Factory;

class TokoFactory extends Factory
{
    protected $model = Toko::class;

    /**
     * A static variable to keep track of the toko number.
     * It will increment each time the factory is called.
     */
    private static $tokoCounter = 0;

    public function definition(): array
    {
        // Increment the counter before using it
        self::$tokoCounter++;
        
        // Use the modulo operator to create a repeating sequence from 1 to 5
        $imageNumber = (self::$tokoCounter - 1) % 5 + 1;

        return [
            'toko_nama' => $this->faker->company() . ' Canteen',
            'toko_no_rekening' => $this->faker->creditCardNumber(),
            
            'toko_gambar' => 'image/toko_' . $imageNumber . '.jpg',

            'admin_id' => Admin::inRandomOrder()->first()->admin_id,
        ];
    }
}