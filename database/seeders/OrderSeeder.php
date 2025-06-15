<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Toko;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Get all customers and stores to work with
        $customers = Customer::all();
        $tokos = Toko::with('menus', 'cashiers')->get(); // Eager load menus and cashiers for efficiency

        if ($tokos->isEmpty()) {
            $this->command->info('No stores, cashiers, or menus found. Skipping order seeding.');
            return;
        }

        // Loop through every customer
        foreach ($customers as $customer) {
            // Create a random number of orders (1 to 5) for each customer
            $numberOfOrders = rand(1, 5);

            for ($i = 0; $i < $numberOfOrders; $i++) {
                // *** NEW LOGIC START ***
                // Define the possible statuses and choose one randomly.
                $possibleStatuses = ['Pesanan Selesai', 'Pesanan Dibatalkan'];
                $orderStatus = $possibleStatuses[array_rand($possibleStatuses)];

                // Set the payment status based on the order status.
                $paymentStatus = ($orderStatus === 'Pesanan Selesai'); // This will be true or false
                // *** NEW LOGIC END ***

                // Assign the order to a random store
                $randomToko = $tokos->random();
                
                if ($randomToko->cashiers->isEmpty() || $randomToko->menus->isEmpty()) {
                    continue; // Skip if this store has no staff or items
                }

                // Assign a random cashier from THAT specific store
                $randomCashier = $randomToko->cashiers->random();

                // Create the initial order record with the new status logic
                $order = Order::factory()->create([
                    'customer_id' => $customer->customer_id,
                    'toko_id' => $randomToko->toko_id,
                    'cashier_id' => $randomCashier->cashier_id,
                    'order_status_pesanan' => $orderStatus,
                    'order_status_pembayaran' => $paymentStatus,
                ]);

                // Attach menu items only to orders that are not cancelled
                if ($orderStatus !== 'Pesanan Dibatalkan') {
                    $numberOfMenuItems = rand(1, 4);
                    $menuItems = $randomToko->menus->random($numberOfMenuItems);
                    
                    $totalPrice = 0;

                    foreach ($menuItems as $menuItem) {
                        $quantity = rand(1, 3);
                        $subtotal = $menuItem->menu_harga * $quantity;
                        $totalPrice += $subtotal;

                        $order->menus()->attach($menuItem->menu_id, ['kuantitas' => $quantity]);
                    }

                    $order->update(['order_total_harga' => $totalPrice]);
                }
            }
        }
    }
}