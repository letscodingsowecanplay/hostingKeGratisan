

<?php $__env->startSection('content'); ?>

<div class="materi-main-container fs-5">
    <h2 class="fw-bold text-center mb-3" style="font-size:2rem;">Pengukuran</h2>

    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label blue-card mb-3" style="font-size:1rem;">Alat Ukur Tidak Baku</div>
        <div class="materi-content mb-3 fw-semibold">
            Beberapa alat ukur tidak baku yang digunakan dalam kehidupan sehari-hari:
            <button onclick="toggleAudio(this)" 
                    class="btn-audio"
                    data-id="index-1" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal12/1.mp3')); ?>"></audio>
        </div>

        
        <div class="materi-image-row flex-wrap mb-3" style="gap:22px;">
            <?php
                $alat = [
                    [
                        'img' => 'jengkal.png', 'label' => 'jengkal', 'audio' => 2
                    ],
                    [
                        'img' => 'hasta.png', 'label' => 'hasta', 'audio' => 3
                    ],
                    [
                        'img' => 'depa.png', 'label' => 'depa', 'audio' => 4
                    ],
                    [
                        'img' => 'telapak-kaki.png', 'label' => 'telapak kaki', 'audio' => 5
                    ],
                    [
                        'img' => 'koin.png', 'label' => 'koin', 'audio' => 6
                    ],
                    [
                        'img' => 'sedotan.png', 'label' => 'sedotan', 'audio' => 7
                    ],
                    [
                        'img' => 'klip-kertas.png', 'label' => 'klip kertas', 'audio' => 8
                    ],
                    [
                        'img' => 'stik-eskrim.png', 'label' => 'stik eskrim', 'audio' => 9
                    ],
                ];
            ?>
            <?php $__currentLoopData = $alat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="materi-image-col" style="max-width:180px">
                    <img src="<?php echo e(asset('images/materi/' . $a['img'])); ?>" 
                        class="img-fluid shadow mb-2"
                        style="max-height: 100px; background: #fffbe9;"
                        alt="<?php echo e(ucfirst($a['label'])); ?>">
                    <div class="materi-caption fw-semibold" style="margin-bottom: 0;">
                        <?php echo e($a['label']); ?>

                        <button onclick="toggleAudio(this)" 
                                class="btn-audio"
                                data-id="index-<?php echo e($a['audio']); ?>" data-playing="false" type="button" style="padding:2px 11px;">🔊</button>
                        <audio id="audio-index-<?php echo e($a['audio']); ?>" src="<?php echo e(asset('sounds/materi/hal12/'.$a['audio'].'.mp3')); ?>"></audio>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label green-card mb-3" style="font-size:1rem;">Catatan & Penjelasan</div>
        <div class="materi-content mb-3">
            <strong>Kalian bisa menggunakan benda lain di sekitar.</strong>
            <button onclick="toggleAudio(this)" 
                class="btn-audio"
                data-id="index-10" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-10" src="<?php echo e(asset('sounds/materi/hal12/10.mp3')); ?>"></audio>
        </div>
        <div class="materi-content mb-2"><strong>Penjelasan:</strong></div>
        <ul class="materi-list">
            <li>Jengkal adalah menggunakan jari tangan.</li>
            <li>Hasta adalah jarak antara ujung jari tengah ke siku tangan.</li>
            <li>Depa adalah merentangkan kedua tangan.</li>
            <li>Telapak kaki adalah jumlah langkah kaki.</li>
        </ul>
    </div>

    <div class="materi-nav-footer mt-3">
        <a href="<?php echo e(route('admin.materi.halaman11')); ?>" class="btn btn-nav fs-5">← Sebelumnya</a>
        <a href="<?php echo e(route('admin.materi.halaman13')); ?>" class="btn btn-nav btn-next fs-5">Selanjutnya →</a>
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
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman12.blade.php ENDPATH**/ ?>