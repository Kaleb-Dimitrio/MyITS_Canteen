<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Kasir - MyITS Canteen</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/cashier.css') }}" />
</head>
<body class="bg-light">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center p-3 bg-white shadow-sm">
        <img src="{{ asset('image/logo-white.png') }}" alt="Logo" style="height: 50px;" />
        
        <!-- *** NEW BUTTON ADDED HERE *** -->
        <div class="d-flex gap-3">
            <a href="{{ route('cashier.edit') }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil-square"></i> Edit Menu
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-4 fw-bold">Daftar Pesanan</h4>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No. Meja</th>
                                <th>Total Harga</th>
                                <th>Detail</th>
                                <th>Verifikasi</th>
                                <th>Status</th>
                                <th>Selesaikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="bi bi-emoji-frown fs-3 d-block"></i>
                                        Belum ada pesanan hari ini
                                    </td>
                                </tr>
                            @else
                                @foreach ($orders as $order)
                                <tr id="order-row-{{ $order->order_id }}">
                                    <td>{{ $order->order_no_meja }}</td>
                                    <td class="harga">Rp. {{ number_format($order->order_total_harga, 0, ',', '.') }}</td>
                                    <td><button class="btn btn-primary btn-sm">Lihat Detail</button></td>
                                    <td class="verifikasi-td">
                                        @if ($order->order_status_pesanan === 'Verifikasi Pembayaran')
                                            <button class="btn btn-danger btn-sm me-1 btn-cancel" data-id="{{ $order->order_id }}">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                            <button class="btn btn-success btn-sm btn-approve" data-id="{{ $order->order_id }}">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        @elseif ($order->order_status_pesanan === 'Pesanan Dibatalkan')
                                            <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                                        @elseif ($order->order_status_pesanan === 'Sedang Di Proses')
                                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                        @elseif ($order->order_status_pesanan === 'Pesanan Selesai')
                                            <i class="bi bi-star-fill text-primary fs-4"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-white status-badge">{{ $order->order_status_pesanan }}</span>
                                    </td>
                                    <td class="selesai-td">
                                        @if ($order->order_status_pesanan === 'Sedang Di Proses')
                                            <button class="btn btn-warning btn-sm btn-selesai" data-id="{{ $order->order_id }}">
                                                <i class="bi bi-star"></i> Selesai
                                            </button>
                                        @elseif ($order->order_status_pesanan === 'Pesanan Selesai')
                                            <i class="bi bi-star-fill text-success fs-4"></i>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      const csrfToken = '{{ csrf_token() }}';

      function updateRowUI(orderId, status) {
        const row = document.querySelector(`#order-row-${orderId}`);
        if (!row) return;

        const statusBadge = row.querySelector('.status-badge');
        const verifikasiTd = row.querySelector('.verifikasi-td');
        const selesaiTd = row.querySelector('.selesai-td');
        const hargaTd = row.querySelector('.harga');

        if (status === 'Sedang Di Proses') {
          statusBadge.textContent = status;
          statusBadge.className = 'badge bg-success text-white status-badge';
          verifikasiTd.innerHTML = `<i class="bi bi-check-circle-fill text-success fs-4"></i>`;
          selesaiTd.innerHTML = `
            <button class="btn btn-warning btn-sm btn-selesai" data-id="${orderId}">
              <i class="bi bi-star"></i> Selesai
            </button>
          `;
          
          selesaiTd.querySelector('.btn-selesai')?.addEventListener('click', function () {
            fetch(`/cashier/order/${orderId}/done`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
              }
            })
            .then(res => res.json())
            .then(data => {
              if (data.success) {
                updateRowUI(orderId, 'Pesanan Selesai');
              }
            });
          });

        } else if (status === 'Pesanan Dibatalkan') {
          statusBadge.textContent = status;
          statusBadge.className = 'badge bg-danger text-white status-badge';
          verifikasiTd.innerHTML = `<i class="bi bi-x-circle-fill text-danger fs-4"></i>`;
          selesaiTd.innerHTML = '';
          if (hargaTd) hargaTd.textContent = 'Rp. 0';

        } else if (status === 'Pesanan Selesai') {
          row.remove(); // Hapus baris pesanan
        }
      }

      document.querySelectorAll('.btn-approve').forEach(button => {
        button.addEventListener('click', function () {
          const orderId = this.dataset.id;
          fetch(`/cashier/order/${orderId}/approve`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            }
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              updateRowUI(orderId, 'Sedang Di Proses');
            }
          });
        });
      });

      document.querySelectorAll('.btn-cancel').forEach(button => {
        button.addEventListener('click', function () {
          const orderId = this.dataset.id;
          fetch(`/cashier/order/${orderId}/cancel`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            }
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              updateRowUI(orderId, 'Pesanan Dibatalkan');
            }
          });
        });
      });

      document.querySelectorAll('.btn-selesai').forEach(button => {
        button.addEventListener('click', function () {
          const orderId = this.dataset.id;
          fetch(`/cashier/order/${orderId}/done`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            }
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              updateRowUI(orderId, 'Pesanan Selesai');
            }
          });
        });
      });
    });
    </script>
</body>
</html>
