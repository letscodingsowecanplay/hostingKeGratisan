<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Ukur – Website Belajar Pengukuran Satuan Tak Baku</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            min-height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #f5fbff;
            background-image: 
                linear-gradient(0deg, #b1d5fd 1.5px, transparent 1.5px),
                linear-gradient(90deg, #b1d5fd 1.5px, transparent 1.5px);
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
        }
        .navbar-logo {
            font-size: 1.2rem;
            font-weight: 700;
            color: #258fff;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 7px;
            font-family: 'Baloo 2', Arial, sans-serif;
        }
        .navbar-menu {
            display: flex;
            gap: 28px;
        }
        .navbar-menu a {
            color: #258fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.04rem;
            padding: 3px 0;
            border-bottom: 2.5px solid transparent;
            transition: border 0.16s;
        }
        .navbar-menu a:hover, .navbar-menu a.active {
            border-bottom: 2.5px solid #258fff;
        }
        .navbar-right {
            margin-left: 30px;
        }
        .guru-btn {
            background: #258fff;
            color: #fff;
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
        }
        /* Hero Section */
        .hero {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            padding: 18px 30px 8px 30px;
        }
        .hero-img {
            width: 110px;
            height: 142px;
            background: #e1f2ff;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 2px 12px #b5e6ff29;
            object-fit: cover;
        }
        .hero-img img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .hero-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .logo-img {
            width: 220px;
            margin-bottom: 10px;
            margin-top: 0px;
        }
        .hero-title {
            font-family: 'Baloo 2', Arial, sans-serif;
            font-size: 2.1rem;
            font-weight: 700;
            color: #258fff;
            text-align: center;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }
        .hero-sub {
            color: #258fff;
            font-weight: 500;
            text-align: center;
            margin-bottom: 18px;
            font-size: 1.15rem;
        }
        .hero-btn {
            background: #ffe145;
            color: #234d10;
            font-family: 'Baloo 2', Arial, sans-serif;
            border: none;
            border-radius: 24px;
            padding: 14px 38px;
            font-size: 1.16rem;
            font-weight: 700;
            box-shadow: 0 3px 12px #ffd42629;
            cursor: pointer;
            margin-bottom: 8px;
            transition: background .18s;
        }
        .hero-btn:hover {
            background: #ffd600;
        }
        /* Grid 4 Kolom Berwarna */
        .main-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px;
            padding: 30px 30px 38px 30px;
        }
        .card-box {
            border-radius: 22px;
            box-shadow: 0 4px 22px #00000011;
            color: #fff;
            padding: 36px 24px 28px 24px;
            min-height: 230px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: relative;
            font-size: 1.05rem;
        }
        .red-card    { background: linear-gradient(120deg, #f5515f 80%, #f67262 100%);}
        .yellow-card { background: linear-gradient(120deg, #ffe145 85%, #fbd046 100%);}
        .green-card  { background: linear-gradient(120deg, #20b484 85%, #43cea2 100%);}
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
            color: #fffde7;
            font-weight: 500;
        }
        .card-list {
            margin: 0 0 0 1em;
            padding: 0;
            color: #fffde7;
        }
        .card-list li {
            margin-bottom: 6px;
        }
        .card-content a {
            color: #fff;
            text-decoration: underline;
            word-break: break-all;
        }
        @media (max-width: 1200px) {
            .navbar, .hero, .main-grid { max-width: 99vw; }
            .main-grid { gap: 18px; padding: 18px 2vw 22px 2vw;}
        }
        @media (max-width: 1000px) {
            .main-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 650px) {
            .navbar { flex-direction: column; gap: 5px; padding: 12px 4vw 0 4vw;}
            .hero { flex-direction: column; gap: 18px; padding: 8px 2vw 4px 2vw;}
            .logo-img { width: 130px;}
            .main-grid { grid-template-columns: 1fr; padding: 8px 1vw 16px 1vw;}
            .card-box { padding: 26px 4vw 18px 4vw;}
            .hero-img { width: 70px; height: 80px;}
            .hero-title { font-size: 1.1rem;}
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <div class="navbar">
        <div class="navbar-logo">
            <span style="font-size: 1.6em;">🟦</span> Si Ukur
        </div>
        <div class="navbar-right">
            <a href="{{ route('login.guru') }}" class="guru-btn">Masuk sebagai Guru</a>
        </div>
    </div>
    {{-- Hero Section --}}
    <div class="hero">
        <div class="hero-img">
            {{-- Gambar anak/kartun kiri --}}
            <img src="{{ asset('images/siswa-cowo.png') }}" alt="Anak SD">
        </div>
        <div class="hero-content">
            <img src="{{ asset('images/logo-siukur.png') }}" alt="Logo Si Ukur" class="logo-img" onerror="this.style.display='none'">
            <div class="hero-title">Selamat Datang di <br>Website Si Ukur</div>
            <div class="hero-sub">
                Website Belajar Pengukuran Satuan Tak Baku untuk SD Kelas 1
            </div>
            <a href="{{ route('login.siswa') }}">
                <button class="hero-btn">Masuk Sebagai Siswa</button>
            </a>
        </div>
        <div class="hero-img">
            <img src="{{ asset('images/siswa-cewe.png') }}" alt="Anak SD">
        </div>
    </div>
    {{-- 4 GRID WARNA --}}
    <div class="main-grid">
        <!-- INFORMASI -->
        <div class="card-box red-card">
            <div class="card-title">Informasi</div>
            <div class="card-content">
                Si Ukur adalah website pembelajaran interaktif yang dirancang khusus untuk siswa SD kelas 1. Fokus pada materi pengukuran dengan satuan tak baku, disajikan secara menarik dan mudah dipahami anak-anak.
            </div>
        </div>
        <!-- CAPAIAN PEMBELAJARAN -->
        <div class="card-box yellow-card">
            <div class="card-title">Capaian Pembelajaran</div>
            <div class="card-content" style="color:#906500">
                Peserta didik dapat membandingkan panjang. Mereka dapat mengukur dan mengestimasi panjang benda menggunakan satuan tidak baku.
            </div>
        </div>
        <!-- TENTANG PEMBUAT -->
        <div class="card-box green-card">
            <div class="card-title">Tentang Pembuat</div>
            <div class="card-content" style="margin-bottom: 12px;">
                <b>Pembuat:</b> Ana Maria Parasantii<br>
                <b>NIM:</b> 211013320009<br>
                <b>Pembimbing 1:</b> Dr. R. Ati Sukmawati, M.Kom.<br>
                <b>Pembimbing 2:</b> Deliska Pramata Sari, M.Pd.<br>
                <b>Prodi:</b> Pendidikan Komputer<br>
                <b>Fakultas:</b> Keguruan dan Ilmu Pendidikan<br>
                <b>Universitas:</b> Lambung Mangkurat<br>
                <b>Email:</b> 211013320009@ulm.ac.id
            </div>
        </div>
        <!-- DAFTAR PUSTAKA -->
        <div class="card-box blue-card">
            <div class="card-title">Daftar Pustaka</div>
            <div class="card-content">
                <ul class="card-list">
                    <li>Purnomosidi, Wiyanto, & Endang, S. (2008). <i>Matematika Untuk SD/MI Kelas 1</i>. Jakarta: Pusat Perbukuan, Departemen Pendidikan Nasional.</li>
                    <li>Retno, D., & Rasfitawati, Y.W. (2022). <i>Matematika SD/MI Kelas 1</i>. Pusat Perbukuan Badan Standar, Kurikulum, dan Asesmen Pendidikan Kemdikbud.</li>
                </ul>
                <a href="https://buku.kemdikbud.go.id/" target="_blank">https://buku.kemdikbud.go.id/</a>
            </div>
        </div>
    </div>
</body>
</html>
