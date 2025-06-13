<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Toko;

class TokoSeeder extends Seeder
{
    public function run(): void
    {
        Toko::factory()->count(20)->create();
    }
}