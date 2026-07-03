<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Raket Badminton - SmashZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .racket-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            background: #fff;
        }
        .racket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }
        .racket-img-container {
            height: 220px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .racket-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            padding: 15px;
        }
        .badge-brand {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: rgba(13, 110, 253, 0.9);
            color: white;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            font-size: 0.8rem;
        }
        .btn-detail {
            border-radius: 8px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand text-primary" href="#"><i class="fa-solid fa-circle-dot me-2"></i>🏸 SMASH<span class="text-white">ZONE</span></a>
            <div class="d-flex align-items-center">
                <span class="text-light me-3 d-none d-sm-inline">Halo,user</span>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-sign-out-alt me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Katalog Raket Badminton</h2>
            <p class="text-muted">Pilih raket terbaik untuk meningkatkan performa permainanmu.</p>
        </div>

        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $rakets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card racket-card h-100 shadow-sm">
                        <div class="racket-img-container">
                            <span class="badge badge-brand"><?php echo e($raket->brand); ?></span>
                            <?php if($raket->gambar): ?>
                                <img src="<?php echo e(asset('storage/' . $raket->gambar)); ?>" class="racket-img" alt="<?php echo e($raket->nama_raket); ?>">
                            <?php else: ?>
                                <div class="text-muted text-center">
                                    <i class="fa-solid fa-image fs-1 d-block mb-2 text-secondary"></i>
                                    No Image
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div>
                                <h5 class="fw-bold text-dark text-truncate mb-1"><?php echo e($raket->nama_raket); ?></h5>
                                <p class="text-muted small text-truncate-3 mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?php echo e($raket->deskripsi); ?>

                                </p>
                            </div>
                            
                            <a href="<?php echo e(route('user.show', $raket->id)); ?>" class="btn btn-primary btn-detail w-100 py-2">
                                <i></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fa-solid fa-box-open fs-1 mb-3 d-block text-secondary"></i>
                    Belum ada data raket yang ditambahkan oleh Admin.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\tugas dio\SMT 4\pem web lanjut\proyek uas\raket-badminton\resources\views/user/index.blade.php ENDPATH**/ ?>