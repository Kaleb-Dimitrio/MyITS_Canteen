<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cashier Page - MyITS Canteen</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Bootstrap Icons -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/cashier.css') }}" />
  </head>
  <body class="bg-white">
    <div class="text-left my-4" style="margin-left: 2rem">
      <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
    </div>

    <div class="table-container bg-white">
      <table class="table mb-0">
        <thead>
          <tr>
            <th></th>
            <th>No. Meja</th>
            <th>Total Harga</th>
            <th>Detail Pesanan</th>
            <th>Verifikasi Pembayaran</th>
            <th>Status Pesanan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <button class="btn btn-outline-danger btn-sm">
                <i class="bi bi-x-lg"></i>
              </button>
            </td>

            <td><span class="nomor-meja">56</span></td>
            <td>Rp. 17.000</td>
            <td>
              <button class="btn btn-primary fw-bold">Lihat Detail</button>
            </td>
            <td>
              <button class="btn btn-danger me-1">
                <i class="bi bi-x-lg"></i>
              </button>
              <button class="btn btn-success">
                <i class="bi bi-check-lg"></i>
              </button>
            </td>
            <td>
              <button class="btn btn-info text-white fw-bold">
                Pesanan Selesai
              </button>
            </td>
          </tr>
          <tr>
            <td>
              <button class="btn btn-outline-danger btn-sm">
                <i class="bi bi-x-lg"></i>
              </button>
            </td>
            <td><span class="nomor-meja">16</span></td>
            <td>Rp. 6.000</td>
            <td>
              <button class="btn btn-primary fw-bold">Lihat Detail</button>
            </td>
            <td>
              <button class="btn btn-danger me-1">
                <i class="bi bi-x-lg"></i>
              </button>
              <button class="btn btn-success">
                <i class="bi bi-check-lg"></i>
              </button>
            </td>
            <td>
              <button class="btn btn-info text-white fw-bold">
                Pesanan Selesai
              </button>
            </td>
          </tr>
          <tr>
            <td>
              <button class="btn btn-outline-danger btn-sm">
                <i class="bi bi-x-lg"></i>
              </button>
            </td>
            <td><span class="nomor-meja">16</span></td>
            <td>Rp. 6.000</td>
            <td>
              <button class="btn btn-primary fw-bold">Lihat Detail</button>
            </td>
            <td>
              <button class="btn btn-danger me-1">
                <i class="bi bi-x-lg"></i>
              </button>
              <button class="btn btn-success">
                <i class="bi bi-check-lg"></i>
              </button>
            </td>
            <td>
              <button class="btn btn-info text-white fw-bold">
                Pesanan Selesai
              </button>
            </td>
          </tr>
          <!-- Tambahkan baris lainnya di sini -->
        </tbody>
      </table>
    </div>
  </body>
</html>
