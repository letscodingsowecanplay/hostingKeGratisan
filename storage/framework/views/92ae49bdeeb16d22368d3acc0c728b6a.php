

<?php $__env->startSection('content'); ?>

<!-- Petunjuk Audio di luar main container -->
<div class="materi-main-container">
    <div class="petunjuk-audio materi-content">
        <div>
            <b>Petunjuk:</b> Kalau kamu ingin mendengar kalimatnya, tekan tombol 🔊
            yang ada di sebelah tulisan. Nanti akan ada suara yang membacakan materi untukmu!
            <button onclick="toggleAudio(this)" 
                class="btn-audio ms-3"
                data-id="index-0" data-playing="false"
                style="margin-left:24px;">
                🔊
            </button>
            <audio id="audio-index-0" src="<?php echo e(asset('sounds/materi/index/0.mp3')); ?>"></audio>
        </div>
    </div>
</div>

<div class="materi-main-container">

    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:8px;">
        Pengukuran
    </div>

    <!-- Section 1: Membandingkan & Tujuan -->
    <div class="materi-section">
        <span class="warna-label green-card">Membandingkan dan Mengurutkan Panjang Benda
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal2/1.mp3')); ?>"></audio>
        </span>
        <div class="materi-content">
            <span class="warna-label yellow-card" style="margin-bottom:6px;">Tujuan Pembelajaran
                <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-2" data-playing="false">🔊</button>
                <audio id="audio-index-2" src="<?php echo e(asset('sounds/materi/hal2/2.mp3')); ?>"></audio>
            </span>
            <br>
            Setelah mempelajari materi ini, diharapkan peserta didik dapat:
            <ul class="materi-list" style="margin-top:5px;">
                <li>Membandingkan panjang benda;</li>
                <li>Mengurutkan benda berdasarkan panjangnya.</li>
            </ul>
        </div>
    </div>

    <!-- Section 2: Ayo Belajar -->
    <div class="materi-section">
        <span class="warna-label blue-card">Ayo Belajar
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-3" data-playing="false">🔊</button>
            <audio id="audio-index-3" src="<?php echo e(asset('sounds/materi/hal2/3.mp3')); ?>"></audio>
        </span>
        <div class="materi-content">
            Pengukuran adalah cara untuk mengetahui seberapa besar, panjang, atau tinggi suatu benda. Dengan pengukuran, kita dapat membandingkan benda-benda di sekitar kita. Perhatikan contoh berikut.
        </div>
    </div>

    <!-- Box Tahukah Kalian -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #fffde7; border-left: 5px solid #ffb300; padding: 16px 18px; border-radius: 10px; font-size: 1.08rem; color: #775b08; margin-bottom: 18px; box-shadow: 0 2px 8px #ffb30018;font-weight: 500;">
            <strong>Tahukah Kalian?</strong>
            <br>
            Baju pengantin yang kalian lihat pada gambar adalah <b>baju pengantin Banjar</b>, baju ini dipakai oleh pengantin dalam upacara pernikahan adat di Kalimantan Selatan. Baju ini memiliki bentuk dan hiasan yang khas, serta digunakan untuk menunjukkan keindahan budaya masyarakat Banjar. Dengan memakai baju adat saat menikah, masyarakat Banjar ikut melestarikan dan mengenalkan tradisi daerah kepada generasi muda
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-1" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-1" src="<?php echo e(asset('sounds/materi/hal2/narasi-1.mp3')); ?>"></audio>
        </div>
    </div>

    <!-- Section 3: Gambar -->
    <div class="materi-section">
        <div class="materi-image-row">
            <div class="materi-image-col">
                <img src="<?php echo e(asset('images/materi/baju-sasi-pendek.png')); ?>" class="img-fluid rounded shadow" alt="Gambar Penggaris">
                <div class="materi-caption">
                    baju pengantin banjar lengan pendek
                    <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-4" data-playing="false">🔊</button>
                    <audio id="audio-index-4" src="<?php echo e(asset('sounds/materi/hal2/4.mp3')); ?>"></audio>
                </div>
            </div>
            <div class="materi-image-col">
                <img src="<?php echo e(asset('images/materi/baju-sasi-panjang.png')); ?>" class="img-fluid rounded shadow" alt="Gambar Pensil">
                <div class="materi-caption">
                    baju pengantin banjar lengan panjang
                    <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-5" data-playing="false">🔊</button>
                    <audio id="audio-index-5" src="<?php echo e(asset('sounds/materi/hal2/5.mp3')); ?>"></audio>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi bawah -->
    <div class="materi-nav-footer">
        <a href="<?php echo e(route('admin.materi.index')); ?>" class="btn-nav">
            ← Sebelumnya
        </a>
        <a href="<?php echo e(route('admin.materi.halaman3')); ?>" class="btn-nav btn-next">
            Selanjutnya →
        </a>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);

    // Pause semua audio KECUALI background music
    document.querySelectorAll('audio').forEach(a => {
        // Cek id
        if (a !== audio && a.id !== 'bg-music') {
            a.pause();
            a.currentTime = 0;
        }
    });

    // Reset semua tombol ke 🔊
    document.querySelectorAll('.btn-audio').forEach(btn => {
        if (btn !== button) {
            btn.innerText = '🔊';
            btn.setAttribute('data-playing', 'false');
        }
    });

    // Toggle play/pause
    if (audio.paused) {
        audio.play();
        button.innerText = '⏸️';
        button.setAttribute('data-playing', 'true');
    } else {
        audio.pause();
        button.innerText = '🔊';
        button.setAttribute('data-playing', 'false');
    }

    // Auto-reset ikon saat audio selesai
    audio.onended = function () {
        button.innerText = '🔊';
        button.setAttribute('data-playing', 'false');
    };
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman2.blade.php ENDPATH**/ ?>