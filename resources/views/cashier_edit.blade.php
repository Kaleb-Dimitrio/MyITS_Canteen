<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Menu - MyITS Canteen</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/cashier_edit.css') }}" />
  </head>
  <body class="bg-white">
    <!-- Logo -->
    <div class="text-left my-4" style="margin-left: 2rem">
      <img src="image/logo-white.png" alt="MyITS Canteen" style="width: 80px" />
    </div>

    <!-- Form Container -->
    <div class="table-container bg-white">
      <div class="table-header text-white px-4 py-3">
        <h5 class="mb-0">Detail Menu</h5>
      </div>

      <div class="p-4">
        <form>
          <div class="mb-3">
            <label class="form-label">Nama Menu</label>
            <input
              type="text"
              class="form-control border-primary"
              placeholder="Tulis Nama Menu Disini"
            />
          </div>

          <div class="mb-3">
            <label class="form-label">Harga</label>
            <input
              type="number"
              class="form-control border-primary"
              placeholder="Tulis Harga Menu Disini"
            />
          </div>

          <div class="mb-3">
            <label class="form-label">Stock</label>
            <input
              type="number"
              class="form-control border-primary"
              placeholder="Tulis Jumlah Stock Disini"
            />
          </div>

          <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input
              type="text"
              class="form-control border-primary"
              placeholder="Tulis Kategori Disini"
            />
          </div>

          <div class="mb-4">
            <label class="form-label">Upload Gambar</label>
            <input
              type="file"
              class="form-control border-primary"
              style="max-width: 100%"
            />
          </div>

          <button type="submit" class="btn btn-primary w-100">EDIT MENU</button>
        </form>
      </div>
    </div>
  </body>
</html>
