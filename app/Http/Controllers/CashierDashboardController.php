<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CashierDashboardController extends Controller
{
    /**
     * Display the list of active orders for the cashier.
     */
    public function index()
    {
        $cashier = Auth::guard('cashier')->user();

        // Ambil hanya order dengan status tertentu milik cashier yang sedang login
        $orders = Order::where('cashier_id', $cashier->cashier_id)
            ->whereIn('order_status_pesanan', ['Verifikasi Pembayaran', 'Sedang Di Proses'])
            ->get();

        return view('cashier', compact('orders'));
    }

    /**
     * *** NEW METHOD ***
     * Show the details for a single order.
     */
    public function showOrderDetail(Order $order)
    {
        // Authorization check: Ensure the cashier can only see orders from their own store.
        $cashier = Auth::guard('cashier')->user();
        if ($order->toko_id !== $cashier->toko_id) {
            abort(403, 'Anda tidak memiliki akses untuk melihat pesanan ini.');
        }

        // Eager load all necessary relationships and pass the order to the view.
        return view('cashier_detail', [
            'order' => $order->load('menus') // Eager load the menu items
        ]);
    }
}
