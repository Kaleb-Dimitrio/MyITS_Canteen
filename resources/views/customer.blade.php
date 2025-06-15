<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Toko - MyITS Canteen</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />
    <!-- Custom CSS -->
 <link rel="stylesheet" href="{{ asset('css/customer.css') }}" />

  </head>

  <body>
    <!-- Header -->
    <div class="header-bar">
      <!-- Logo -->
      <img src="image/logo-white.png" alt="MyITS Canteen" style="width: 80px" />

      <!-- Text Tengah -->
      <div class="header-center">Halo, {{ $customer->customer_nama }}</div>

      <!-- Icon History & Logout -->
      <div class="header-icons">
        <div class="icon-item" onclick="window.location.href='/history'">
          <i class="bi bi-clock-history"></i>
          <span>History</span>
        </div>
        <div class="icon-item" onclick="window.location.href='/logout'">
    
          <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-link text-dark text-decoration-none p-0 m-0">
          <i class="bi bi-box-arrow-left"></i>
        </button>
    </form>
          <span>Logout</span>
        </div>
      </div>
    </div>


    <!-- Pencarian -->
<div class="container mb-3 mt-3">
  <form method="GET" action="{{ route('customer.dashboard') }}">
    <input
      type="text"
      name="search"
      class="form-control"
      placeholder="Cari Toko"
      value="{{ request('search') }}"
    />
  </form>
</div>


    <!-- Daftar Toko -->
    <div class="container mb-5">
      <h5 class="fw-bold">Toko</h5>
      <div class="row row-cols-2 row-cols-md-4 g-4">
        @foreach ($tokos as $toko)
  <div class="col">
    <button class="toko-btn" onclick="window.location.href='{{ route('customer.menu', ['toko' => $toko->toko_id]) }}'">
      <div class="card shadow-sm h-100">
        <img src="{{ asset('storage/' . $toko->toko_gambar) }}" class="card-img-top" alt="{{ $toko->toko_nama }}" />
        <div class="card-body text-center">
          <p class="card-text mb-0">{{ $toko->toko_nama }}</p>
        </div>
      </div>
    </button>
  </div>
@endforeach

        <!-- Tambahkan toko lainnya di sini -->
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
