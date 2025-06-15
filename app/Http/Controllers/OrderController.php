<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Menu;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Store a newly created order and its items.
     */
    public function store(Request $request)
    {
        // Get the currently authenticated customer
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
        }
        
        // Validate the incoming data, including the cart
        $validated = $request->validate([
            'toko_id' => 'required|integer|exists:toko,toko_id',
            'no_meja' => 'required|string|max:255',
            'cart' => 'required|array',
            'cart.*.jumlah' => 'required|integer|min:1',
            'cart.*.harga' => 'required|integer'
        ]);

        // Recalculate total price on the backend for security
        $totalPrice = 0;
        foreach ($validated['cart'] as $item) {
            $totalPrice += $item['harga'] * $item['jumlah'];
        }

        // 1. Create the main order record
        $order = Order::create([
            'order_tanggal' => now(),
            'order_total_harga' => $totalPrice,
            'order_status_pesanan' => 'Verifikasi Pembayaran',
            'order_no_meja' => $validated['no_meja'],
            'order_status_pembayaran' => false,
            'customer_id' => $customer->customer_id,
            'toko_id' => $validated['toko_id'],
            'cashier_id' => $validated['toko_id'], // This should probably be assigned to a real cashier later
        ]);

        // 2. Loop through cart items and attach them to the order
        foreach ($validated['cart'] as $menuId => $itemDetails) {
            // Attach the menu item with its quantity to the 'menu_order' pivot table
            $order->menus()->attach($menuId, ['kuantitas' => $itemDetails['jumlah']]);
        }
        
        return response()->json(['success' => true, 'order_id' => $order->order_id]);
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'order_status_pesanan' => 'Sedang Di Proses',
            'order_status_pembayaran' => true
        ]);
        return response()->json(['success' => true]);
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'order_status_pesanan' => 'Pesanan Dibatalkan',
            'order_status_pembayaran' => false,
            'order_total_harga' => 0
        ]);
        return response()->json(['success' => true]);
    }

    public function done($id)
    {
        // Find the order and load its related menu items
        $order = Order::with('menus')->findOrFail($id);

        if ($order->order_status_pesanan !== 'Sedang Di Proses') {
            return response()->json(['success' => false, 'message' => 'Hanya bisa menyelesaikan pesanan yang sedang diproses']);
        }
        
        // Loop through each menu item in the order
        foreach ($order->menus as $menu) {
            $orderedQuantity = $menu->pivot->kuantitas;

            $menuItemToUpdate = Menu::find($menu->menu_id);
            if ($menuItemToUpdate) {
                // Deduct the stock and save the change
                $menuItemToUpdate->menu_stok -= $orderedQuantity;
                $menuItemToUpdate->save();
            }
        }

        // Update the order status to 'Selesai'
        $order->update([
            'order_status_pesanan' => 'Pesanan Selesai'
        ]);

        return response()->json(['success' => true]);
    }
}
