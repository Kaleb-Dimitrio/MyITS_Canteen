<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Menu - MyITS Canteen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/cashier_edit.css') }}" />
</head>
<body class="bg-white">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center p-3">
        <a href="{{ route('cashier.dashboard') }}">
            <img src="{{ asset('image/logo-white.png') }}" alt="MyITS Canteen" style="width: 80px" />
        </a>
    </div>

    <!-- Main Container -->
    <div class="container-fluid my-4">
        <!-- Display Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Existing Menu Table -->
        <div class="table-container bg-white mb-5">
            <div class="table-header text-white px-4 py-3">
                <h5 class="mb-0">Daftar Menu Saat Ini</h5>
            </div>
            <div class="p-4 table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $menu->menu_gambar) }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;" />
                                <strong>{{ $menu->menu_nama }}</strong><br>
                                <small class="text-muted">{{ $menu->menu_kategori }}</small>
                            </td>
                            <form action="{{ route('cashier.menu.update', $menu) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <input type="number" name="harga" class="form-control" value="{{ $menu->menu_harga }}" style="width: 120px;">
                                </td>
                                <td>
                                    <input type="number" name="stok" class="form-control" value="{{ $menu->menu_stok }}" style="width: 90px;">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary me-2"><i class="bi bi-check-lg"></i> Update</button>
                            </form>
                            <form action="{{ route('cashier.menu.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center p-4">Belum ada menu di toko ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Add New Menu Form -->
        <div class="table-container bg-white">
            <div class="table-header text-white px-4 py-3">
                <h5 class="mb-0">Tambah Menu Baru</h5>
            </div>
            <div class="p-4">
                <form action="{{ route('cashier.menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="nama_menu" class="form-control border-primary" placeholder="Tulis Nama Menu Disini" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control border-primary" placeholder="Tulis Harga Menu Disini" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control border-primary" placeholder="Tulis Jumlah Stock Disini" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select border-primary" required>
                            <option value="Makan Berat">Makan Berat</option>
                            <option value="Makan Kecil">Makan Kecil</option>
                            <option value="Makan Penutup">Makan Penutup</option>
                            <option value="Minuman">Minuman</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Upload Gambar</label>
                        <input type="file" name="gambar" class="form-control border-primary" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">TAMBAH MENU</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
