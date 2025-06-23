

<?php $__env->startSection('content'); ?>

<div class="materi-main-container fs-5">
    <h2 class="fw-bold text-center mb-3" style="font-size:2rem;">Pengukuran</h2>

    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label blue-card mb-3" style="font-size:1rem;">Langkah Pengukuran</div>
        <button onclick="toggleAudio(this)" 
                class="btn-audio"
                data-id="index-1" data-playing="false" type="button">🔊</button>
        <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal13/1.mp3')); ?>"></audio>
        <div class="materi-content mb-2">
            Mengukur panjang benda menggunakan satuan tidak baku dapat dilakukan dengan beberapa langkah sederhana.<br><br>
            Cara mengukur yang benar:
            <ol class="materi-list" style="margin-top: 5px; margin-bottom: 0;">
                <li>Mulai dari ujung benda.</li>
                <li>Alat ukur rapat.</li>
                <li>Alat ukur tidak bertumpuk.</li>
                <li>Alat ukur tidak miring.</li>
            </ol>
            <br>
            Perhatikan contoh berikut.<br>
            Gambar di bawah ini menunjukkan cara mengukur panjang ikan papuyu dengan menggunakan sedotan sebagai alat ukurnya.
        </div>
    </div>

    
    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label yellow-card mb-3" style="font-size:1rem;">Contoh Gambar</div>
        <div class="materi-image-row flex-wrap justify-content-center" style="gap:26px;">
            <div class="materi-image-col" style="max-width:280px;">
                <img src="<?php echo e(asset('images/materi/ukur-salah-1.png')); ?>"
                     class="img-fluid materi-img rounded-4 shadow"
                     style="max-height: 200px; background: #fffbe9; cursor: pointer;"
                     alt="Alat ukur diletakkan renggang, tidak rapat pada ujung benda."
                     data-bs-toggle="tooltip"
                     data-bs-placement="top"
                     title="Alat ukur diletakkan renggang, tidak rapat pada ujung benda." />
            </div>
            <div class="materi-image-col" style="max-width:280px;">
                <img src="<?php echo e(asset('images/materi/ukur-benar.png')); ?>"
                     class="img-fluid materi-img rounded-4 shadow"
                     style="max-height: 200px; background: #fffbe9; cursor: pointer;"
                     alt="Alat ukur diletakkan rapat dan dimulai dari ujung benda dengan benar."
                     data-bs-toggle="tooltip"
                     data-bs-placement="top"
                     title="Alat ukur diletakkan rapat dan dimulai dari ujung benda dengan benar." />
            </div>
            <div class="materi-image-col" style="max-width:280px;">
                <img src="<?php echo e(asset('images/materi/ukur-salah-2.png')); ?>"
                     class="img-fluid materi-img rounded-4 shadow"
                     style="max-height: 200px; background: #fffbe9; cursor: pointer;"
                     alt="Alat ukur diletakkan dalam posisi miring, tidak lurus."
                     data-bs-toggle="tooltip"
                     data-bs-placement="top"
                     title="Alat ukur diletakkan dalam posisi miring, tidak lurus." />
            </div>
            <div class="materi-image-col" style="max-width:280px;">
                <img src="<?php echo e(asset('images/materi/ukur-salah-3.png')); ?>"
                     class="img-fluid materi-img rounded-4 shadow"
                     style="max-height: 200px; background: #fffbe9; cursor: pointer;"
                     alt="Alat ukur bertumpuk, tidak diletakkan secara sejajar."
                     data-bs-toggle="tooltip"
                     data-bs-placement="top"
                     title="Alat ukur bertumpuk, tidak diletakkan secara sejajar." />
            </div>
        </div>
    </div>

    <!-- Box Tahukah Kalian: Fokus Papuyu -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #fffde7; border-left: 5px solid #ffb300; padding: 16px 18px; border-radius: 10px; font-size: 1.06em; color: #775b08; margin-bottom: 18px; box-shadow: 0 2px 8px #ffb30018;">
            <strong style="font-size:1.1em;">Tahukah Kalian?</strong>
            <br>
            Papuyu adalah ikan yang biasa ditemukan di rawa-rawa dan sangat disukai oleh masyarakat Kalimantan Selatan, khususnya orang Banjar. Tubuh papuyu pipih dan gepeng, dengan warna sisik punggung hitam serta perut abu-abu kehijauan. Daging ikan ini dikenal enak, tetapi harus berhati-hati karena tulangnya tajam.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-1" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-1" src="<?php echo e(asset('sounds/materi/hal13/narasi-1.mp3')); ?>"></audio>
        </div>
    </div>

    <div class="materi-nav-footer mt-3">
        <a href="<?php echo e(route('admin.materi.halaman12')); ?>" class="btn btn-nav fs-5">← Sebelumnya</a>
        <a href="<?php echo e(route('admin.materi.halaman14')); ?>" class="btn btn-nav btn-next fs-5">Selanjutnya →</a>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    let currentAudio = null;
    let currentButton = null;

    function toggleAudio(button) {
        const id = button.getAttribute('data-id');
        const audio = document.getElementById(`audio-${id}`);

        // Pause semua audio lain
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) {
                a.pause();
                a.currentTime = 0;
            }
        });

        // Reset semua tombol ke 🔊
        document.querySelectorAll('button[data-id]').forEach(btn => {
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
            currentAudio = audio;
            currentButton = button;
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

    // Tooltip bootstrap
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman13.blade.php ENDPATH**/ ?>