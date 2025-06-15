<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTokoController extends Controller
{
    /**
     * Display a list of all stores on the admin dashboard.
     */
    public function index()
    {
        $tokos = Toko::all();
        return view('admin', ['tokos' => $tokos]);
    }

    /**
     * Show the sales detail page for a specific store.
     */
    public function showDetail(Request $request, Toko $toko)
    {
        // 1. Get month and year from request, default to the current month and year.
        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);

        // 2. Start building the query based on the selected month and year.
        $ordersQuery = Order::with('cashier')
            ->where('toko_id', $toko->toko_id)
            ->whereYear('order_tanggal', $selectedYear)
            ->whereMonth('order_tanggal', $selectedMonth);

        // 3. Calculate the total sales for the filtered period.
        $totalPenjualanFiltered = $ordersQuery->clone()->sum(DB::raw('CAST(order_total_harga AS INTEGER)'));
        
        // 4. Calculate the total sales for all time for this specific store.
        $totalPenjualanAllTime = Order::where('toko_id', $toko->toko_id)->sum(DB::raw('CAST(order_total_harga AS INTEGER)'));

        // 5. Paginate the filtered results to show 10 orders per page.
        $orders = $ordersQuery->orderBy('order_tanggal', 'desc')->paginate(10);

        // 6. Pass all the necessary data to the view.
        return view('admin_toko_detail', [
            'toko' => $toko,
            'orders' => $orders,
            'totalPenjualanFiltered' => $totalPenjualanFiltered,
            'totalPenjualanAllTime' => $totalPenjualanAllTime,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]);
    }
    
    /**
     * Show the details for a single order.
     */
    public function showOrderDetail(Order $order)
    {
        return view('admin_order_detail', [
            'order' => $order->load('toko', 'cashier', 'menus')
        ]);
    }
}
