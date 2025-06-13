<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ringkasan Pesanan - MyITS Canteen</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
        <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/customer_order.css') }}" />

  </head>
  <body>
    <!-- Logo -->
    <div class="text-left my-4" style="margin-left: 2rem">
      <img src="image/logo-white.png" alt="MyITS Canteen" style="width: 80px" />
    </div>

    <!-- Gabungan: Produk + Detail -->
    <div class="wrapper">
      <!-- Tabel Produk -->
      <div class="produk-table">
        <table class="table mb-0">
          <thead>
            <tr>
              <th class="text-start ps-4">Produk</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-start ps-4">
                <img
                  src="image/logo-white.png"
                  alt="Ayam Geprek"
                  class="me-2 align-middle rounded"
                />
                Ayam Geprek
              </td>
              <td>Rp. 17.000</td>
              <td><span class="quantity">2</span></td>
              <td>Rp. 34.000</td>
            </tr>
            <tr>
              <td class="text-start ps-4">
                <img
                  src="image/logo-white.png"
                  alt="Es Teh Manis"
                  class="me-2 align-middle rounded"
                />
                Es Teh Manis
              </td>
              <td>Rp. 6.000</td>
              <td><span class="quantity">1</span></td>
              <td>Rp. 6.000</td>
            </tr>
            <tr>
              <td class="text-start ps-4">
                <img
                  src="image/logo-white.png"
                  alt="Martabak Manis"
                  class="me-2 align-middle rounded"
                />
                Martabak Manis
              </td>
              <td>Rp. 25.000</td>
              <td><span class="quantity">3</span></td>
              <td>Rp. 75.000</td>
            </tr>
            <tr>
              <td class="text-start ps-4">
                <img
                  src="image/logo-white.png"
                  alt="Rawon"
                  class="me-2 align-middle rounded"
                />
                Rawon
              </td>
              <td>Rp. 40.000</td>
              <td><span class="quantity">4</span></td>
              <td>Rp. 160.000</td>
            </tr>
          </tbody>
        </table>
        <button class="back-button" onclick="history.back()">
          KEMBALI MELIHAT PESANAN
        </button>
      </div>

      <!-- Tabel Detail Pesanan -->
      <div class="detail-table">
        <h5 class="fw-bold">Detail Pesanan</h5>
        <div class="box">
          <div class="d-flex justify-content-between mb-3">
            <span>Subtotal</span>
            <strong>Rp. 275.000</strong>
          </div>
          <div class="mb-3">
            <label class="form-label">Nomor Meja</label>
            <input
              type="text"
              class="form-control"
              placeholder="Ketik No Disini"
            />
          </div>
          <div class="mb-3">
            <label class="form-label">No Rekening</label>
            <div class="text-muted">1235123591239058</div>
          </div>
          <button class="btn btn-primary w-100 fw-bold">
            SAYA SUDAH BAYAR
          </button>
        </div>
      </div>
    </div>
  </body>
</html>
