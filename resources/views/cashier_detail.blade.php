<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ringkasan Pesanan #{{ $order->order_id }} - MyITS Canteen</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/cashier_detail.css') }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-white">
    <!-- Logo -->
    <div class="text-left my-4" style="margin-left: 2rem">
        <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
    </div>

    <!-- Order Info Summary -->
    <div class="px-4 mb-3">
        <h4>Detail Pesanan #{{ $order->order_id }}</h4>
        <p class="text-muted mb-1">Tanggal Pesanan: {{ $order->order_tanggal->format('d F Y, H:i') }}</p>
        <p class="text-muted mb-1">No. Meja: {{ $order->order_no_meja }}</p>
    </div>

    <!-- Order Table -->
    <div class="table-container bg-white">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th class="text-start ps-4">Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th class="text-end pe-4">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($order->menus as $menu)
                <tr>
                    <td class="text-start ps-4">
                        <img
                            src="{{ asset('storage/' . $menu->menu_gambar) }}"
                            alt="{{ $menu->menu_nama }}"
                            class="me-2 align-middle rounded"
                            style="width: 50px; height: 50px; object-fit: cover;"
                        />
                        {{ $menu->menu_nama }}
                    </td>
                    <td>Rp. {{ number_format($menu->menu_harga, 0, ',', '.') }}</td>
                    <td><span class="quantity">{{ $menu->pivot->kuantitas }}</span></td>
                    <td class="text-end pe-4">Rp. {{ number_format($menu->menu_harga * $menu->pivot->kuantitas, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4">Tidak ada item dalam pesanan ini.</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="fw-bold">
                    <td colspan="3" class="text-end ps-4">Total Harga Pesanan:</td>
                    <td class="text-end pe-4">Rp. {{ number_format($order->order_total_harga, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Button -->
        <button class="back-button" onclick="window.location.href='{{ route('cashier.dashboard') }}'">
            KEMBALI KE DAFTAR PESANAN
        </button>
    </div>
</body>
</html>
