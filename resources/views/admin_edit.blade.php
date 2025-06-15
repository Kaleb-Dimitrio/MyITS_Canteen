<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Toko - MyITS Canteen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin_edit.css') }}" />
</head>
<body class="bg-white">
    <!-- Header Bar -->
    <div class="header-bar d-flex justify-content-between align-items-center px-4 pt-4">
        <div class="logo-container">
            <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
        </div>
        <div class="edit-icon text-center">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-dark">
                <i class="bi bi-house-door fs-2"></i>
                <div style="font-weight: bold;">HOME</div>
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="table-container bg-white">
        <div class="table-header text-white px-4 py-3">
            <h5 class="mb-0">Detail Toko</h5>
        </div>

        <div class="p-4">
            <!-- Display Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.toko.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="toko_nama" class="form-label">Nama Toko</label>
                    <input
                        id="toko_nama"
                        name="toko_nama"
                        type="text"
                        class="form-control border-primary"
                        placeholder="Tulis Nama Toko Disini"
                        value="{{ old('toko_nama') }}"
                    />
                </div>
                
                <!-- *** NEW INPUT FIELD *** -->
                <div class="mb-3">
                    <label for="toko_no_rekening" class="form-label">Nomor Rekening Toko</label>
                    <input
                        id="toko_no_rekening"
                        name="toko_no_rekening"
                        type="text"
                        class="form-control border-primary"
                        placeholder="Tulis Nomor Rekening Toko Disini"
                        value="{{ old('toko_no_rekening') }}"
                    />
                </div>

                <div class="mb-3">
                    <label for="kasir_nama" class="form-label">Nama Kasir</label>
                    <input
                        id="kasir_nama"
                        name="kasir_nama"
                        type="text"
                        class="form-control border-primary"
                        placeholder="Tulis Nama Kasir Disini"
                        value="{{ old('kasir_nama') }}"
                    />
                </div>

                <div class="mb-3">
                    <label for="nomor_telephone" class="form-label">Nomor Telephone Kasir</label>
                    <input
                        id="nomor_telephone"
                        name="nomor_telephone"
                        type="text"
                        class="form-control border-primary"
                        placeholder="Tulis Nomor Telephone Kasir Disini"
                        value="{{ old('nomor_telephone') }}"
                    />
                </div>

                <div class="mb-4">
                    <label for="foto_toko" class="form-label">Foto Toko</label>
                    <input
                        id="foto_toko"
                        name="foto_toko"
                        type="file"
                        class="form-control border-primary"
                        style="max-width: 100%"
                    />
                </div>

                <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>
