

<?php $__env->startSection('content'); ?>
<div class="materi-main-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Pengukuran
    </div>
    <div class="materi-section">
        <div class="d-flex align-items-center mb-3">
            <span class="warna-label green-card">Ayo Belajar</span>
            <button onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal6/1.mp3')); ?>"></audio>
        </div>
        <div class="materi-content">
            Membandingkan ukuran berarti melihat perbedaan antara dua atau lebih benda berdasarkan panjang, pendek, tinggi, atau rendahnya. Dengan membandingkan, kita bisa mengetahui mana benda yang lebih panjang, lebih pendek, lebih tinggi, atau lebih rendah.  Perhatikan contoh berikut.
        </div>
    </div>

    <div class="materi-section">
        <div class="text-center my-4">
            <img src="<?php echo e(asset('images/materi/susunan-foto-banjar.png')); ?>"
                alt="Susunan Foto Banjar"
                class="rounded shadow w-100 h-100">
        </div>
    </div>

    <!-- Box Tahukah Kalian -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #fffde7; border-left: 5px solid #ffb300; padding: 16px 18px; border-radius: 10px; font-size: 1.08rem; color: #775b08; margin-bottom: 18px; box-shadow: 0 2px 8px #ffb30018;">
            <strong>Tahukah Kalian?</strong>
            <br>
            Lukisan-lukisan pada gambar di atas menampilkan keindahan budaya masyarakat Banjar yang tinggal di wilayah lahan basah Kalimantan Selatan. Kehidupan di lahan basah sangat erat dengan sungai, hewan bekantan, perahu jukung, dan berbagai tradisi unik lainnya yang sering menjadi inspirasi dalam karya seni. Dengan memperhatikan lukisan ini, kita bisa belajar mengenal ciri khas budaya dan alam daerah lahan basah.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-1" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-1" src="<?php echo e(asset('sounds/materi/hal6/narasi-1.mp3')); ?>"></audio>
        </div>
    </div>

    <div class="materi-section">
        <div class="materi-content">
            <button onclick="toggleAudio(this)"
                    class="btn-audio"
                    data-id="index-2" data-playing="false">🔊</button>
            <audio id="audio-index-2" src="<?php echo e(asset('sounds/materi/hal6/2.mp3')); ?>"></audio>
            <p class="mt-2">
                Kita akan membandingkan tinggi lukisan khas Kalimantan yang digantung yaitu c dan d.
            </p>
            <p class="mt-2">
                Lukisan c lebih tinggi dari lukisan d.
            </p>
            <p class="mt-2">
                Lukisan d lebih rendah dari lukisan c.
            </p>
            <p class="mt-2">
                Kita dapat membandingkan tinggi dua benda.
                Kita menggunakan kata:<br>
                <b>• lebih tinggi</b><br>
                <b>• lebih rendah</b>
            </p>
            <p class="mt-2">
                Kita akan membandingkan tinggi lukisan b dan c.
            </p>
            <p class="mt-2">
                Lukisan b sama tinggi dengan lukisan c.
            </p>
            <p class="mt-2">
                Dua benda ada yang sama tingginya. Kita menggunakan kata <b>sama tinggi</b> untuk membandingkannya.
            </p>
        </div> 
    </div>

    <div class="materi-nav-footer" style="margin-top:32px;">
        <a href="<?php echo e(route('admin.materi.halaman5')); ?>" class="btn-nav" style="min-width:160px;">
            ← Sebelumnya
        </a>
        <a href="<?php echo e(route('admin.materi.halaman7')); ?>" class="btn-nav btn-next" style="min-width:160px;">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman6.blade.php ENDPATH**/ ?>