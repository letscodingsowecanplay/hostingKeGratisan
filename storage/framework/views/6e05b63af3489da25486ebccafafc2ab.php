<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Ukur</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" sizes="180x180" href="<?php echo e(asset('ikon-si-ukur.ico')); ?>">
    <style>
        html, body {
            min-height: 100%;
            margin: 0;
            padding: 0;
            background: #fffbe9;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        body {
            background-image:
                linear-gradient(0deg, #e3caa5 1.5px, transparent 1.5px),
                linear-gradient(90deg, #e3caa5 1.5px, transparent 1.5px);
            background-size: 40px 40px;
            background-position: center;
            min-height: 100vh;
        }
        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 28px 30px 0 30px;
            width: 100%;
            box-sizing: border-box;
        }
        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 7px;
            font-family: 'Baloo 2', Arial, sans-serif;
        }
        .navbar-logo img {
            width: 100px;
            height: auto;
        }
        .navbar-right {
            margin-left: 30px;
        }
        .guru-btn {
            background: #258fff;
            color: rgb(0, 0, 0);
            border: none;
            border-radius: 18px;
            padding: 8px 28px;
            font-size: 1.06rem;
            font-weight: 600;
            font-family: 'Baloo 2', Arial, sans-serif;
            cursor: pointer;
            box-shadow: 0 3px 12px #258fff33;
            transition: background .17s;
            text-decoration: none;
            margin-left: 10px;
            display: inline-block;
        }
        .guru-btn:hover {
            background: #1557a6;
            color: #fff;
        }
        .hero-section {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .hero-content-wrap {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 38px;
            flex: 1;
            padding: 24px 32px 24px 32px;
            min-height: 76vh;
            box-sizing: border-box;
        }
        .hero-img {
            width: 120px;
            height: 150px;
            background: #fffbe9;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 2px 12px #b5e6ff29;
            object-fit: cover;
            flex-shrink: 0;
        }
        .hero-img img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .hero-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 0;
        }
        .hero-title {
            font-family: 'Baloo 2', Arial, sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            color: rgb(0, 0, 0);
            text-align: center;
            margin-bottom: 18px;
            letter-spacing: 0.5px;
        }
        .hero-sub {
            color: #222;
            font-weight: 500;
            text-align: center;
            margin-bottom: 32px;
            font-size: 1.19rem;
        }
        .hero-btn {
            background: #ffe145;
            color: rgb(0, 0, 0);
            font-family: 'Baloo 2', Arial, sans-serif;
            border: none;
            border-radius: 24px;
            padding: 15px 44px;
            font-size: 1.19rem;
            font-weight: 700;
            box-shadow: 0 3px 12px #ffd42629;
            cursor: pointer;
            margin-bottom: 0;
            transition: background .18s;
        }
        .hero-btn:hover {
            background: #ffd600;
        }
        .fitur-title {
            font-family: 'Baloo 2', Arial, sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: rgb(0, 0, 0);
            text-align: center;
            margin-top: 58px;
            margin-bottom: 2px;
            letter-spacing: 0.2px;
        }
        .fitur-desc {
            text-align: center;
            font-size: 1.08rem;
            color: rgb(0, 0, 0);
            margin-bottom: 34px;
            margin-top: 10px;
            font-weight: 500;
        }
        .main-grid {
            max-width: 960px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 18px 30px 50px 30px;
            box-sizing: border-box;
        }
        .card-box {
            border-radius: 22px;
            box-shadow: 0 4px 22px #00000011;
            color: #111;
            padding: 36px 24px 28px 24px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: relative;
            font-size: 1.05rem;
            background: #fff;
        }
        .red-card    { background: linear-gradient(120deg, #f5515f 80%, #f67262 100%);}
        .yellow-card { background: linear-gradient(120deg, #ffe145 85%, #fbd046 100%);}
        .blue-card   { background: linear-gradient(120deg, #3f73d3 80%, #43a1e2 100%);}
        .card-title {
            font-size: 1.22rem;
            font-weight: 700;
            margin-bottom: 13px;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 8px #00000018;
        }
        .card-content {
            font-size: 1.05rem;
            line-height: 1.56;
            color: rgb(0, 0, 0);
            font-weight: 500;
        }

        /* RESPONSIVE BREAKPOINTS */
        @media (max-width: 1100px) {
            .navbar, .hero-content-wrap, .main-grid { max-width: 99vw; }
            .main-grid { padding: 12px 8vw 30px 8vw; }
            .hero-content-wrap { padding: 20px 5vw; }
        }
        @media (max-width: 900px) {
            .main-grid { grid-template-columns: 1fr; gap: 22px; padding: 12px 3vw 26px 3vw;}
            .card-box { padding: 26px 4vw 18px 4vw; min-height: 140px;}
            .hero-content-wrap { flex-direction: column; gap: 22px; min-height: 60vh; }
            .hero-img { width: 88px; height: 98px;}
            .hero-title { font-size: 1.8rem;}
        }
        @media (max-width: 650px) {
            .navbar { flex-direction: column; gap: 5px; padding: 10px 2vw 0 2vw;}
            .navbar-logo img { width: 74px; }
            .hero-content-wrap { flex-direction: column; gap: 12px; min-height: 48vh; padding: 10px 2vw 12px 2vw;}
            .main-grid { grid-template-columns: 1fr; padding: 8px 1vw 16px 1vw;}
            .card-box { padding: 18px 4vw 14px 4vw;}
            .hero-img { width: 60px; height: 70px;}
            .hero-title { font-size: 1.18rem;}
            .fitur-title { font-size: 1.08rem; margin-top: 22px; }
            .fitur-desc { font-size: 0.97rem; margin-bottom: 17px; }
            .guru-btn, .hero-btn { font-size: 1rem; padding: 10px 20px; }
        }
        @media (max-width: 400px) {
            .card-title { font-size: 0.98rem;}
            .fitur-title { font-size: 0.97rem; }
            .main-grid, .card-box { padding: 4px 2vw; }
        }
    </style>
</head>
<body>
    <audio id="bg-music" src="<?php echo e(asset('sounds/music.mp3')); ?>" loop preload="auto"></audio>
    <script>
        const bgMusic = document.getElementById('bg-music');
        bgMusic.volume = 0.25;
        let musicStarted = false;
        function playMusic() {
            if (musicStarted) return;
            musicStarted = true;
            if (bgMusic.readyState >= 2) {
                bgMusic.play().catch(()=>{});
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

    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-logo">
            <img src="<?php echo e(asset('images/Logo-Si-Ukur.png')); ?>" alt="Logo">
        </div>
        <div class="navbar-right">
            <a href="<?php echo e(route('login.guru')); ?>" class="guru-btn">Masuk sebagai Guru</a>
        </div>
    </div>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content-wrap">
            <div class="hero-img">
                <img src="<?php echo e(asset('images/bekantan.png')); ?>" alt="Anak SD">
            </div>
            <div class="hero-content">
                <div class="hero-title">Selamat Datang di <br>Website Si Ukur</div>
                <div class="hero-sub">
                    Media Pembelajaran Interaktif Berbasis Web Materi Pengukuran Kelas 1 SD Berkonteks Kearifan Lokal Lahan Basah
                </div>
                <a href="<?php echo e(route('login.siswa')); ?>">
                    <button class="hero-btn">Masuk Sebagai Siswa</button>
                </a>
            </div>
            <div class="hero-img">
                <img src="<?php echo e(asset('images/borneo.png')); ?>" alt="Anak SD">
            </div>
        </div>
    </section>
    <!-- Fitur Section -->
    <div class="fitur-title">Fitur-Fitur</div>
    <div class="fitur-desc">
        Media pembelajaran ini memiliki beberapa fitur sebagai berikut.
    </div>
    <div class="main-grid">
        <!-- MATERI -->
        <div class="card-box red-card">
            <div class="card-title">Materi</div>
            <div class="card-content">
                Menyajikan penjelasan konsep pengukuran panjang, membandingkan benda, dan mengenalkan satuan tidak baku secara visual dan interaktif untuk siswa kelas 1 SD.
            </div>
        </div>
        <!-- LATIHAN -->
        <div class="card-box yellow-card">
            <div class="card-title">Latihan</div>
            <div class="card-content">
                Berisi soal-soal interaktif untuk melatih pemahaman siswa terhadap materi pengukuran, membandingkan panjang, serta menggunakan satuan tidak baku dalam kehidupan sehari-hari.
            </div>
        </div>
        <!-- EVALUASI -->
        <div class="card-box blue-card">
            <div class="card-title">Evaluasi</div>
            <div class="card-content">
                Mengukur pencapaian belajar siswa melalui serangkaian soal evaluasi untuk mengetahui penguasaan konsep dan kemampuan menerapkan pengukuran sederhana.
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/welcome.blade.php ENDPATH**/ ?>