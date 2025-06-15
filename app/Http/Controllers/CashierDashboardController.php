<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CashierDashboardController extends Controller
{
    public function index()
    {
        $cashier = Auth::guard('cashier')->user();

        // Ambil hanya order dengan status tertentu milik cashier yang sedang login
        $orders = Order::where('cashier_id', $cashier->cashier_id)
            ->whereIn('order_status_pesanan', ['Verifikasi Pembayaran', 'Sedang Di Proses'])
            ->get();

        return view('cashier', compact('orders'));
    }
}
