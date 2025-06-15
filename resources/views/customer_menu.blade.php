<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Menu Makanan - MyITS Canteen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('css/customer_menu.css') }}" />
  </head>
  <body>
    <header class="header-bar">
      <button onclick="localStorage.clear(); window.location.href='{{ route('customer.dashboard') }}'" style="border: none; background: none; padding: 0;">
  <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 60px" />
</button>

      <div class="header-center">Halo, {{ $customer->customer_nama ?? 'User' }}</div>

      <div class="header-icons">
        <div class="icon-item">
          <button class="btn btn-primary btn-lg bayar-btn" id="bayarBtn">Bayar</button>
        </div>
        <div class="icon-item" onclick="window.location.href='/logout'">
          <i class="bi bi-box-arrow-left"></i>
          <span>Logout</span>
        </div>
        <div class="icon-item" onclick="window.location.href='/history'">
          <i class="bi bi-clock-history"></i>
          <span>History</span>
        </div>
      </div>
    </header>
    
    <div class="container-fluid main-content">
      <div class="row">
        <aside class="col-lg-3 sidebar">
  <form id="filterForm" method="GET" action="{{ route('customer.menu', $toko->toko_id) }}">
    {{-- Filter Kategori --}}
    <div class="filter-section mb-4">
      <h5 class="filter-title">Kategori</h5>
      @php
        $kategoriList = ['Makan Berat', 'Minuman', 'Makan Kecil', 'Makan Penutup'];
        $kategoriDipilih = request()->input('kategori', []);
      @endphp
      @foreach($kategoriList as $kategori)
        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            name="kategori[]"
            value="{{ $kategori }}"
            id="kategori{{ $loop->index }}"
            onchange="document.getElementById('filterForm').submit();"
            {{ in_array($kategori, $kategoriDipilih) ? 'checked' : '' }}
          >
          <label class="form-check-label" for="kategori{{ $loop->index }}">
            {{ $kategori }}
          </label>
        </div>
      @endforeach
    </div>

    {{-- Filter Harga --}}
    <div class="filter-section">
      <h5 class="filter-title">Rentang Harga</h5>
      @php
        $hargaOptions = [
          'lt10' => 'Kurang dari 10.000',
          '10to20' => '10.000 - 20.000',
          'gt20' => 'Lebih dari 20.000'
        ];
        $hargaDipilih = request()->input('harga', []);
      @endphp
      @foreach($hargaOptions as $key => $label)
        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            name="harga[]"
            value="{{ $key }}"
            id="harga{{ $loop->index }}"
            onchange="document.getElementById('filterForm').submit();"
            {{ in_array($key, $hargaDipilih) ? 'checked' : '' }}
          >
          <label class="form-check-label" for="harga{{ $loop->index }}">
            {{ $label }}
          </label>
        </div>
      @endforeach
    </div>
  </form>
</aside>


        <main class="col-lg-9 menu-container">
          <h1 class="menu-heading">Mau makan apa hari ini di {{ $toko->toko_nama }}?</h1>

          <!-- search bar -->
<form method="GET" action="{{ route('customer.menu', $toko->toko_id) }}">
  <div class="input-group mb-4 search-bar">
    <span class="input-group-text bg-white border-end-0">
      <i class="bi bi-search"></i>
    </span>
    <input
      type="text"
      name="search"
      class="form-control border-start-0"
      placeholder="Cari menu"
      value="{{ request('search') }}"
    />
  </div>
</form>

<!-- Menu -->
          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @forelse($menus as $menu)
  <div class="col">
    <div class="card h-100 menu-card">
      <img src="{{ asset('storage/' . $menu->menu_gambar) }}" class="card-img-top" alt="{{ $menu->menu_nama }}">
      <div class="card-body">
        <h5 class="card-title">{{ $menu->menu_nama }}</h5>
        <p class="card-text">Rp. {{ number_format($menu->menu_harga, 0, ',', '.') }}</p>
        <!-- <p class="text-muted">Stok: {{ $menu->menu_stok }}</p> -->
      </div>
      <div class="card-footer bg-transparent border-0 text-end">
  <div class="quantity-selector d-inline-flex align-items-center" data-menu-id="{{ $menu->menu_id }}">
    <button class="btn btn-outline-danger rounded-circle minus-button d-none">-</button>
    <span class="mx-2 quantity-count d-none">0</span>
    <button class="btn btn-outline-primary rounded-circle add-button">+</button>
  </div>
</div>

    </div>
  </div>
@empty
  <div class="col-12">
    @if(request('search'))
      <p class="text-danger text-center">Menu dengan nama "{{ request('search') }}" tidak ditemukan.</p>
    @else
      <p class="text-muted text-center">Belum ada menu tersedia di toko ini.</p>
    @endif
  </div>
@endforelse
          </div>
        </main>
      </div>
    </div>
    <!-- yang ngatur (+) dan (-) di menu bagian bawah -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const selectors = document.querySelectorAll('.quantity-selector');
    
    selectors.forEach(selector => {
      const menuId = selector.dataset.menuId;
      const addButton = selector.querySelector('.add-button');
      const minusButton = selector.querySelector('.minus-button');
      const countSpan = selector.querySelector('.quantity-count');

      let count = parseInt(localStorage.getItem(`menu_${menuId}`)) || 0;

      if (count > 0) {
        minusButton.classList.remove('d-none');
        countSpan.classList.remove('d-none');
        countSpan.textContent = count;
      }

      addButton.addEventListener('click', () => {
        count++;
        localStorage.setItem(`menu_${menuId}`, count);
        minusButton.classList.remove('d-none');
        countSpan.classList.remove('d-none');
        countSpan.textContent = count;
      });

      minusButton.addEventListener('click', () => {
        if (count > 0) {
          count--;
          if (count === 0) {
            minusButton.classList.add('d-none');
            countSpan.classList.add('d-none');
            localStorage.removeItem(`menu_${menuId}`);
          } else {
            localStorage.setItem(`menu_${menuId}`, count);
            countSpan.textContent = count;
          }
        }
      });
    });
  });
</script>

<!-- bagian simpaan biar pas pencet bayar bisa masuk -->
<script>
  document.getElementById('bayarBtn').addEventListener('click', () => {
    const cart = {};
    const menus = document.querySelectorAll('.quantity-selector');

    menus.forEach(selector => {
      const menuId = selector.dataset.menuId;
      const nama = selector.closest('.menu-card').querySelector('.card-title').innerText;
      const hargaText = selector.closest('.menu-card').querySelector('.card-text').innerText.replace(/[^\d]/g, '');
      const harga = parseInt(hargaText);
      const jumlah = parseInt(localStorage.getItem(`menu_${menuId}`)) || 0;

      if (jumlah > 0) {
        cart[menuId] = { nama, harga, jumlah };
      }
    });

    localStorage.setItem('cart', JSON.stringify(cart));
    window.location.href = "/customer/order";
  });
</script>

<!-- menyimpan toko yang dipilih -->

<script>
  // Simpan data toko ke localStorage, termasuk ID
  localStorage.setItem('selectedToko', JSON.stringify({
    id: {{ $toko->toko_id }},
    nama: "{{ $toko->toko_nama }}",
    no_rekening: "{{ $toko->toko_no_rekening }}"
  }));
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>