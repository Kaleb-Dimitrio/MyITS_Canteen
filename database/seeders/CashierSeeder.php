<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cashier;

class CashierSeeder extends Seeder
{
    public function run(): void
    {
        Cashier::factory()->count(20)->create();
    }
}