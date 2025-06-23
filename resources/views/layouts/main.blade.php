<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Ukur - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('ikon-si-ukur.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @yield('styles')
</head>
<body class="auth-bg">
    <nav class="navbar-custom">
        <a href="{{ route('welcome') }}" class="btn-kembali">Kembali</a>
    </nav>
    @yield('content')
    <audio id="bg-music" src="{{ asset('sounds/music.mp3') }}" loop preload="auto"></audio>
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
