<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Raket - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        .form-label {
            font-weight: 500;
            color: #495057;
            font-size: 0.9rem;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0d6efd;
            border-bottom: 2px solid #e3f2fd;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
        .btn-custom {
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 500;
        }
        .current-img-box {
            border: 1px solid #eef2f5;
            border-radius: 10px;
            background: #fff;
            padding: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <a href="{{ route('admin.index') }}" class="btn btn-link text-decoration-none text-secondary mb-3 p-0">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>

                <div class="card card-custom">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h4 class="fw-bold text-dark m-0">Form Edit Data Raket Badminton</h4>
                        <p class="text-muted small mb-0">Perbarui informasi spesifikasi atau ubah nilai parameter penilaian grafik radar raket.</p>
                    </div>
                    
                    <div class="card-body px-4 pb-4">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
                                <h6 class="fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i> Gagal Menyimpan Perubahan:</h6>
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.update', $raket->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <div class="section-title"><i class="fa-solid fa-info-circle me-2"></i>Informasi Umum</div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Raket</label>
                                    <input type="text" name="nama_raket" class="form-control" value="{{ old('nama_raket', $raket->nama_raket) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Brand / Merk</label>
                                    <select name="brand" class="form-select" required>
                                        <option value="Yonex" {{ $raket->brand == 'Yonex' ? 'selected' : '' }}>Yonex</option>
                                        <option value="Victor" {{ $raket->brand == 'Victor' ? 'selected' : '' }}>Victor</option>
                                        <option value="Li-Ning" {{ $raket->brand == 'Li-Ning' ? 'selected' : '' }}>Li-Ning</option>
                                        <option value="Mizuno" {{ $raket->brand == 'Mizuno' ? 'selected' : '' }}>Mizuno</option>
                                        <option value="Felet" {{ $raket->brand == 'Felet' ? 'selected' : '' }}>Felet</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Deskripsi / Spesifikasi Tambahan</label>
                                    <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $raket->deskripsi) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label d-block">Foto Produk Saat Ini</label>
                                    @if($raket->gambar)
                                        <div class="current-img-box mb-2 shadow-sm">
                                            <img src="{{ asset('storage/' . $raket->gambar) }}" width="120" class="img-thumbnail" alt="Foto Lama">
                                        </div>
                                    @else
                                        <p class="text-muted small"><i class="fa-solid fa-eye-slash me-1"></i> Belum ada foto terunggah</p>
                                    @endif
                                    
                                    <label class="form-label d-block mt-2">Ganti Foto Baru (Opsional)</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto produk.</div>
                                </div>
                            </div>

                            <div class="section-title"><i class="fa-solid fa-chart-radar me-2"></i>Statistik Performa (Skala 1 - 100)</div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4 col-6">
                                    <label class="form-label">Power</label>
                                    <input type="number" name="power" class="form-control" min="1" max="100" value="{{ old('power', $raket->power) }}" required>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label">Control</label>
                                    <input type="number" name="control" class="form-control" min="1" max="100" value="{{ old('control', $raket->control) }}" required>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label">Speed</label>
                                    <input type="number" name="speed" class="form-control" min="1" max="100" value="{{ old('speed', $raket->speed) }}" required>
                                </div>
                                <div class="col-md-6 col-6">
                                    <label class="form-label">Durability</label>
                                    <input type="number" name="durability" class="form-control" min="1" max="100" value="{{ old('durability', $raket->durability) }}" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label">Flexibility</label>
                                    <input type="number" name="flexibility" class="form-control" min="1" max="100" value="{{ old('flexibility', $raket->flexibility) }}" required>
                                </div>
                            </div>

                            <div class="text-end pt-3 border-top">
                                <a href="{{ route('admin.index') }}" class="btn btn-light btn-custom me-2">Batal</a>
                                <button type="submit" class="btn btn-warning btn-custom text-white shadow-sm"><i class="fa-solid fa-rotate me-2"></i>Perbarui Data</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>