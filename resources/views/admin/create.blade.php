<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Raket - Admin Panel</title>
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
                        <h4 class="fw-bold text-dark m-0">Form Input Data Raket Badminton</h4>
                        <p class="text-muted small mb-0">Isi kelengkapan data raket serta parameter penilaian grafik radar.</p>
                    </div>
                    
                    <div class="card-body px-4 pb-4">
                        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                             @if ($errors->any())
                                <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
                                    <h6 class="fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i> Gagal Menyimpan:</h6>
                                    <ul class="mb-0 small">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="section-title"><i class="fa-solid fa-info-circle me-2"></i>Informasi Umum</div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Raket</label>
                                    <input type="text" name="nama_raket" class="form-control" placeholder="Contoh: Yonex Arcsaber 11 Pro" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Brand / Merk</label>
                                    <select name="brand" class="form-select" required>
                                        <option value="" disabled selected>Pilih Brand--</option>
                                        <option value="Yonex">Yonex</option>
                                        <option value="Victor">Victor</option>
                                        <option value="Li-Ning">Li-Ning</option>
                                        <option value="Mizuno">Mizuno</option>
                                        <option value="Felet">Felet</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Deskripsi / Spesifikasi Tambahan</label>
                                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Tuliskan ulasan singkat atau penjelasan kelebihan raket di sini..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Foto Raket</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    <div class="form-text">Format file disarankan: JPG, JPEG, atau PNG (Maksimal 2MB)</div>
                                </div>
                            </div>

                            <div class="section-title"><i class="fa-solid fa-chart-radar me-2"></i>Statistik Performa (Skala 1 - 100)</div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4 col-6">
                                    <label class="form-label">Power (Daya Serang)</label>
                                    <input type="number" name="power" class="form-control" min="1" max="100" placeholder="1-100" required>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label">Control (Akurasi)</label>
                                    <input type="number" name="control" class="form-control" min="1" max="100" placeholder="1-100" required>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label">Speed (Kecepatan Smesh)</label>
                                    <input type="number" name="speed" class="form-control" min="1" max="100" placeholder="1-100" required>
                                </div>
                                <div class="col-md-6 col-6">
                                    <label class="form-label">Durability (Ketahanan Rangka)</label>
                                    <input type="number" name="durability" class="form-control" min="1" max="100" placeholder="1-100" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label">Flexibility (Kelenturan Shaft)</label>
                                    <input type="number" name="flexibility" class="form-control" min="1" max="100" placeholder="1-100" required>
                                </div>
                            </div>

                            <div class="text-end pt-3 border-top">
                                <a href="{{ route('admin.index') }}" class="btn btn-light btn-custom me-2">Batal</a>
                                <button type="submit" class="btn btn-primary btn-custom shadow-sm"><i class="fa-solid fa-save me-2"></i>Simpan</button>
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