<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Pesanan - MyITS Canteen</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}" />
    <style>
      body {
        font-family: "Segoe UI", sans-serif;
      }

      .table-container {
        max-width: 1300px;
        margin: auto;
        margin-top: 50px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: 2px solid #1f79db;
      }

      .table thead tr th {
        background-color: #1f79db;
        color: white;
        text-align: center;
        font-size: 1.2rem;
        padding: 16px;
      }

      .table td {
        vertical-align: middle;
        text-align: center;
        font-size: 1.1rem;
        padding: 16px;
      }

      .nomor-meja {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 999px;
        padding: 6px 16px;
        display: inline-block;
        font-weight: bold;
      }

      .badge {
        font-size: 0.9rem;
        padding: 8px 12px;
        border-radius: 20px;
      }
    </style>
  </head>

  <body>
    <!-- Header -->
    <div class="header-bar">
      <!-- Logo -->
      <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />

      <!-- Text Tengah -->
      <div class="header-center">Halo, {{ $customer->customer_nama }}</div>

      <!-- Icon History & Logout -->
      <div class="header-icons">
        <div class="icon-item" onclick="window.location.href='/customer'">
          <i class="bi bi-house-door"></i>
          <span>Beranda</span>
        </div>
      </div>
    </div>

    <!-- Riwayat Pesanan -->
    <div class="container mb-5">
      <h5 class="fw-bold text-center mt-4">Riwayat Pesanan</h5>

      @if($orders->isEmpty())
        <div class="text-center text-muted mt-5">
          <i class="bi bi-clock-history fs-1 d-block"></i>
          Belum ada riwayat pesanan.
        </div>
      @else
        <div class="table-container mt-4">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Status Pembayaran</th>
                <th>Status Pemesanan</th>
                <th>No. Meja</th>
                <th>Total Harga</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ \Carbon\Carbon::parse($order->order_tanggal)->format('d M Y H:i') }}</td>
                  <td>
                    @if($order->order_status_pembayaran)
                      <span class="badge bg-success">Sudah Bayar</span>
                    @else
                      <span class="badge bg-danger">Belum Bayar</span>
                    @endif
                  </td>
                  <td>{{ $order->order_status_pesanan }}</td>
                  <td><span class="nomor-meja">{{ $order->order_no_meja }}</span></td>
                  <td>Rp {{ number_format($order->order_total_harga, 0, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
