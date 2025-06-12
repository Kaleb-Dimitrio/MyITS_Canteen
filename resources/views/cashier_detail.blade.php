<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ringkasan Pesanan - MyITS Canteen</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/cashier_detail.css') }}" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-white">
    <!-- Logo -->
    <div class="text-left my-4" style="margin-left: 2rem">
      <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
    </div>

    <!-- Order Table -->
    <div class="table-container bg-white">
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
                src="{{ asset('image/logo-white.png') }}"
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
                src="{{ asset('image/logo-white.png') }}"
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
                src="{{ asset('image/logo-white.png') }}"
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
                src="{{ asset('image/logo-white.png') }}"
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

      <!-- Button -->
      <button class="back-button" onclick="history.back()">
        KEMBALI MELIHAT PESANAN
      </button>
    </div>
  </body>
</html>
