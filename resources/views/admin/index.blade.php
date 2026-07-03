<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Badminton Rackets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        .table img {
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s;
        }
        .table img:hover {
            transform: scale(1.1);
        }
        .btn-custom {
            border-radius: 8px;
            font-weight: 500;
        }
        .badge-brand {
            background-color: #e3f2fd;
            color: #0d6efd;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand text-primary" href="#"><i class="fa-solid fa-solid fa-circle-dot me-2"></i>🏸 SMASH<span class="text-white">ZONE</span></a>
            <div class="d-flex align-items-center">
                <span class="text-light me-3 d-none d-sm-inline">Halo, Admin</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-sign-out-alt me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h3 class="fw-bold text-dark mb-1">Manajemen Stok Raket</h3>
                <p class="text-muted mb-0">Kelola informasi spesifikasi, gambar, dan radar statistik raket badminton.</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('admin.create') }}" class="btn btn-primary btn-custom px-4 py-2 shadow-sm">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Raket Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px;">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                        <thead class="table-light">
                            <tr class="text-secondary" style="font-size: 0.9rem;">
                                <th class="ps-4 py-3" width="80">NO</th>
                                <th class="py-3" width="120">FOTO</th>
                                <th class="py-3">NAMA RAKET</th>
                                <th class="py-3">BRAND</th>
                                <th class="py-3">PERFORMA (STATS)</th>
                                <th class="py-3 text-end pe-4" width="200">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rakets as $raket)
                                <tr style="border-bottom: 1px solid #f1f1f1;">
                                    <td class="ps-4 fw-medium text-secondary">{{ $loop->iteration }}</td>
                                    <td>
                                        @if($raket->gambar)
                                            <img src="{{ asset('storage/' . $raket->gambar) }}" width="70" height="70" class="shadow-sm border">
                                        @else
                                            <div class="bg-light text-center border d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 8px;">
                                                <i class="fa-solid fa-image text-muted fs-4"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $raket->nama_raket }}</div>
                                        <div class="text-muted small text-truncate" style="max-width: 250px;">{{ $raket->deskripsi }}</div>
                                    </td>
                                    <td><span class="badge badge-brand text-uppercase">{{ $raket->brand }}</span></td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge bg-danger bg-opacity-10 text-danger small">POW: {{ $raket->power }}</span>
                                            <span class="badge bg-success bg-opacity-10 text-success small">CON: {{ $raket->control }}</span>
                                            <span class="badge bg-primary bg-opacity-10 text-primary small">SPD: {{ $raket->speed }}</span>
                                            <span class="badge bg-warning bg-opacity-10 text-warning small">DUR: {{ $raket->durability }}</span>
                                            <span class="badge bg-info bg-opacity-10 text-info small">FLX: {{ $raket->flexibility }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group gap-2">
                                            <a href="{{ route('admin.edit', $raket->id) }}" class="btn btn-outline-warning btn-sm btn-custom px-3">
                                                <i class="fa-solid fa-edit me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.destroy', $raket->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data raket ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm btn-custom px-3">
                                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-box-open fs-1 mb-3 d-block text-secondary"></i>
                                        Belum ada data raket badminton terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>