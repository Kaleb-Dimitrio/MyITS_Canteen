<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Toko - MyITS Canteen</title>

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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
  </head>

  <body class="bg-white">
    <!-- Logo -->
    <div class="logo-container">
      <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
    </div>

    <!-- Tabel Toko -->
    <div class="table-container bg-white">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>Nama Toko</th>
            <th>Total Penjualan <br /><small>(Opsional)</small></th>
            <th>Hapus Toko</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Ayam Geprek Bu Rudi</strong></td>
            <td>
              <button class="btn btn-primary btn-rounded">Lihat Detail</button>
            </td>
            <td>
              <button class="btn btn-hapus btn-rounded">
                <i class="bi bi-x-lg"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td><strong>Rawon Setan</strong></td>
            <td>
              <button class="btn btn-primary btn-rounded">Lihat Detail</button>
            </td>
            <td>
              <button class="btn btn-hapus btn-rounded">
                <i class="bi bi-x-lg"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td><strong>Ayam Geprek Jhodher</strong></td>
            <td>
              <button class="btn btn-primary btn-rounded">Lihat Detail</button>
            </td>
            <td>
              <button class="btn btn-hapus btn-rounded">
                <i class="bi bi-x-lg"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td><strong>Penyetan Mak Yeye</strong></td>
            <td>
              <button class="btn btn-primary btn-rounded">Lihat Detail</button>
            </td>
            <td>
              <button class="btn btn-hapus btn-rounded">
                <i class="bi bi-x-lg"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
