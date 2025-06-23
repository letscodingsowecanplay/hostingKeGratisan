<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Si Ukur'); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Baloo+2:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        html, body {
            min-height: 100%;
            margin: 0; padding: 0;
        }
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #fffbe9;
            background-image:
                linear-gradient(0deg, #e3caa5 1.5px, transparent 1.5px),
                linear-gradient(90deg, #e3caa5 1.5px, transparent 1.5px);
            background-size: 40px 40px;
            background-position: center;
        }
        /* Navbar */
        .navbar-custom {
            background: #fffbe9;
            border-bottom: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            padding: 6px 18px 0 18px;
            box-shadow: none;
            min-height: 48px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: 'Baloo 2', Arial, sans-serif;
            font-weight: 700;
            font-size: 1.03rem;
            color: #258fff !important;
        }
        .navbar-brand img {
            height: 28px;
            margin-right: 2px;
        }
        .navbar-profile {
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .navbar-profile-img {
            width: 29px; height: 29px; border-radius: 50%;
            object-fit: cover; border: 2px solid #ffe145; background: #fff;
        }
        .navbar-profile span {
            font-size: 1em;
        }
        .nav-menu-link.nav-logout-btn {
            background: #ffe145;
            color: #284b63;
            border: none;
            border-radius: 15px;
            padding: 4px 12px 4px 9px;
            font-size: 0.98rem;
            font-weight: 700;
            font-family: 'Montserrat', Arial, sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 4px #ffe14523;
            transition: background .14s;
            margin-right: 4px;
        }
        .nav-menu-link.nav-logout-btn:hover {
            background: #ffd600;
            color: #111;
        }

        /* Sidebar */
        .sidebar {
            background: #fffbe9;
            border-right: none;
            min-height: 100vh;
            box-shadow: none;
        }
        .sidebar-header {
            padding: 15px 0 7px 0;
            text-align: center;
        }
        .sidebar .nav {
            padding-left: 0;
        }
        .sidebar .nav-link {
            font-family: 'Montserrat', Arial, sans-serif;
            font-weight: 600;
            font-size: 1em;
            padding: 8px 18px 8px 18px;
            border-radius: 10px;
            margin-bottom: 2px;
            color: #246bba !important;
            background: none;
            display: flex;
            align-items: center;
            transition: background .13s, color .13s, box-shadow .16s;
            box-shadow: none;
            position: relative;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:focus {
            background: linear-gradient(90deg,#e8f4ff 90%,#ffe145 100%);
            color: #258fff !important;
            box-shadow: 0 2px 8px #258fff18;
        }
        .sidebar .nav-link .feather {
            margin-right: 7px;
            font-size: 1.15em;
        }
        .sidebar .nav-link[data-accent="yellow"] .feather { color: #ffe145; }
        .sidebar .nav-link[data-accent="green"]  .feather { color: #20b484; }
        .sidebar .nav-link[data-accent="blue"]   .feather { color: #258fff; }
        .sidebar .nav-link[data-accent="orange"] .feather { color: #ffaf36; }
        .sidebar .nav-link.disabled {
            opacity: 0.44;
            pointer-events: none;
            background: #f3f3f3;
            color: #bbb !important;
        }
        .sidebar .nav-link:hover:not(.active) {
            background: #f1f8ff;
            color: #1557a6 !important;
        }
        .sidebar .nav-link .gembok-lock-icon {
            margin-left: 6px;
        }
        .sidebar .sidebar-header img {
            height: 30px;
        }
        .sidebar .sidebar-header .fw-bold {
            font-size: 1em;
            color: #ffae00;
            font-family: 'Baloo 2', Arial, sans-serif;
        }
        /* Content Card */
        .main-content-bg {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px #258fff13;
            padding: 18px 2vw 22px 2vw;
            margin-top: 14px;
            min-height: 70vh;
        }
        .card-header {
            background: none;
            border: none;
            font-size: 1.07em;
            font-weight: 800;
            color: #258fff;
            font-family: 'Baloo 2', Arial, sans-serif;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        /* Table & Buttons */
        .table {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            border: none !important;
            vertical-align: middle !important;
        }
        .table thead th {
            font-weight: 800;
            color: #284b63;
            font-family: 'Montserrat', Arial, sans-serif;
            font-size: 1.01em;
            background: #fffbe9;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f7fbff !important;
        }
        .table > tbody > tr:hover {
            background: #e8f4ff !important;
        }
        .btn-info, .badge.bg-info {
            background: #19b8ff !important;
            color: #fff !important;
            font-weight: 700;
            border-radius: 7px;
            border: none;
            padding: 6px 14px;
        }
        .btn-danger, .badge.bg-danger {
            background: #fa4654 !important;
            color: #fff !important;
            font-weight: 700;
            border-radius: 7px;
            border: none;
            padding: 6px 14px;
        }
        .btn-success, .badge.bg-success {
            background: #28c76f !important;
            color: #fff !important;
            font-weight: 700;
            border-radius: 7px;
            border: none;
        }
        .custom-pagination .pagination {
            --bs-pagination-active-bg: #258fff;
            --bs-pagination-active-border-color: #1557a6;
            --bs-pagination-hover-bg: #ffe145;
            --bs-pagination-color: #258fff;
        }
        /* Responsive */
        @media (max-width: 991px) {
            .sidebar {
                width: 77vw;
                max-width: 320px;
            }
            .main-content-bg { border-radius: 11px; padding: 10px 3vw 16px 3vw; }
        }
        @media (max-width: 767px) {
            .navbar-custom, .main-content-bg { padding: 6px 2vw; }
            .sidebar { width: 93vw; }
            .navbar-profile-img { display: none; }
            .navbar-brand { font-size: 0.95rem; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <button class="btn d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                <span data-feather="menu"></span>
            </button>
            <a class="navbar-brand" href="<?php echo e(route('admin.index')); ?>">
                <img src="<?php echo e(asset('images/Logo-Si-Ukur.png')); ?>" alt="Logo">
            </a>
            <div class="navbar-profile ms-auto">
                <span class="fw-semibold d-none d-md-inline" style="color:#258fff"><?php echo e(auth()->user()->name ?? 'User'); ?></span>
                <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="nav-menu-link nav-logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="#284b63" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out align-middle" style="margin-right:7px;">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <div class="sidebar col-12 col-md-3 col-lg-2 p-0">
                <div class="sidebar-header d-none d-md-block">
                    <div class="fw-bold">Menu Guru</div>
                </div>
                <div class="offcanvas-md offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-body sidebar-sticky d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column pt-2">
                            <li class="nav-item mb-1">
                                <a class="nav-link <?php echo e((request()->is('admin')) ? 'active' : ''); ?>" data-accent="blue" href="<?php echo e(route('admin.index')); ?>">
                                    <span data-feather="home" class="feather"></span>
                                    <span class="fw-bold fs-6">Dashboard</span>
                                </a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('datasiswa_access')): ?>
                            <li class="nav-item mb-1">
                                <a class="nav-link <?php echo e(request()->is('admin/datasiswa*') ? 'active' : ''); ?>" data-accent="yellow" href="<?php echo e(route('admin.datasiswa.index')); ?>">
                                    <span data-feather="users" class="feather"></span>
                                    <span class="fw-bold fs-6">Data Siswa</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('datalatihansiswa_access')): ?>
                            <li class="nav-item mb-1">
                                <a class="nav-link <?php echo e(request()->is('admin/datalatihan*') ? 'active' : ''); ?>" data-accent="green" href="<?php echo e(route('admin.datalatihan.index')); ?>">
                                    <span data-feather="edit" class="feather"></span>
                                    <span class="fw-bold fs-6">Data Latihan Siswa</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('datahasilbelajarsiswa_access')): ?>
                            <li class="nav-item mb-1">
                                <a class="nav-link <?php echo e(request()->is('admin/hasilbelajar*') ? 'active' : ''); ?>" data-accent="orange" href="<?php echo e(route('admin.hasilbelajar.index')); ?>">
                                    <span data-feather="bar-chart-2" class="feather"></span>
                                    <span class="fw-bold fs-6">Hasil Belajar</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editkkm_access')): ?>
                            <li class="nav-item mb-1">
                                <a class="nav-link <?php echo e(request()->is('admin/kkm*') ? 'active' : ''); ?>" data-accent="yellow" href="<?php echo e(route('admin.kkm.index')); ?>">
                                    <span data-feather="award" class="feather"></span>
                                    <span class="fw-bold fs-6">KKM</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php
                                $isSubbab1 = isset($nomorHalaman) && $nomorHalaman >= 1 && $nomorHalaman <= 10;
                                $isSubbab2 = isset($nomorHalaman) && $nomorHalaman >= 11 && $nomorHalaman <= 16;
                            ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('materi_access')): ?>
                            <li class="nav-item mb-1">
                                <a id="menu-subbab-1"
                                   class="nav-link <?php echo e($isSubbab1 ? 'active' : ''); ?>" data-accent="green" href="<?php echo e(route('admin.materi.index')); ?>">
                                    <span data-feather="folder" class="feather"></span>
                                    <span class="fw-semibold fs-6">SubBab 1: Membandingkan dan Mengurutkan Panjang Benda</span>
                                    <span id="gembok-1" class="ms-2 text-danger d-none"><span data-feather="lock"></span></span>
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a id="menu-subbab-2"
                                   class="nav-link <?php echo e($isSubbab2 ? 'active' : ''); ?>" data-accent="blue" href="<?php echo e(route('admin.materi.halaman11')); ?>">
                                    <span data-feather="folder" class="feather"></span>
                                    <span class="fw-semibold fs-6">SubBab 2: Mengukur Panjang Benda</span>
                                    <span id="gembok-2" class="ms-2 text-danger d-none"><span data-feather="lock"></span></span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('evaluasi_access')): ?>
                            <li class="nav-item mb-1">
                                <a id="menu-ayo-evaluasi" class="nav-link <?php echo e((request()->is('admin/evaluasi*')) ? 'active' : ''); ?>" data-accent="orange" href="<?php echo e(route('admin.evaluasi.petunjuk')); ?>">
                                    <span data-feather="file-text" class="feather"></span>
                                    <span class="fw-semibold fs-6">Evaluasi</span>
                                    <span id="gembok-3" class="ms-2 text-danger d-none"><span data-feather="lock"></span></span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Main Content -->
            <main class="col-12 col-md-9 col-lg-10 px-md-4 py-4">
                <div class="main-content-bg">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>
        </div>
    </div>
    <?php echo $__env->yieldPushContent('modals'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
        window.initKunciSidebar = function(statusLulus) {
            const menus = [
                {menu: 'menu-subbab-2', gembok: 'gembok-2', prasyarat: 'ayo-berlatih-2'},
                {menu: 'menu-ayo-evaluasi', gembok: 'gembok-3', prasyarat: 'ayo-berlatih-3'},
            ];
            menus.forEach(item => {
                const menuEl = document.getElementById(item.menu);
                const gembokEl = document.getElementById(item.gembok);
                if (!statusLulus[item.prasyarat] || statusLulus[item.prasyarat] !== 'lulus') {
                    menuEl.classList.add('disabled');
                    menuEl.style.pointerEvents = 'none';
                    menuEl.style.color = '#c2c2c2';
                    if (gembokEl) gembokEl.classList.remove('d-none');
                } else {
                    menuEl.classList.remove('disabled');
                    menuEl.style.pointerEvents = '';
                    menuEl.style.color = '';
                    if (gembokEl) gembokEl.classList.add('d-none');
                }
            });
        }
        <?php if(isset($statusLulus)): ?>
            window.initKunciSidebar(<?php echo json_encode($statusLulus, 15, 512) ?>);
        <?php endif; ?>
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <audio id="bg-music" src="<?php echo e(asset('sounds/music.mp3')); ?>" loop preload="auto"></audio>
    <script>
        const bgMusic = document.getElementById('bg-music');
        bgMusic.volume = 0.25;
        let musicStarted = false;

        function playMusic() {
            if (musicStarted) return;
            musicStarted = true;
            // Pastikan audio sudah bisa diputar
            if (bgMusic.readyState >= 2) {
                bgMusic.play().then(()=> {
                    console.log('Music started by pointerdown/gesture!');
                }).catch(e => {
                    console.log('Play audio failed:', e);
                });
            } else {
                bgMusic.addEventListener('canplaythrough', () => {
                    bgMusic.play().catch(e => {
                        console.log('Play audio failed after canplay:', e);
                    });
                }, {once: true});
            }
            // Remove gesture listener
            window.removeEventListener('pointerdown', playMusic);
            window.removeEventListener('keydown', playMusic);
            window.removeEventListener('touchstart', playMusic);
        }
        // Gunakan pointerdown & keydown (paling universal)
        window.addEventListener('pointerdown', playMusic, {passive:true});
        window.addEventListener('keydown', playMusic, {passive:true});
        window.addEventListener('touchstart', playMusic, {passive:true});
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/layouts/master-guru.blade.php ENDPATH**/ ?>