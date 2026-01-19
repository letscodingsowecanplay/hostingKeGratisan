<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Si Ukur')</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Baloo+2:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        html, body {
            min-height: 100%;
            margin: 0; padding: 0;
            box-sizing: border-box;
            width: 100vw;
            max-width: 100vw;
            overflow-x: hidden;
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
        .navbar-brand img { height: 28px; margin-right: 2px; }
        .navbar-profile { display: flex; align-items: center; gap: 7px; }
        .navbar-profile-img {
            width: 29px; height: 29px; border-radius: 50%;
            object-fit: cover; border: 2px solid #ffe145; background: #fff;
        }
        .navbar-profile span { font-size: 1em; }
        .nav-menu-link.nav-logout-btn {
            background: #ffe145; color: #284b63; border: none;
            border-radius: 15px; padding: 4px 12px 4px 9px;
            font-size: 0.98rem; font-weight: 700;
            font-family: 'Montserrat', Arial, sans-serif;
            cursor: pointer; display: flex; align-items: center;
            box-shadow: 0 1px 4px #ffe14523;
            transition: background .14s; margin-right: 4px;
        }
        .nav-menu-link.nav-logout-btn:hover { background: #ffd600; color: #111; }

        /* Sidebar style */
        .sidebar, .sidebar-offcanvas {
            background: #fffbe9;
            box-shadow: none;
        }
        .sidebar-header {
            padding: 15px 0 7px 0;
            text-align: center;
        }
        .sidebar .nav, .sidebar-offcanvas .nav { padding-left: 0; }
        .sidebar .nav-link, .sidebar-offcanvas .nav-link {
            font-family: 'Montserrat', Arial, sans-serif;
            font-weight: 600;
            font-size: 1em;
            padding: 8px 18px 8px 18px;
            border-radius: 10px;
            margin-bottom: 2px;
            color: #246bba !important;
            background: none;
            display: flex; align-items: center;
            transition: background .13s, color .13s, box-shadow .16s;
            box-shadow: none; position: relative;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:focus,
        .sidebar-offcanvas .nav-link.active, .sidebar-offcanvas .nav-link:focus {
            background: linear-gradient(90deg,#e8f4ff 90%,#ffe145 100%);
            color: #258fff !important;
            box-shadow: 0 2px 8px #258fff18;
        }
        .sidebar .nav-link .feather, .sidebar-offcanvas .nav-link .feather {
            margin-right: 7px; font-size: 1.15em;
        }
        .sidebar .nav-link[data-accent="yellow"] .feather,
        .sidebar-offcanvas .nav-link[data-accent="yellow"] .feather { color: #ffe145; }
        .sidebar .nav-link[data-accent="green"] .feather,
        .sidebar-offcanvas .nav-link[data-accent="green"] .feather { color: #20b484; }
        .sidebar .nav-link[data-accent="blue"] .feather,
        .sidebar-offcanvas .nav-link[data-accent="blue"] .feather { color: #258fff; }
        .sidebar .nav-link[data-accent="orange"] .feather,
        .sidebar-offcanvas .nav-link[data-accent="orange"] .feather { color: #ffaf36; }
        .sidebar .nav-link.disabled,
        .sidebar-offcanvas .nav-link.disabled {
            opacity: 0.44; pointer-events: none;
            background: #f3f3f3; color: #bbb !important;
        }
        .sidebar .nav-link:hover:not(.active),
        .sidebar-offcanvas .nav-link:hover:not(.active) {
            background: #f1f8ff; color: #1557a6 !important;
        }
        .sidebar .sidebar-header img,
        .sidebar-offcanvas .sidebar-header img { height: 30px; }
        .sidebar .sidebar-header .fw-bold,
        .sidebar-offcanvas .sidebar-header .fw-bold {
            font-size: 1em; color: #ffae00;
            font-family: 'Baloo 2', Arial, sans-serif;
        }
        .main-content-bg {
            background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #258fff13;
            padding: 18px 2vw 22px 2vw; margin-top: 14px; min-height: 70vh;
        }
        .card-header {
            background: none; border: none; font-size: 1.07em; font-weight: 800;
            color: #258fff; font-family: 'Baloo 2', Arial, sans-serif; letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .table { background: #fff; border-radius: 8px; overflow: hidden; }
        .table th, .table td { border: none !important; vertical-align: middle !important; }
        .table thead th {
            font-weight: 800; color: #284b63;
            font-family: 'Montserrat', Arial, sans-serif; font-size: 1.01em;
            background: #fffbe9;
        }
        .table-striped > tbody > tr:nth-of-type(odd) { background-color: #f7fbff !important; }
        .table > tbody > tr:hover { background: #e8f4ff !important; }
        .btn-info, .badge.bg-info {
            background: #19b8ff !important; color: #fff !important;
            font-weight: 700; border-radius: 7px; border: none; padding: 6px 14px;
        }
        .btn-danger, .badge.bg-danger {
            background: #fa4654 !important; color: #fff !important;
            font-weight: 700; border-radius: 7px; border: none; padding: 6px 14px;
        }
        .btn-success, .badge.bg-success {
            background: #28c76f !important; color: #fff !important;
            font-weight: 700; border-radius: 7px; border: none;
        }
        .custom-pagination .pagination {
            --bs-pagination-active-bg: #258fff;
            --bs-pagination-active-border-color: #1557a6;
            --bs-pagination-hover-bg: #ffe145;
            --bs-pagination-color: #258fff;
        }

        /* ===== MOBILE RESPONSIVE ≤768px ===== */
        @media (max-width: 768px) {
            html, body {
                width: 100vw !important;
                max-width: 100vw !important;
                min-width: 0 !important;
                overflow-x: hidden !important;
            }
            .navbar-custom { 
                padding: 8px 15px 6px 15px !important; 
                min-height: 50px !important; 
            }
            .navbar-brand { font-size: 1rem !important; }
            .navbar-brand img { height: 26px !important; }
            .navbar-profile span { font-size: 0.9em !important; }
            .nav-menu-link.nav-logout-btn { 
                padding: 5px 10px 5px 8px !important; 
                font-size: 0.9rem !important; 
                border-radius: 12px !important;
            }
            .container-fluid {
                padding: 0 !important;
                margin: 0 !important;
                width: 100vw !important;
                max-width: 100vw !important;
            }
            .row {
                margin: 0 !important;
                width: 100vw !important;
                max-width: 100vw !important;
            }
            main {
                padding: 0 15px !important;
                width: 100vw !important;
                max-width: 100vw !important;
                box-sizing: border-box !important;
            }
            .main-content-bg {
                border-radius: 15px !important;
                margin-top: 10px !important;
                padding: 20px 15px 25px 15px !important;
                min-height: 70vh !important;
                width: 100% !important;
                max-width: 100% !important;
                box-sizing: border-box !important;
                overflow-x: hidden !important;
            }
            .card { 
                margin-bottom: 15px !important;
            }
            .card-header { 
                font-size: 1.15em !important; 
                padding: 12px 0 8px 0 !important; 
                margin-bottom: 12px !important;
            }
            .sidebar-header { padding: 12px 0 6px 0 !important; }
            
            /* Mobile Table Improvements */
            .table-responsive {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                overflow-x: auto !important;
                border-radius: 10px !important;
                box-shadow: 0 2px 8px rgba(37, 143, 255, 0.1) !important;
            }
            .table {
                width: 100% !important;
                min-width: 600px !important;
                font-size: 0.9em !important;
                margin-bottom: 0 !important;
                border-collapse: separate !important;
                border-spacing: 0 !important;
            }
            .table th, .table td {
                padding: 12px 8px !important;
                font-size: 0.9em !important;
                vertical-align: middle !important;
                white-space: nowrap !important;
                border-bottom: 1px solid #f0f4f8 !important;
            }
            
            /* Better column sizing for mobile */
            .table th:first-child, .table td:first-child {
                min-width: 50px !important;
                max-width: 60px !important;
                text-align: center !important;
                padding: 12px 6px !important;
            }
            .table th:nth-child(2), .table td:nth-child(2) {
                min-width: 140px !important;
                max-width: 160px !important;
            }
            .table th:nth-child(3), .table td:nth-child(3) {
                min-width: 120px !important;
                max-width: 140px !important;
            }
            .table th:nth-child(4), .table td:nth-child(4) {
                min-width: 110px !important;
                max-width: 130px !important;
            }
            .table th:nth-child(5), .table td:nth-child(5) {
                min-width: 100px !important;
                max-width: 120px !important;
            }
            .table th:last-child, .table td:last-child {
                min-width: 120px !important;
                max-width: 140px !important;
                text-align: center !important;
            }
            
            /* Enhanced badges and buttons for mobile */
            .table .badge {
                font-size: 0.8em !important;
                padding: 4px 8px !important;
                white-space: nowrap !important;
                border-radius: 6px !important;
                line-height: 1.4 !important;
                font-weight: 600 !important;
                display: inline-block !important;
            }
            .table .btn {
                font-size: 0.8em !important;
                padding: 5px 10px !important;
                white-space: nowrap !important;
                border-radius: 6px !important;
                line-height: 1.4 !important;
                font-weight: 600 !important;
                min-width: auto !important;
            }
            .table .btn-sm {
                padding: 4px 8px !important;
                font-size: 0.75em !important;
                border-radius: 5px !important;
            }
            
            /* Action buttons container */
            .table .btn-group, .table .d-flex {
                gap: 4px !important;
                flex-wrap: nowrap !important;
                justify-content: center !important;
            }
            
            /* Pagination mobile styling */
            .custom-pagination { 
                margin-top: 20px !important;
                margin-bottom: 15px !important; 
            }
            .custom-pagination .pagination { 
                font-size: 0.9em !important;
                justify-content: center !important;
            }
            .custom-pagination .page-link {
                padding: 8px 12px !important;
            }
            
            /* Hide sidebar on mobile */
            .sidebar { display: none !important; }
            
            /* Form elements mobile optimization */
            .form-control, .form-select {
                font-size: 0.95em !important;
                padding: 10px 12px !important;
            }
            .btn {
                font-size: 0.9em !important;
                padding: 8px 15px !important;
            }
            .btn-sm {
                font-size: 0.85em !important;
                padding: 6px 10px !important;
            }
            
            /* Alert and components mobile */
            .alert {
                font-size: 0.9em !important;
                padding: 10px 15px !important;
                margin-bottom: 15px !important;
                border-radius: 8px !important;
            }
            
            /* Better scrollbar for tables */
            .table-responsive::-webkit-scrollbar {
                height: 8px;
            }
            .table-responsive::-webkit-scrollbar-track {
                background: #f8f9fa;
                border-radius: 4px;
            }
            .table-responsive::-webkit-scrollbar-thumb {
                background: #258fff;
                border-radius: 4px;
            }
            .table-responsive::-webkit-scrollbar-thumb:hover {
                background: #1557a6;
            }
            
            /* Table header improvements */
            .table thead th {
                background: #f8f9fa !important;
                position: sticky !important;
                top: 0 !important;
                z-index: 10 !important;
                font-weight: 700 !important;
                color: #284b63 !important;
                border-bottom: 2px solid #e3caa5 !important;
            }
            
            /* Text improvements for readability */
            .table td {
                line-height: 1.5 !important;
                word-wrap: break-word !important;
            }
            
            /* Status specific styling */
            .badge.bg-success { background: #28c76f !important; }
            .badge.bg-danger { background: #fa4654 !important; }
            .badge.bg-warning { background: #ffb800 !important; color: #fff !important; }
            .badge.bg-info { background: #19b8ff !important; }
        }
        
        /* Extra small devices ≤480px */
        @media (max-width: 480px) {
            .navbar-custom { padding: 6px 12px 4px 12px !important; }
            .navbar-brand { font-size: 0.95rem !important; }
            .navbar-brand img { height: 24px !important; }
            .nav-menu-link.nav-logout-btn { 
                padding: 4px 8px 4px 6px !important; 
                font-size: 0.85rem !important; 
                border-radius: 10px !important;
            }
            main {
                padding: 0 12px !important;
            }
            .main-content-bg { 
                padding: 16px 12px 20px 12px !important; 
                border-radius: 12px !important;
            }
            .offcanvas.offcanvas-start { max-width: 95vw !important; }
            
            .table {
                min-width: 500px !important;
                font-size: 0.85em !important;
            }
            .table th, .table td {
                padding: 10px 6px !important;
                font-size: 0.85em !important;
            }
            .table .badge, .table .btn {
                font-size: 0.75em !important;
                padding: 3px 6px !important;
            }
            .table .btn-sm {
                font-size: 0.7em !important;
                padding: 2px 5px !important;
            }
        }
        
        /* Very small devices ≤360px */
        @media (max-width: 360px) {
            .navbar-custom { padding: 4px 8px 2px 8px !important; }
            main {
                padding: 0 8px !important;
            }
            .main-content-bg { 
                padding: 12px 8px 16px 8px !important; 
                border-radius: 10px !important;
            }
            
            .table {
                min-width: 450px !important;
                font-size: 0.8em !important;
            }
            .table th, .table td {
                padding: 8px 4px !important;
                font-size: 0.8em !important;
            }
            .table .badge, .table .btn {
                font-size: 0.7em !important;
                padding: 2px 4px !important;
            }
            .table .btn-sm {
                font-size: 0.65em !important;
                padding: 1px 3px !important;
            }
        }
        
        /* Global box-sizing fix */
        * { box-sizing: border-box; }
        body, html, .container-fluid, .row, main, .main-content-bg {
            overflow-x: hidden !important; 
            box-sizing: border-box;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <button class="btn d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                <span data-feather="menu"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.index') }}">
                <img src="{{ asset('images/Logo-Si-Ukur.png') }}" alt="Logo">
            </a>
            <div class="navbar-profile ms-auto">
                <span class="fw-semibold d-none d-md-inline" style="color:#258fff">{{ auth()->user()->name ?? 'User' }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
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
        <div class="row">
            <!-- Sidebar desktop -->
            <div class="sidebar col-12 col-md-3 col-lg-2 p-0 d-none d-md-block">
                <div class="sidebar-header">
                    <div class="fw-bold">Menu Guru</div>
                </div>
                <ul class="nav flex-column pt-2">
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}" data-accent="blue" href="{{ route('admin.index') }}">
                            <span data-feather="home" class="feather"></span>
                            <span class="fw-bold fs-6">Dashboard</span>
                        </a>
                    </li>
                    @can('datasiswa_access')
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->is('admin/datasiswa*') ? 'active' : '' }}" data-accent="yellow" href="{{ route('admin.datasiswa.index') }}">
                            <span data-feather="users" class="feather"></span>
                            <span class="fw-bold fs-6">Data Siswa</span>
                        </a>
                    </li>
                    @endcan
                    @can('datalatihansiswa_access')
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->is('admin/datalatihan*') ? 'active' : '' }}" data-accent="green" href="{{ route('admin.datalatihan.index') }}">
                            <span data-feather="edit" class="feather"></span>
                            <span class="fw-bold fs-6">Data Latihan Siswa</span>
                        </a>
                    </li>
                    @endcan
                    @can('datahasilbelajarsiswa_access')
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->is('admin/hasilbelajar*') ? 'active' : '' }}" data-accent="orange" href="{{ route('admin.hasilbelajar.index') }}">
                            <span data-feather="bar-chart-2" class="feather"></span>
                            <span class="fw-bold fs-6">Hasil Belajar</span>
                        </a>
                    </li>
                    @endcan
                    @can('editkkm_access')
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->is('admin/kkm*') ? 'active' : '' }}" data-accent="yellow" href="{{ route('admin.kkm.index') }}">
                            <span data-feather="award" class="feather"></span>
                            <span class="fw-bold fs-6">KKM</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
            <!-- Sidebar mobile/offcanvas: SAMA persis dengan desktop! -->
            <div class="offcanvas offcanvas-start sidebar-offcanvas" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
                <div class="d-flex justify-content-between align-items-center px-2 pt-3 pb-1">
                    <div class="fw-bold ms-2">Menu Guru</div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="font-size:1.3em;"></button>
                </div>
                <ul class="nav flex-column pt-2">
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}" data-accent="blue" href="{{ route('admin.index') }}">
                            <span data-feather="home" class="feather"></span>
                            <span class="fw-bold fs-6">Dashboard</span>
                        </a>
                    </li>
                    @can('datasiswa_access')
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->is('admin/datasiswa*') ? 'active' : '' }}" data-accent="yellow" href="{{ route('admin.datasiswa.index') }}">
                            <span data-feather="users" class="feather"></span>
                            <span class="fw-bold fs-6">Data Siswa</span>
                        </a>
                    </li>
                    @endcan
                    @can('datalatihansiswa_access')
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->is('admin/datalatihan*') ? 'active' : '' }}" data-accent="green" href="{{ route('admin.datalatihan.index') }}">
                            <span data-feather="edit" class="feather"></span>
                            <span class="fw-bold fs-6">Data Latihan Siswa</span>
                        </a>
                    </li>
                    @endcan
                    @can('datahasilbelajarsiswa_access')
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->is('admin/hasilbelajar*') ? 'active' : '' }}" data-accent="orange" href="{{ route('admin.hasilbelajar.index') }}">
                            <span data-feather="bar-chart-2" class="feather"></span>
                            <span class="fw-bold fs-6">Hasil Belajar</span>
                        </a>
                    </li>
                    @endcan
                    @can('editkkm_access')
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->is('admin/kkm*') ? 'active' : '' }}" data-accent="yellow" href="{{ route('admin.kkm.index') }}">
                            <span data-feather="award" class="feather"></span>
                            <span class="fw-bold fs-6">KKM</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
            <!-- Main Content -->
            <main class="col-12 col-md-9 col-lg-10 px-md-4 py-4" style="padding:0 !important;box-sizing:border-box;">
                <div class="main-content-bg">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @stack('modals')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();

        // Tutup offcanvas sidebar saat menu diklik (mobile UX, auto-close)
        document.addEventListener('DOMContentLoaded', function() {
            var sidebarOffcanvas = document.getElementById('sidebarOffcanvas');
            var links = sidebarOffcanvas.querySelectorAll('.nav-link');
            links.forEach(function(link) {
                link.addEventListener('click', function() {
                    var bsOffcanvas = bootstrap.Offcanvas.getInstance(sidebarOffcanvas);
                    if (bsOffcanvas) bsOffcanvas.hide();
                });
            });
        });
    </script>
    @stack('scripts')
    <audio id="bg-music" src="{{ asset('sounds/music.mp3') }}" loop preload="auto"></audio>
    <script>
        const bgMusic = document.getElementById('bg-music');
        bgMusic.volume = 0.15;
        let musicStarted = false;
        function playMusic() {
            if (musicStarted) return;
            musicStarted = true;
            if (bgMusic.readyState >= 2) {
                bgMusic.play().then(()=> {
                    // Music started
                }).catch(e => {});
            } else {
                bgMusic.addEventListener('canplaythrough', () => {
                    bgMusic.play().catch(()=>{});
                }, {once: true});
            }
            window.removeEventListener('pointerdown', playMusic);
            window.removeEventListener('keydown', playMusic);
            window.removeEventListener('touchstart', playMusic);
        }
        window.addEventListener('pointerdown', playMusic, {passive:true});
        window.addEventListener('keydown', playMusic, {passive:true});
        window.addEventListener('touchstart', playMusic, {passive:true});
    </script>
</body>
</html>