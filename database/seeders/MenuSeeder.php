<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Toko;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Get all the stores we've created
        $tokos = Toko::all();

        if ($tokos->isEmpty()) {
            $this->command->info('No stores found, skipping menu seeding.');
            return;
        }

        // Loop through each store and create 20 menu items for it
        foreach ($tokos as $toko) {
            Menu::factory()->count(20)->create([
                'toko_id' => $toko->toko_id,
            ]);
        }
    }
}