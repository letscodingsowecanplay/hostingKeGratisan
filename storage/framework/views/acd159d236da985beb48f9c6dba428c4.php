<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Ukur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" sizes="180x180" href="<?php echo e(asset('ikon-si-ukur.ico')); ?>">

    <style>
        html, body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #fffbe9 !important;
            min-height: 100vh;
        }
        body {
            background-image: linear-gradient(0deg, #e3caa5 1.5px, transparent 1.5px), linear-gradient(90deg, #e3caa5 1.5px, transparent 1.5px);
            background-size: 40px 40px;
            background-position: center top;
            margin: 0;
        }
        .kuis-flexbox-container {
            display: flex;
            gap: 32px;
            justify-content: center;
            align-items: stretch;
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }
        .soal-section {
            flex: 1.6;
            min-width: 320px;
            max-width: 660px;
            background: linear-gradient(120deg,#fffbe9 93%,#e3caa5 100%);
            border-radius: 25px;
            border: 2.2px solid #ffe145;
            box-shadow: 0 3px 16px #fbd04627, 0 1.5px 8px #43cea22a;
            padding: 32px 28px 26px 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 520px;
        }
        .navigasi-section {
            flex: 1;
            min-width: 230px;
            max-width: 320px;
            background: linear-gradient(120deg,#fffbe9 92%,#fbb954 100%);
            border-radius: 25px;
            border: 2.2px solid #20b484;
            box-shadow: 0 3px 16px #43cea22b, 0 1.5px 8px #fbb95426;
            padding: 29px 18px 19px 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .materi-card  { box-shadow: 0 2px 16px #284b633a !important; }
        .materi-card2 { box-shadow: 0 2px 16px #fbb95433 !important; }
        .warna-label {
            display: inline-block;
            padding: 7px 20px 7px 16px;
            border-radius: 16px 16px 0 16px;
            font-size: 1.03rem;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 10px #00000010;
            vertical-align: middle;
            line-height: 1;
            color: #fff !important;
        }
        .yellow-card { background: linear-gradient(120deg, #ffe145 85%, #fbd046 100%);}
        .green-card  { background: linear-gradient(120deg, #20b484 85%, #43cea2 100%);}
        .question-title {
            font-weight: 700;
            font-size: 1.11em;
            margin: 16px 0 7px 0;
            color: #284b63;
            background: linear-gradient(90deg,#ffe14525 40%, #e3caa519 100%);
            border-radius: 13px;
            padding: 10px 17px;
            box-shadow: 0 2px 12px #fbb9540a;
            border: 1.2px solid #ffe14544;
        }
        #soal-gambar {
            width: 100%;
            max-width: 400px;
            height: auto;
            max-height: 260px;
            display: block;
            margin: 0 auto 8px auto;
            border-radius: 17px;
            object-fit: contain;
            background: #fffbe9;
            border: 2px solid #ffe14533;
            box-shadow: 0 2px 15px #b6a87519;
        }
        .pilihan-jawaban-wrap { display: flex; flex-direction: column; gap: 16px; margin-top:14px;}
        .pilihan-jawaban-opsi {
            display: flex; align-items: center;
            border: 2.2px solid #e3caa5; border-radius:16px;
            background: #fff; font-size:1.13em; font-weight:600;
            padding: 13px 19px; cursor:pointer; transition:.14s;
            box-shadow:0 2px 9px #e3caa522; min-height:52px; user-select:none;
        }
        .pilihan-jawaban-opsi.selected {
            border-color: #43cea2 !important;
            background: linear-gradient(90deg,#e6fff6 75%, #c6fbe7 100%);
            color:#1b3f2f;
            box-shadow:0 3px 14px #43cea233;
        }
        .pilihan-jawaban-huruf {
            display: inline-block; width:44px; height:44px; line-height:41px; text-align:center;
            font-weight:700; border-radius:13px; margin-right:16px;
            background: linear-gradient(120deg, #ffe145 80%, #fbd046 100%);
            color: #222; font-size:1.12em;
            border:1.2px solid #ffe14555;
        }
        .play-pilihan-audio {
            background: #fffbe9;
            border: 1.2px solid #e3caa5;
            border-radius: 9px;
            padding: 2px 11px;
            font-size: 1.08rem;
            font-weight: 600;
            color: #284b63;
            margin-left: 7px;
        }
        .play-pilihan-audio:hover, .play-pilihan-audio:focus {
            background: #ffe145;
            color: #444;
            border-color: #ffe145;
        }
        #navigasi-nomor .btn {
            font-size:1.13em; font-weight:700; min-width:43px; min-height:44px; border-radius:9px;
            border-width:2px; box-shadow: 0 2px 9px #20b48411;
            margin:2.5px 4px 2.5px 0;
            font-family: 'Montserrat', Arial, sans-serif;
            transition:.16s;
        }
        #navigasi-nomor .btn-success { background:linear-gradient(120deg,#43cea2 80%,#20b484 100%); color:#fff;}
        #navigasi-nomor .btn-warning { background:linear-gradient(120deg,#ffe145 95%,#fbd046 100%); color:#444; border-color:#ffe145 !important;}
        #navigasi-nomor .btn-light, #navigasi-nomor .btn-outline-dark {background:#fff;}
        .badge.bg-success {background:linear-gradient(120deg,#43cea2 80%,#20b484 100%);}
        .badge.bg-warning {background:linear-gradient(120deg,#ffe145 95%,#fbd046 100%); color:#444;}
        .badge.bg-light {background:#fff;}
        .kuis-btn-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px 18px;
            width: 100%;
        }
        .kuis-btn-grid .btn,
        .kuis-btn-grid a.btn {
            width: 100%;
            font-size: 1.08rem !important;
            padding-top: 12px !important;
            padding-bottom: 12px !important;
            border-radius: 13px !important;
        }
        .btn-danger { background:linear-gradient(120deg, #4E1F00 90%, #a3855f 100%) !important; color:#fff !important;}
        .btn-danger:hover {background: #a3855f !important;}
        @media (max-width:1000px) {
            .kuis-flexbox-container {flex-direction:column; gap:18px; align-items:stretch;}
            .soal-section, .navigasi-section {max-width:100vw;}
            #soal-gambar {max-width:94vw;}
        }
        @media (max-width:700px) {
            .kuis-flexbox-container {padding:0 0.5vw;}
            .soal-section, .navigasi-section {padding:10px 1vw;}
            #soal-gambar {max-width:98vw;}
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <audio id="bg-music" src="<?php echo e(asset('sounds/music.mp3')); ?>" loop preload="auto"></audio>
    <script>
        const bgMusic = document.getElementById('bg-music');
        bgMusic.volume = 0.15;
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
<?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/layouts/master-kuis.blade.php ENDPATH**/ ?>