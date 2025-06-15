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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
  </head>

  <body class="bg-white">
<!-- Header Bar -->
<div class="header-bar d-flex justify-content-between align-items-center px-4 pt-4">
  <!-- Logo -->
  <div class="logo-container">
    <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
  </div>

  <!-- Icon Group (Edit & Logout) -->
  <div class="d-flex align-items-center gap-4" style="transform: translateX(-2rem);">
    <!-- Edit Icon -->
    <div class="text-center">
      <a href="{{ route('admin.edit') }}" class="text-decoration-none text-dark">
        <i class="bi bi-pencil-square fs-2 d-block"></i>
        <div style="font-weight: bold;">EDIT</div>
      </a>
    </div>

    <!-- Logout Icon -->
    <div class="text-center">
      <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-link text-dark text-decoration-none p-0 m-0">
          <i class="bi bi-box-arrow-left fs-2 d-block"></i>
          <div style="font-weight: bold;">LOGOUT</div>
        </button>
      </form>
    </div>
  </div>
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
          @foreach($tokos as $toko)
          <tr>
            <td><strong>{{ $toko->toko_nama }}</strong></td>
            <td>
              <a href="{{ route('admin.toko.detail', $toko->toko_id) }}" class="btn btn-primary btn-rounded">Lihat Detail</a>
            </td>
            <td>
              <form action="{{ route('admin.toko.delete', $toko->toko_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus toko ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-hapus btn-rounded">
                  <i class="bi bi-x-lg"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>
