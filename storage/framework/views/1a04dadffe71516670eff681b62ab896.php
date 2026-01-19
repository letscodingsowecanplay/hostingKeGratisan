

<?php $__env->startSection('content'); ?>
<div class="materi-main-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Pengukuran
    </div>

    <div class="materi-section">
        <div class="materi-content">
            <p class=" mb-1">
                Kita bandingkan lukisan a, b, c, dan d.
                <button onclick="toggleAudio(this)"
                        class="btn-audio ms-2"
                        data-id="index-2" data-playing="false">🔊</button>
                <audio id="audio-index-2" src="<?php echo e(asset('sounds/materi/hal7/2.mp3')); ?>"></audio>
            </p>
        </div>
    </div>

    <div class="materi-section">
        <div class="text-center my-4">
            <img src="<?php echo e(asset('images/materi/susunan-foto-banjar.png')); ?>"
                 alt="Susunan Foto Banjar"
                 class="rounded shadow w-100 h-100">
        </div>
    </div>

    <div class="materi-section">
        <div class="materi-content">
            <button onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal7/1.mp3')); ?>"></audio>
            <p class="mt-2 ">
                Lukisan a lebih tinggi dari lukisan b, c, dan d.<br>
                Jadi, lukisan a paling tinggi.
            </p>

            <p class="mt-2 ">
                Lukisan d lebih rendah dari lukisan c, b, dan a.<br>
                Jadi, lukisan d paling rendah.
            </p>

            <p class="mt-2 ">
                Kita dapat membandingkan tinggi tiga benda atau lebih.<br>
                Kita menggunakan kata:<br>
                <b>• paling tinggi</b><br>
                <b>• paling rendah</b>
            </p>

            <!-- Tambahan warna-label dan judul sebelum penjelasan mengurutkan -->
            <span class="warna-label orange-card">Mengurutkan Benda</span>
            <button onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    data-id="index-3" data-playing="false">🔊</button>
            <audio id="audio-index-3" src="<?php echo e(asset('sounds/materi/hal7/3.mp3')); ?>"></audio>
            <p class="mt-2 ">
                Mengurutkan panjang, pendek, tinggi, dan rendah adalah proses menyusun benda-benda berdasarkan ukurannya, baik dari segi jarak maupun ketinggian. Dalam pengurutan ini, kita bisa mulai dari yang paling kecil hingga yang paling besar atau sebaliknya, tergantung kebutuhan. Benda yang lebih panjang atau lebih tinggi ditempatkan di salah satu ujung urutan, sementara yang lebih pendek atau lebih rendah berada di ujung lainnya.
            </p>

            <p class="mt-2 ">
                Urutan lukisan dari yang paling tinggi adalah a, b, c, dan d
                atau a, c, b, dan d.<br>
                Urutan lukisan dari yang paling rendah adalah d, c, b, dan a
                atau d, b, c, dan a.
            </p>
        </div>  
    </div>

    <div class="materi-nav-footer" style="margin-top:32px;">
        <a href="<?php echo e(route('admin.materi.halaman6')); ?>" class="btn-nav" style="min-width:160px;">
            ← Sebelumnya
        </a>
        <a href="<?php echo e(route('admin.materi.halaman8')); ?>" class="btn-nav btn-next" style="min-width:160px;">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman7.blade.php ENDPATH**/ ?>