<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="<?php echo e(asset('js/color-modes.js')); ?>"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#712cf9">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Si Ukur</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Nunito" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.css">
    <link rel="icon" sizes="180x180" href="<?php echo e(asset('ikon-si-ukur.ico')); ?>">
    <link href="<?php echo e(asset('css/dashboard.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('styles'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</head>
<body class="bg-coksu">
    <nav class="navbar-materi-menu">
        <div class="nav-left">
            <?php if(!request()->routeIs('admin.index')): ?>
            <a href="<?php echo e(route('admin.index')); ?>" class="nav-menu-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="none" stroke="#284b63" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle" style="margin-right:8px;vertical-align:middle;">
                    <path d="M19 12H5"></path>
                    <path d="M12 19l-7-7 7-7"></path>
                </svg>
                <span>Kembali ke Menu</span>
            </a>
            <?php endif; ?>
        </div>
        <div class="nav-right ms-auto">
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-menu-link nav-logout-btn" style="margin-right:12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="#284b63" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out align-middle" style="margin-right:7px;">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </nav>
    <?php echo $__env->yieldContent('content'); ?>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>feather.replace()</script>
    <?php echo $__env->yieldContent('scripts'); ?>
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
<?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/layouts/dash.blade.php ENDPATH**/ ?>