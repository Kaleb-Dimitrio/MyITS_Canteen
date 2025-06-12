<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Page - MyITS Canteen</title>

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
    <link rel="stylesheet" href="{{ asset('css/daftar.css') }}" />
  </head>
  <body
    class="d-flex justify-content-center align-items-center vh-100 bg-white"
  >
    <div class="text-center w-100 px-3" style="max-width: 500px">
      <!-- Logo -->
      <img
        src="{{ asset('image/logo-white.png') }}"
        alt="MyITS Canteen"
        class="mb-4"
        style="width: 150px"
      />

      <form action="#">
        <!-- Email -->
        <div class="input-box">
          <span class="icon"><i class="bi bi-envelope"></i></span>
          <input type="email" id="email" required />
          <label for="email">Masukkan Email</label>
        </div>

        <!-- Nama -->
        <div class="input-box">
        <span class="icon"><i class="bi bi-person-circle"></i></span>
        <input type="text" id="nama" required />
        <label for="nama">Masukkan Nama</label>
        </div>

        <!-- Nomor Telepon -->
        <div class="input-box">
        <span class="icon"><i class="bi bi-telephone-fill"></i></span>
        <input type="tel" id="telepon" pattern="[0-9]{10,15}" required />
        <label for="telepon">Masukkan Nomor Telepon</label>
        </div>


        <!-- Password -->
        <div class="input-box position-relative">
          <span class="icon"><i class="bi bi-lock-fill"></i></span>
          <input type="password" id="password" required />
          <label for="password">Masukkan Password</label>
          <span
            class="position-absolute top-50 end-0 translate-middle-y me-3"
            onclick="togglePassword()"
            style="cursor: pointer"
          >
            <i class="bi bi-eye" id="toggleIcon"></i>
          </span>
        </div>

        <!-- Login Button -->
        <button
          type="submit"
          class="btn btn-primary btn-lg w-100 mb-4 shadow-sm rounded-4"
        >
          Daftar
        </button>


    <script src="{{ asset('js/password.js') }}"></script>

  </body>
</html>
