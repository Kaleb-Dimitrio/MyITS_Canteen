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
      <img src="image/logo-white.png" alt="MyITS Canteen" style="height: 50px;" />

      <div class="header-center">Halo, User</div>

      <div class="header-icons">
        <div class="icon-item">
          <button class="btn btn-primary btn-lg bayar-btn">Bayar</button>
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
          <div class="filter-section">
            <h5 class="filter-title">Kategori</h5>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="kategoriMakanBerat">
              <label class="form-check-label" for="kategoriMakanBerat">Makan Berat</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="kategoriMinuman">
              <label class="form-check-label" for="kategoriMinuman">Minuman</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="kategoriMakanKecil">
              <label class="form-check-label" for="kategoriMakanKecil">Makan Kecil</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="kategoriMakanPenutup">
              <label class="form-check-label" for="kategoriMakanPenutup">Makan Penutup</label>
            </div>
          </div>
          
          <div class="filter-section mt-4">
            <h5 class="filter-title">Rentang Harga</h5>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="harga1">
              <label class="form-check-label" for="harga1">5.000 - 10.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="harga2">
              <label class="form-check-label" for="harga2">10.000 - 20.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="harga3">
              <label class="form-check-label" for="harga3">20.000 - 50.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="harga4">
              <label class="form-check-label" for="harga4">50.000 - 100.000</label>
            </div>
          </div>
        </aside>

        <main class="col-lg-9 menu-container">
          <h1 class="menu-heading">Mau makan apa hari ini?</h1>

          <div class="input-group mb-4 search-bar">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0" placeholder="Cari menu">
          </div>

          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            <div class="col">
              <div class="card h-100 menu-card">
                <img src="image/logo-white.png" class="card-img-top" alt="Ayam Geprek">
                <div class="card-body">
                  <h5 class="card-title">Ayam Geprek</h5>
                  <p class="card-text">Rp. 17.000</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
                  <button class="btn btn-outline-primary rounded-circle add-button">+</button>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 menu-card">
                 <img src="image/logo-white.png" class="card-img-top" alt="Es Teh Manis">
                <div class="card-body">
                  <h5 class="card-title">Es Teh Manis</h5>
                  <p class="card-text">Rp. 6.000</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
                  <button class="btn btn-outline-primary rounded-circle add-button">+</button>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 menu-card">
                 <img src="image/logo-white.png" class="card-img-top" alt="Martabak Manis">
                <div class="card-body">
                  <h5 class="card-title">Martabak Manis</h5>
                  <p class="card-text">Rp. 25.000</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
                  <button class="btn btn-outline-primary rounded-circle add-button">+</button>
                </div>
              </div>
            </div>
            <div class="col">
                <div class="card h-100 menu-card">
                  <img src="image/logo-white.png" class="card-img-top" alt="Ayam Geprek">
                  <div class="card-body">
                    <h5 class="card-title">Ayam Geprek</h5>
                    <p class="card-text">Rp. 17.000</p>
                  </div>
                  <div class="card-footer bg-transparent border-0 text-end">
                    <button class="btn btn-outline-primary rounded-circle add-button">+</button>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100 menu-card">
                  <img src="image/logo-white.png" class="card-img-top" alt="Es Teh Manis">
                  <div class="card-body">
                    <h5 class="card-title">Es Teh Manis</h5>
                    <p class="card-text">Rp. 6.000</p>
                  </div>
                  <div class="card-footer bg-transparent border-0 text-end">
                    <button class="btn btn-outline-primary rounded-circle add-button">+</button>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100 menu-card">
                  <img src="image/logo-white.png"class="card-img-top" alt="Martabak Manis">
                  <div class="card-body">
                    <h5 class="card-title">Martabak Manis</h5>
                    <p class="card-text">Rp. 25.000</p>
                  </div>
                  <div class="card-footer bg-transparent border-0 text-end">
                    <button class="btn btn-outline-primary rounded-circle add-button">+</button>
                  </div>
                </div>
              </div>
          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>