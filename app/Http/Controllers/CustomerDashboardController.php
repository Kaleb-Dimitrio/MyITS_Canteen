<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Toko;
use App\Models\Menu;

class CustomerDashboardController extends Controller
{
    public function index(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $search = $request->input('search');

        $tokos = Toko::query()
            ->when($search, function ($query, $search) {
                $query->where('toko_nama', 'like', "%{$search}%")
                      ->orWhere('toko_gambar', 'like', "%{$search}%");
            })
            ->get();

        return view('customer', compact('customer', 'tokos'));
    }

    public function showMenu(Request $request, Toko $toko)
{
    $search = $request->query('search');
    $kategoriFilter = $request->query('kategori', []);
    $hargaFilter = $request->query('harga', []);

    $menus = Menu::where('toko_id', $toko->toko_id)
        ->when($search, function ($query, $search) {
            return $query->where('menu_nama', 'LIKE', '%' . $search . '%');
        })
        ->when(!empty($kategoriFilter), function ($query) use ($kategoriFilter) {
            return $query->whereIn('menu_kategori', $kategoriFilter);
        })
        ->when(!empty($hargaFilter), function ($query) use ($hargaFilter) {
            $query->where(function ($q) use ($hargaFilter) {
                foreach ($hargaFilter as $harga) {
                    if ($harga === 'lt10') {
                        $q->orWhere('menu_harga', '<', 10000);
                    } elseif ($harga === '10to20') {
                        $q->orWhereBetween('menu_harga', [10000, 20000]);
                    } elseif ($harga === 'gt20') {
                        $q->orWhere('menu_harga', '>', 20000);
                    }
                }
            });
        })
        ->get();

    return view('customer_menu', [
        'toko' => $toko,
        'menus' => $menus,
        'customer' => auth('customer')->user(),
    ]);
}

public function history()
{
    $customer = auth()->user(); // pelanggan yang login
    $orders = \App\Models\Order::where('customer_id', $customer->customer_id)
                ->orderBy('order_tanggal', 'desc')
                ->get();

    return view('customer_history', compact('customer', 'orders'));
}


}
