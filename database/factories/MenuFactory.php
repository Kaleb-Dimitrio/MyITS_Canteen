<?php

// FILE: database/factories/MenuFactory.php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Toko;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        $categoryMap = [
            'Makan Berat' => 'makan_berat.jpg',
            'Minuman' => 'minuman.jpg',
            'Makan Kecil' => 'makan_kecil.jpg',
            'Makan Penutup' => 'makan_penutup.jpg',
        ];

        // Randomly pick one of the categories
        $randomCategory = $this->faker->randomElement(array_keys($categoryMap));
        
        // Get the corresponding image for the chosen category
        $imageFile = $categoryMap[$randomCategory];

        return [
            'menu_nama' => ucwords($this->faker->words(2, true)),
            'menu_harga' => $this->faker->numberBetween(5000, 40000),
            'menu_stok' => $this->faker->numberBetween(0, 100),
            
            // Set the image path based on the category
            'menu_gambar' => 'image/' . $imageFile,
            
            // Set the category
            'menu_kategori' => $randomCategory,

            // The toko_id will be set by the seeder.
            'toko_id' => Toko::factory(), 
        ];
    }
}