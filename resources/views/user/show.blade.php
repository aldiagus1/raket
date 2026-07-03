<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $raket->nama_raket }} - Detail Analisis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: #ffffff; }
        .img-display-container { background-color: #ffffff; border-radius: 15px; border: 1px solid #eef2f5; height: 100%; min-height: 350px; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .img-display { max-height: 400px; max-width: 100%; object-fit: contain; }
        .badge-brand { background-color: #e3f2fd; color: #0d6efd; font-weight: 600; padding: 6px 16px; border-radius: 30px; display: inline-block; text-transform: uppercase; font-size: 0.85rem; }
        .chart-container { position: relative; margin: auto; background: #fafafa; padding: 15px; border-radius: 15px; border: 1px dashed #dee2e6; }
        .btn-custom { border-radius: 10px; padding: 12px 24px; font-weight: 600; transition: all 0.3s; }
        .btn-custom:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="{{ route('user.index') }}">🏸 SMASH<span class="text-white">ZONE</span></a>
            <a href="{{ route('user.index') }}" class="btn btn-outline-light btn-sm" style="border-radius: 8px;"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Katalog</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="card card-custom p-4 p-md-5">
            <div class="row g-5">
                
                <div class="col-lg-5">
                    <div class="img-display-container shadow-sm">
                        @if($raket->gambar)
                            <img src="{{ asset('storage/' . $raket->gambar) }}" class="img-display" alt="{{ $raket->nama_raket }}">
                        @else
                            <div class="text-center text-muted">
                                <i class="fa-solid fa-image fs-1 d-block mb-3 text-light-emphasis"></i>
                                <span>Tidak ada gambar produk</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="mb-3">
                        <span class="badge badge-brand mb-2">{{ $raket->brand }}</span>
                        <h2 class="fw-bold text-dark mb-1">{{ $raket->nama_raket }}</h2>
                    </div>

                    <h5 class="fw-semibold text-secondary mt-4 mb-2">Deskripsi Produk</h5>
                    <p class="text-muted lh-lg" style="text-align: justify;">{{ $raket->deskripsi }}</p>

                    <h5 class="fw-semibold text-secondary mt-4 mb-3"><i class="fa-solid fa-chart-radar me-2 text-primary"></i>Statistik Analisis Kemampuan</h5>
                    
                    <div class="row align-items-center g-4">
                        <div class="col-md-7">
                            <div class="chart-container">
                                <canvas id="radarRaket"></canvas>
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="d-flex flex-column gap-2 mb-4">
                                <div class="d-flex justify-content-between border-bottom pb-1">
                                    <span class="text-muted small"><i class="fa-solid fa-bolt text-danger me-2"></i>Power</span>
                                    <span class="fw-bold text-dark">{{ $raket->power }}/100</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-1">
                                    <span class="text-muted small"><i class="fa-solid fa-bullseye text-success me-2"></i>Control</span>
                                    <span class="fw-bold text-dark">{{ $raket->control }}/100</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-1">
                                    <span class="text-muted small"><i class="fa-solid fa-gauge-high text-primary me-2"></i>Speed</span>
                                    <span class="fw-bold text-dark">{{ $raket->speed }}/100</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-1">
                                    <span class="text-muted small"><i class="fa-solid fa-shield text-warning me-2"></i>Durability</span>
                                    <span class="fw-bold text-dark">{{ $raket->durability }}/100</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-1">
                                    <span class="text-muted small"><i class="fa-solid fa-wave-square text-info me-2"></i>Flexibility</span>
                                    <span class="fw-bold text-dark">{{ $raket->flexibility }}/100</span>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-6">
                                    <form action="{{ route('user.pdf', $raket->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" id="btnDownload" class="btn btn-primary btn-custom w-100">
                                            <i class="fa-solid fa-file-pdf me-1"></i> PDF
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="col-6">
                                    <form action="{{ route('user.beli', $raket->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membeli raket ini? Produk akan dihapus dari katalog setelah sukses dibeli.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-success btn-custom w-100">
                                            <i class="fa-solid fa-shopping-cart me-1"></i> Beli
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('radarRaket').getContext('2d');
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Power', 'Control', 'Speed', 'Durability', 'Flexibility'],
                datasets: [{
                    data: [{{ $raket->power }}, {{ $raket->control }}, {{ $raket->speed }}, {{ $raket->durability }}, {{ $raket->flexibility }}],
                    backgroundColor: 'rgba(13, 110, 253, 0.15)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 2.5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: { r: { suggestedMin: 0, suggestedMax: 100 } },
                plugins: { legend: { display: false } }
            }
        });
    </script>
</body>
</html>