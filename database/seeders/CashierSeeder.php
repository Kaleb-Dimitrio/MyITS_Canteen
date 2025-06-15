<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cashier;
use App\Models\Toko;

class CashierSeeder extends Seeder
{
    public function run(): void
    {
        // Get all the Toko models that were just created.
        $tokos = Toko::all();

        foreach ($tokos as $toko) {
            Cashier::factory()->create([
                'toko_id' => $toko->toko_id,
            ]);
        }
    }
}