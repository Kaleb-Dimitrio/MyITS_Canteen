<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Penjualan Toko - MyITS Canteen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin_edit.css') }}" />
</head>
<body class="bg-white">
    <!-- Header Bar -->
    <div class="header-bar d-flex justify-content-between align-items-center px-4 pt-4">
        <div class="logo-container">
            <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
        </div>
        <div class="edit-icon text-center">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-dark">
                <i class="bi bi-house-door fs-2"></i>
                <div style="font-weight: bold;">HOME</div>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-4">
        <div class="table-container bg-white">
            <div class="table-header text-white px-4 py-3">
                <h5 class="mb-0">Detail Penjualan: {{ $toko->toko_nama }}</h5>
            </div>

            <div class="p-4">
                <!-- Month and Year Filter Form -->
                <form method="GET" action="{{ route('admin.toko.detail', $toko->toko_id) }}" class="mb-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-5">
                            <label for="month" class="form-label">Bulan</label>
                            <select class="form-select" id="month" name="month">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="year" class="form-label">Tahun</label>
                            <select class="form-select" id="year" name="year">
                                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                    <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>

                <!-- Sales Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Pesanan</th>
                                <th>Nama Kasir</th>
                                <th>Status Pesanan</th>
                                <th class="text-end">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.order.detail', $order->order_id) }}">{{ $order->order_tanggal->format('d M Y, H:i') }}</a></td>
                                    <td>{{ $order->cashier->cashier_nama ?? 'N/A' }}</td>
                                    <td>
                                        @if($order->order_status_pesanan == 'Pesanan Selesai')
                                            <span class="badge bg-success">{{ $order->order_status_pesanan }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $order->order_status_pesanan }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end">Rp. {{ number_format($order->order_total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada data penjualan untuk bulan dan tahun ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <!-- *** THIS SECTION IS FIXED *** -->
                            <tr>
                                <th colspan="3" class="text-end">Total Penjualan (Bulan):</th>
                                <th class="text-end">Rp. {{ number_format($totalPenjualanFiltered, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Total Penjualan (Keseluruhan):</th>
                                <th class="text-end">Rp. {{ number_format($totalPenjualanAllTime, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
