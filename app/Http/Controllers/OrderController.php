<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
  public function store(Request $request)
{
    $customer = Auth::guard('customer')->user();

    $validated = $request->validate([
        'total_harga' => 'required|numeric',
        'toko_id' => 'required|integer',
        'no_meja' => 'required|string',
    ]);

    Order::create([
        'order_tanggal' => now(),
        'order_total_harga' => $validated['total_harga'],
        'order_status_pesanan' => 'Sedang Di Check',
        'order_no_meja' => $validated['no_meja'],
        'order_status_pembayaran' => false,
        'customer_id' => $customer->customer_id,
        'toko_id' => $validated['toko_id'],
        'cashier_id' => $validated['toko_id'], // 👈 langsung disamakan
    ]);

    return response()->json(['success' => true]);
}
}

