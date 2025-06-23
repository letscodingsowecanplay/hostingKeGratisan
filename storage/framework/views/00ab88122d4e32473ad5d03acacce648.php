

<?php $__env->startSection('content'); ?>

<!-- Petunjuk Audio di luar main container -->
<div style="max-width:820px; margin: 28px auto 0 auto;">
    <div class="petunjuk-audio shadow-sm"
        style="background:#fff; border-radius:18px; padding:18px 22px; display:flex; align-items:center; justify-content:space-between; margin-bottom:32px; box-shadow:0 2px 14px #b2b1af1a; border:1.5px solid #f1efeb;">
        <div style="font-size:1.08em;">
            <b>Petunjuk:</b> Kalau kamu ingin mendengar kalimatnya, tekan tombol 
            <span style="font-size:1.12em; vertical-align:middle;">🔊</span> 
            yang ada di sebelah tulisan. Nanti akan ada suara yang membacakan materi untukmu!
        </div>
        <button onclick="toggleAudio(this)" 
                class="btn-audio ms-3"
                data-id="index-0" data-playing="false"
                style="margin-left:24px;">
            🔊
        </button>
        <audio id="audio-index-0" src="<?php echo e(asset('sounds/materi/index/0.mp3')); ?>"></audio>
    </div>
</div>

<div class="materi-main-container fs-5">
    <h2 class="fw-bold text-center mb-3" style="font-size:2rem;">Pengukuran</h2>
    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label yellow-card mb-3" style="font-size:1rem;">Mengukur Panjang Benda</div>
        <button onclick="toggleAudio(this)" 
                class="btn-audio"
                data-id="index-1" data-playing="false" type="button">🔊</button>
        <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal11/1.mp3')); ?>"></audio>
        <div class="d-flex align-items-center mt-3 mb-2 gap-2">
            <h6 class="fw-bold mb-0 fs-5">Tujuan Pembelajaran</h6>
            <button onclick="toggleAudio(this)" 
                class="btn-audio"
                data-id="index-2" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-2" src="<?php echo e(asset('sounds/materi/hal11/2.mp3')); ?>"></audio>
        </div>
        <div class="materi-content mt-2">
            Setelah mempelajari materi ini, diharapkan peserta didik dapat:
            <ul class="materi-list">
                <li>Memperkirakan panjang benda dengan menggunakan satuan tidak baku;</li>
                <li>Mengukur panjang benda dengan memanfaatkan objek lain sebagai satuan tidak baku.</li>
            </ul>
        </div>
    </div>

    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label green-card mb-3" style="font-size:1rem;">Ayo Belajar
        </div>
        <button onclick="toggleAudio(this)" 
            class="btn-audio"
            data-id="index-3" data-playing="false" type="button">🔊</button>
        <audio id="audio-index-3" src="<?php echo e(asset('sounds/materi/hal11/3.mp3')); ?>"></audio>
        <div class="materi-content mt-2">
            Kita dapat membandingkan panjang suatu benda dengan dua cara, yaitu secara langsung dan tidak langsung.<br>
            Apa perbedaannya?
        </div>
        <div class="materi-content mt-2">
            Berdirilah sejajar dengan dua temanmu. Siapa yang paling tinggi dan siapa yang paling pendek?<br>
            Cara membandingkan seperti ini disebut membandingkan secara langsung, karena tidak memerlukan alat ukur.
        </div>
        <div class="materi-content mt-2">
            Lalu, bagaimana caranya membandingkan panjang kain sasirangan milikmu dengan panjang kain sasirangan milik temanmu yang lokasinya berjauhan?
        </div>
        <div class="materi-content mt-2">
            Tentunya, kamu harus mengukur panjang kain sasiranganmu, lalu mengukur panjang kain sasirangan temanmu. Setelah itu, hasil pengukuran dapat dibandingkan untuk mengetahui mana yang lebih panjang.
        </div>
        <div class="materi-content mt-2">
            Metode ini disebut membandingkan secara tidak langsung, karena memerlukan alat ukur.
        </div>
    </div>

    <div class="materi-nav-footer mt-3">
        <a href="<?php echo e(route('admin.materi.halaman10')); ?>" class="btn btn-nav fs-5">← Sebelumnya</a>
        <a href="<?php echo e(route('admin.materi.halaman12')); ?>" class="btn btn-nav btn-next fs-5">Selanjutnya →</a>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman11.blade.php ENDPATH**/ ?>