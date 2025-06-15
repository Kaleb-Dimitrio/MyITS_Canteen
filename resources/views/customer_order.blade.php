<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ringkasan Pesanan - MyITS Canteen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/customer_order.css') }}" />
</head>
<body>
  <div class="text-left my-4" style="margin-left: 2rem">
    <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
  </div>

  <div class="wrapper d-flex flex-wrap justify-content-between">
    <!-- Produk -->
    <div class="produk-table col-md-7 mb-4">
      <table class="table mb-0">
        <thead>
          <tr>
            <th class="text-start ps-4">Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody id="cartBody">
          <!-- Diisi via JavaScript -->
        </tbody>
      </table>
      <button class="btn btn-secondary mt-3" style="width: 100%; height: 80px;" onclick="history.back()">
        KEMBALI MELIHAT PESANAN
      </button>
    </div>

    <!-- Detail Pesanan -->
    <div class="detail-table col-md-4">
      <h5 class="fw-bold">Detail Pesanan</h5>
      <div class="box p-3 border rounded">
        <form id="orderForm" method="POST" action="{{ route('customer.order.store') }}">
          @csrf
          <input type="hidden" name="total_harga" id="total_harga">
          <input type="hidden" name="toko_id" id="toko_id">
          <input type="hidden" name="cashier_id" id="cashier_id">

          <div class="d-flex justify-content-between mb-3">
            <span>Subtotal</span>
            <strong id="subtotal">Rp. 0</strong>
          </div>

          <div class="mb-3">
            <label class="form-label">Nomor Meja</label>
            <input type="number" name="no_meja" id="noMeja" class="form-control" placeholder="Ketik No Disini" required />
          </div>

          <div class="mb-3">
            <label class="form-label">No Rekening</label>
            <div class="text-muted" id="rekeningToko">Memuat...</div>
          </div>

          <button type="submit" class="btn btn-primary w-100 fw-bold">
            SAYA SUDAH BAYAR
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toko = JSON.parse(localStorage.getItem('selectedToko'));
      const cart = JSON.parse(localStorage.getItem('cart')) || {};

      const cartBody = document.getElementById('cartBody');
      const subtotalDisplay = document.getElementById('subtotal');
      const rekeningToko = document.getElementById('rekeningToko');
      const totalHargaInput = document.getElementById('total_harga');
      const tokoIdInput = document.getElementById('toko_id');
      const cashierIdInput = document.getElementById('cashier_id');

      let subtotal = 0;
      cartBody.innerHTML = '';

      Object.entries(cart).forEach(([id, item]) => {
        const total = item.harga * item.jumlah;
        subtotal += total;

        const row = document.createElement('tr');
        row.innerHTML = `
          <td class="text-start ps-4">
            <img src="/image/logo-white.png" alt="${item.nama}" class="me-2 align-middle rounded" />
            ${item.nama}
          </td>
          <td>Rp. ${item.harga.toLocaleString('id-ID')}</td>
          <td>${item.jumlah}</td>
          <td>Rp. ${total.toLocaleString('id-ID')}</td>
        `;
        cartBody.appendChild(row);
      });

      subtotalDisplay.innerText = `Rp. ${subtotal.toLocaleString('id-ID')}`;
      totalHargaInput.value = subtotal;

      if (toko) {
        tokoIdInput.value = toko.id ?? '';
        cashierIdInput.value = toko.id ?? ''; // cashier_id disamakan dengan toko_id
        rekeningToko.innerText = toko.no_rekening ?? 'Tidak tersedia';
      } else {
        rekeningToko.innerText = 'Tidak tersedia';
      }
    });

    document.getElementById('orderForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': formData.get('_token'),
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          Object.keys(localStorage).forEach(key => {
  if (key.startsWith('menu_')) {
    localStorage.removeItem(key);
  }
});

          localStorage.removeItem('cart');
          localStorage.removeItem('selectedToko');
          alert('Pesanan Anda berhasil dikirim! Silakan tunggu konfirmasi.');
          window.location.href = '/customer'; // Ganti sesuai route halaman customer
        } else {
          alert('Terjadi kesalahan. Silakan coba lagi.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan jaringan.');
      });
    });
  </script>
</body>
</html>
