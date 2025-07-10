

<?php $__env->startSection('content'); ?>
<div class="materi-main-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Ayo Mencoba
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div id="popup-feedback" style="display:none; position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:1000; background:rgba(40,75,99,.13); align-items:center;justify-content:center;">
        <div style="background:#fff; border-radius:16px; box-shadow:0 7px 38px #2223; padding:32px 38px; max-width:400px; width:98vw; text-align:center; position:relative;">
            <img id="popup-img" src="" style="max-width:130px; max-height:130px; margin-bottom:15px; border-radius:15px; box-shadow:0 3px 15px #0002;">
            <h4 id="popup-judul" style="font-weight:700;"></h4>
            <p id="popup-text" style="font-size:1.1rem;margin-bottom:2px;"></p>
            <div style="margin:7px auto 0 auto; font-size:1.13rem;" id="popup-kunci"></div>
        </div>
        <audio id="popup-audio" src=""></audio>
    </div>

    <?php
        $positions = [
            1 => ['a' => ['top'=>'62%','left'=>'31%'], 'b'=>['top'=>'66%','left'=>'73%']],
            2 => ['a' => ['top'=>'60%','left'=>'25%'], 'b'=>['top'=>'66%','left'=>'75%']],
            3 => ['a' => ['top'=>'50%','left'=>'25%'], 'b' => ['top'=>'60%','left'=>'75%']],
            4 => ['a' => ['top'=>'66%','left'=>'29%'], 'b'=>['top'=>'30%','left'=>'74%']],
        ];
        $ukuranPilihan = [
            1 => ['a'=>['w'=>170,'h'=>170], 'b'=>['w'=>170,'h'=>170]],
            2 => ['a'=>['w'=>180,'h'=>180], 'b'=>['w'=>150,'h'=>150]],
            3 => ['a'=>['w'=>200,'h'=>200], 'b'=>['w'=>170,'h'=>170]],
            4 => ['a'=>['w'=>160,'h'=>160], 'b'=>['w'=>140,'h'=>140]],
        ];
        $soalList = [
            1 => 'Badik Ashu yang memiliki bentuk lebih panjang adalah ...',
            2 => 'Guci peninggalan zaman dahulu di Kalimantan yang memiliki bentuk lebih tinggi adalah ...',
            3 => 'Dayung kelotok yang memiliki bentuk lebih panjang adalah ...',
            4 => 'Mandau Kalimantan yang tergantung pada posisi lebih rendah adalah ...'
        ];
        $gambarList = [
            1 => ['bg' => 'soal1_bg.png', 'a' => 'soal1_a.png', 'b' => 'soal1_b.png'],
            2 => ['bg' => 'soal2_bg.png', 'a' => 'soal2_a.png', 'b' => 'soal2_b.png'],
            3 => ['bg' => 'soal3_bg.png', 'a' => 'soal3_a.png', 'b' => 'soal3_b.png'],
            4 => ['bg' => 'soal4_bg.png', 'a' => 'soal4_a.png', 'b' => 'soal4_b.png'],
        ];
        $kunci = $kunciJawaban ?? [];
        $totalSoal = 4;
        $firstUnanswered = 1;
        for($i=1;$i<=$totalSoal;$i++){ if(empty($jawabanUser['soal'.$i])) { $firstUnanswered = $i; break; } }
        $penjelasan = [
            1 => [
                'a' => 'Jawaban kamu salah. Badik Ashu b lebih panjang daripada a.',
                'b' => 'Jawaban kamu benar. Badik Ashu b memang lebih panjang di antara pilihan.'
            ],
            2 => [
                'a' => 'Jawaban kamu benar. Guci a adalah yang lebih tinggi dibandingkan yang lain.',
                'b' => 'Jawaban kamu salah. Guci b tidak lebih tinggi dari A.'
            ],
            3 => [
                'a' => 'Jawaban kamu benar. Dayung kelotok a yang lebih panjang.',
                'b' => 'Jawaban kamu salah. Dayung kelotok b lebih pendek daripada A.'
            ],
            4 => [
                'a' => 'Jawaban kamu benar. Mandau a tergantung di posisi lebih rendah.',
                'b' => 'Jawaban kamu salah. Mandau b posisinya tidak lebih rendah dari A.'
            ],
        ];
    ?>

    <div class="materi-section mb-5">
        <div class="materi-content">
            <div class="d-flex align-items-center mb-2">
                <span class="warna-label yellow-card" style="margin-right:10px;">Contoh Soal</span>
                <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-1" data-playing="false">🔊</button>
                <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal9/1.mp3')); ?>"></audio>
            </div>
            <p>
                Amati gambar berikut dengan saksama! Jawablah pertanyaan di bawah ini dengan menyeret dan meletakkan pilihan jawaban yang sesuai.
            </p>
            <p>
                Kain Sasirangan yang memiliki bentuk lebih pendek adalah ....
                <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-2" data-playing="false">🔊</button>
                <audio id="audio-index-2" src="<?php echo e(asset('sounds/materi/hal9/2.mp3')); ?>"></audio>
            </p>
            <div class="position-relative mx-auto mb-2" style="max-width: 420px; height: 235px;">
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/contoh_bg.png')); ?>" class="w-100 h-100 rounded shadow soal9-img-bg" style="object-fit:cover;">
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/contoh_a.png')); ?>" class="rounded shadow soal9-img-pilihan" style="position:absolute;top:63%;left:32%;width:170px;height:170px;transform:translate(-50%,-50%);">
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/contoh_b.png')); ?>" class="rounded shadow soal9-img-pilihan" style="position:absolute;top:67%;left:73%;width:170px;height:170px;transform:translate(-50%,-50%);">
            </div>
            <div class="drop-area-style text-center mb-4">
                <p class="text-muted mb-1">Jawaban yang benar:</p>
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/contoh_a.png')); ?>" class="drop-gambar-fit rounded shadow">
            </div>
            <p>
                Penyelesaian: <br> Ketika dibandingkan dengan saksama antara kain Sasirangan A dan B, terlihat bahwa kain Sasirangan A memiliki bentuk yang lebih pendek dibandingkan dengan kain Sasirangan B. Oleh karena itu, jawabannya adalah A.
            </p>
        </div>
    </div>
    <hr>

    <div class="materi-section">
        <div class="materi-content">
            <div class="d-flex align-items-center mb-3 ">
                <span class="warna-label green-card">Ayo Mencoba</span>
                <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-3" data-playing="false">🔊</button>
                <audio id="audio-index-3" src="<?php echo e(asset('sounds/materi/hal4/3.mp3')); ?>"></audio>
            </div>
            <p class="">Amati gambar berikut dengan saksama! Jawablah pertanyaan di bawah ini dengan menyeret dan meletakkan pilihan jawaban yang sesuai.</p>

            <?php if(count($jawabanUser) < $totalSoal): ?>
            <div class="d-flex justify-content-center gap-2 mb-3" id="stepper-bar">
                <?php for($no = 1; $no <= $totalSoal; $no++): ?>
                    <button type="button"
                        class="btn btn-outline-primary px-3 py-1 stepper-btn <?php if($no === $firstUnanswered): ?> btn-primary <?php endif; ?>"
                        onclick="showStep(<?php echo e($no); ?>)"
                        id="btn-stepper-<?php echo e($no); ?>">
                        Soal <?php echo e($no); ?>

                    </button>
                <?php endfor; ?>
            </div>
            <?php endif; ?>

            <div id="stepper-soal" <?php if(count($jawabanUser) === $totalSoal): ?> style="display:none" <?php endif; ?>>
                <?php for($no = 1; $no <= $totalSoal; $no++): ?>
                <div class="materi-section mb-5 soal-step" id="soal-step-<?php echo e($no); ?>" style="<?php if($no !== $firstUnanswered): ?>display:none;<?php endif; ?>">
                    <div class="d-flex align-items-center mb-2">
                        <span class="warna-label green-card me-2"><?php echo e($no); ?></span>
                        <strong class="flex-grow-1"><?php echo e($soalList[$no]); ?></strong>
                        <button
                            type="button"
                            onclick="toggleAudio(this)"
                            class="btn-audio ms-2"
                            title="Dengarkan"
                            data-id="hal9-<?php echo e($no); ?>"
                            data-playing="false">
                            🔊
                        </button>
                        <audio id="audio-hal9-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal9/hal9-' . $no . '.mp3')); ?>"></audio>
                    </div>
                    <div class="position-relative mx-auto mb-2" style="max-width: 440px; height: 240px;">
                        <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['bg'])); ?>" class="w-100 h-100 rounded shadow soal9-img-bg" style="object-fit:cover;">
                        <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['a'])); ?>"
                            id="option-<?php echo e($no); ?>-a"
                            data-no="<?php echo e($no); ?>"
                            data-val="a"
                            draggable="true"
                            class="rounded shadow drag-opt soal9-img-pilihan"
                            style="position:absolute;
                                top:<?php echo e($positions[$no]['a']['top']); ?>;
                                left:<?php echo e($positions[$no]['a']['left']); ?>;
                                width:<?php echo e($ukuranPilihan[$no]['a']['w']); ?>px;
                                height:<?php echo e($ukuranPilihan[$no]['a']['h']); ?>px;
                                transform:translate(-50%,-50%);
                                cursor:grab;z-index:9;">
                        <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['b'])); ?>"
                            id="option-<?php echo e($no); ?>-b"
                            data-no="<?php echo e($no); ?>"
                            data-val="b"
                            draggable="true"
                            class="rounded shadow drag-opt soal9-img-pilihan"
                            style="position:absolute;
                                top:<?php echo e($positions[$no]['b']['top']); ?>;
                                left:<?php echo e($positions[$no]['b']['left']); ?>;
                                width:<?php echo e($ukuranPilihan[$no]['b']['w']); ?>px;
                                height:<?php echo e($ukuranPilihan[$no]['b']['h']); ?>px;
                                transform:translate(-50%,-50%);
                                cursor:grab;z-index:9;">
                    </div>
                    <div class="drop-area-style text-center mb-4 d-flex flex-column align-items-center justify-content-center" id="drop-area-<?php echo e($no); ?>" data-no="<?php echo e($no); ?>">
                        <p class="text-muted mb-1" style="font-size:0.99rem;transition:opacity .22s;">Seret gambar jawaban ke sini</p>
                        <input type="hidden" name="jawaban[soal<?php echo e($no); ?>]" id="jawabanDrop<?php echo e($no); ?>" required>
                        <?php
                            $jawab = $jawabanUser['soal'.$no] ?? null;
                            $benar = $jawab === ($kunci['soal'.$no] ?? null);
                            $explain = $jawab ? ($penjelasan[$no][$jawab] ?? 'Belum ada penjelasan.') : 'Kamu belum memilih jawaban.';
                        ?>
                        <?php if($jawab): ?>
                        <div class="feedback-identik" style="width:100%;">
                            <span class="badge warna-label <?php echo e($benar ? 'green-card' : 'red-card'); ?> mb-2" style="font-size:1.18em;">
                                <?php echo $benar ? 'Jawaban Benar &#10003;' : 'Jawaban Salah &#10007;'; ?>

                            </span>
                            <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no][$jawab])); ?>"
                                class="drop-gambar-fit rounded shadow"
                                alt="Jawaban Gambar"
                                style="border: 4px solid <?php echo e($benar ? '#43ad4e' : '#ee5151'); ?>;">
                            <div class="card card-body border-info bg-light mt-2 w-100">
                                <span><?php echo $explain; ?>

                                <button type="button" onclick="playPenjelasanAudio(<?php echo e($no); ?>, this)" class="btn btn-audio ms-2">🔊</button>
                                <audio id="audio-penjelasan-<?php echo e($no); ?>" src=""></audio></span>
                                <hr>
                                <span class="badge warna-label yellow-card" style="font-size:1.09em;">
                                    <strong>Kunci Jawaban:</strong> <?php echo e(strtoupper($kunci['soal'.$no] ?? '-')); ?>

                                </span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endfor; ?>
                <div class="materi-nav-footer d-flex justify-content-between" style="margin-top:24px;">
                    <a href="<?php echo e(route('admin.materi.halaman8')); ?>" class="btn-nav" style="min-width:160px" id="btn-prev">← Sebelumnya</a>
                    <?php if($skor >= $kkm ?? false): ?>
                        <a href="<?php echo e(route('admin.materi.halaman10')); ?>" class="btn-nav btn-next" style="min-width:160px" id="btn-next">Selanjutnya →</a>
                    <?php else: ?>
                        <button class="btn-nav btn-next" style="min-width:160px; opacity:0.6; pointer-events:none;" id="btn-next">Selanjutnya →</button>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(count($jawabanUser) === $totalSoal): ?>
                <div id="review-area">
                    <div class="text-center mb-3">
                        <h4 class="fw-bold">Review Jawabanmu</h4>
                    </div>
                    <div class="mb-3 d-flex justify-content-center gap-2">
                        <?php for($no = 1; $no <= $totalSoal; $no++): ?>
                        <button type="button" class="btn btn-outline-primary px-3 py-1" onclick="showReviewSoal(<?php echo e($no); ?>)" id="btn-review-<?php echo e($no); ?>">
                            Soal <?php echo e($no); ?>

                        </button>
                        <?php endfor; ?>
                    </div>
                    <?php for($no = 1; $no <= $totalSoal; $no++): ?>
                    <div class="materi-section mb-5  review-step" id="review-step-<?php echo e($no); ?>" style="<?php if($no>1): ?>display:none;<?php endif; ?>">
                        <div class="d-flex align-items-center mb-2">
                            <span class="warna-label green-card me-2"><?php echo e($no); ?></span>
                            <strong class="flex-grow-1"><?php echo e($soalList[$no]); ?></strong>
                            <button
                                type="button"
                                onclick="toggleAudio(this)"
                                class="btn-audio ms-2"
                                title="Dengarkan"
                                data-id="hal9-<?php echo e($no); ?>"
                                data-playing="false">
                                🔊
                            </button>
                            <audio id="audio-hal9-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal9/hal9-' . $no . '.mp3')); ?>"></audio>
                        </div>
                        <div class="position-relative mx-auto mb-2" style="max-width: 440px; height: 240px;">
                            <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['bg'])); ?>" class="w-100 h-100 rounded shadow soal9-img-bg" style="object-fit:cover;">
                            <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['a'])); ?>"
                                style="position:absolute;
                                        top:<?php echo e($positions[$no]['a']['top']); ?>;
                                        left:<?php echo e($positions[$no]['a']['left']); ?>;
                                        width:<?php echo e($ukuranPilihan[$no]['a']['w']); ?>px;
                                        height:<?php echo e($ukuranPilihan[$no]['a']['h']); ?>px;
                                        transform:translate(-50%,-50%);
                                        z-index:9;
                                        opacity:<?php echo e(($jawabanUser['soal'.$no] ?? '')=='a' ? '1' : '.35'); ?>;"
                                class="soal9-img-pilihan">
                            <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['b'])); ?>"
                                style="position:absolute;
                                        top:<?php echo e($positions[$no]['b']['top']); ?>;
                                        left:<?php echo e($positions[$no]['b']['left']); ?>;
                                        width:<?php echo e($ukuranPilihan[$no]['b']['w']); ?>px;
                                        height:<?php echo e($ukuranPilihan[$no]['b']['h']); ?>px;
                                        transform:translate(-50%,-50%);
                                        z-index:9;
                                        opacity:<?php echo e(($jawabanUser['soal'.$no] ?? '')=='b' ? '1' : '.35'); ?>;"
                                class="soal9-img-pilihan">
                        </div>
                        <div class="drop-area-style text-center mb-3 feedback-identik" style="width:100%;">
                            <?php
                                $jawab = $jawabanUser['soal'.$no] ?? null;
                                $benar = $jawab === ($kunci['soal'.$no] ?? null);
                                $explain = $jawab ? ($penjelasan[$no][$jawab] ?? 'Belum ada penjelasan.') : 'Kamu belum memilih jawaban.';
                            ?>
                            <?php if($jawab): ?>
                                <span class="badge warna-label <?php echo e($benar ? 'green-card' : 'red-card'); ?> mb-2" style="font-size:1.18em;">
                                    <?php echo $benar ? 'Jawaban Benar &#10003;' : 'Jawaban Salah &#10007;'; ?>

                                </span>
                                <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no][$jawab])); ?>"
                                    class="drop-gambar-fit rounded shadow"
                                    alt="Jawaban Gambar"
                                    style="border: 4px solid <?php echo e($benar ? '#43ad4e' : '#ee5151'); ?>;">
                                <div class="card card-body border-info bg-light mt-2 w-100">
                                    <span><?php echo $explain; ?>

                                    <button type="button" onclick="playPenjelasanAudio(<?php echo e($no); ?>, this)" class="btn btn-audio ms-2">🔊</button>
                                    <audio id="audio-penjelasan-<?php echo e($no); ?>" src=""></audio></span>
                                    <hr>
                                    <span class="badge warna-label yellow-card" style="font-size:1.09em;">
                                        <strong>Kunci Jawaban:</strong> <?php echo e(strtoupper($kunci['soal'.$no] ?? '-')); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endfor; ?>
                    <div id="skor-kkm-area" style="margin-top:10px;">
                        <?php if($skor < $kkm): ?>
                            <form action="<?php echo e(route('admin.materi.halaman9.reset')); ?>" method="POST" class="mt-3">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger ">Ulangi Latihan</button>
                            </form><br>
                        <?php endif; ?>
                        <div class="text-center flex-grow-1 ">
                            <div id="skor-anda" class="alert alert-info d-inline-block mb-0">
                                Nilai Anda: <?php echo e($skor); ?> / 100
                            </div>
                        </div>
                        <div id="kkm-anda" class="alert alert-success mt-3 ">
                            <?php if($skor >= $kkm): ?>
                                Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
                            <?php else: ?>
                                Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="materi-nav-footer d-flex justify-content-between" style="margin-top:32px;">
                        <a href="<?php echo e(route('admin.materi.halaman8')); ?>" class="btn-nav" style="min-width:160px">← Sebelumnya</a>
                        <?php if($skor >= $kkm): ?>
                            <a href="<?php echo e(route('admin.materi.halaman10')); ?>" class="btn-nav btn-next" style="min-width:160px">Selanjutnya →</a>
                        <?php else: ?>
                            <button class="btn-nav btn-next" style="opacity:0.6; pointer-events:none; min-width:160px;">Selanjutnya →</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
const gambarList = <?php echo json_encode($gambarList); ?>;

function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById('audio-' + id);
    document.querySelectorAll('audio').forEach(a => {
        if (a !== audio && a.id !== 'bg-music') {
            a.pause();
            a.currentTime = 0;
        }
    });
    document.querySelectorAll('.btn-audio').forEach(btn => {
        if (btn !== button) {
            btn.innerText = '🔊';
            btn.setAttribute('data-playing', 'false');
        }
    });
    if (audio.paused) {
        audio.play();
        button.innerText = '⏸️';
        button.setAttribute('data-playing', 'true');
    } else {
        audio.pause();
        button.innerText = '🔊';
        button.setAttribute('data-playing', 'false');
    }
    audio.onended = function () {
        button.innerText = '🔊';
        button.setAttribute('data-playing', 'false');
    };
}
const totalSoal = <?php echo e($totalSoal); ?>;
let currentStep = <?php echo e($firstUnanswered); ?>;
function showStep(no) {
    for (let i = 1; i <= totalSoal; i++) {
        document.getElementById('soal-step-' + i).style.display = (i === no ? '' : 'none');
        let btn = document.getElementById('btn-stepper-' + i);
        if(btn) btn.classList.toggle('btn-primary', i === no);
    }
    currentStep = no;
}

document.addEventListener('DOMContentLoaded', function() {
    <?php if(count($jawabanUser) < $totalSoal): ?>
    let isTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);

    for(let no=1; no<=totalSoal; no++) {
        let dropArea = document.getElementById('drop-area-' + no);
        let jawabanDrop = document.getElementById('jawabanDrop' + no);
        if (!dropArea) continue;
        ['a','b'].forEach(function(opt){
            let dragImg = document.getElementById(`option-${no}-${opt}`);
            if (!dragImg) return;

            // DESKTOP DRAG & DROP
            dragImg.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('text/plain', this.id);
                e.dataTransfer.setData('soal-no', this.dataset.no);
                e.dataTransfer.setData('jawab-val', this.dataset.val);
            });

            // MOBILE TOUCH DRAG & DROP
            if(isTouch) {
                let ghost = null;
                dragImg.addEventListener('touchstart', function(e){
                    e.preventDefault();
                    let startX = e.touches[0].clientX;
                    let startY = e.touches[0].clientY;
                    ghost = dragImg.cloneNode(true);
                    ghost.style.position = 'fixed';
                    ghost.style.pointerEvents = 'none';
                    ghost.style.zIndex = 10001;
                    ghost.style.left = (startX-30)+'px';
                    ghost.style.top = (startY-30)+'px';
                    ghost.style.width = dragImg.offsetWidth + 'px';
                    ghost.style.opacity = 0.7;
                    ghost.removeAttribute('id');
                    document.body.appendChild(ghost);

                    const moveHandler = function(ev){
                        let moveX = ev.touches[0].clientX;
                        let moveY = ev.touches[0].clientY;
                        ghost.style.left = (moveX-30)+'px';
                        ghost.style.top = (moveY-30)+'px';
                    };
                    const endHandler = function(ev){
                        if(ghost){
                            let touch = ev.changedTouches[0];
                            let rect = dropArea.getBoundingClientRect();
                            if(
                                touch.clientX >= rect.left && touch.clientX <= rect.right &&
                                touch.clientY >= rect.top && touch.clientY <= rect.bottom
                            ){
                                // Jalankan logika drop manual
                                if (jawabanDrop.value) return;
                                dropArea.querySelectorAll('img.drop-gambar-fit').forEach(el => el.remove());
                                dropArea.querySelectorAll('.feedback-identik').forEach(el => el.remove());
                                let hint = dropArea.querySelector('p.text-muted');
                                if(hint) hint.style.opacity = '0.3';
                                let imgAns = dragImg.cloneNode(true);
                                imgAns.setAttribute('draggable', false);
                                imgAns.className = 'drop-gambar-fit rounded shadow';
                                imgAns.removeAttribute('style');
                                let feedback = document.createElement('div');
                                feedback.className = "feedback-identik";
                                feedback.style.width = "100%";
                                feedback.innerHTML = `<span class="badge warna-label mb-2" id="badge-feedback-${no}" style="font-size:1.18em;"></span>`;
                                dropArea.appendChild(feedback);
                                dropArea.appendChild(imgAns);
                                setTimeout(() => {
                                    dropArea.style.minHeight = Math.max(120, imgAns.offsetHeight + 40) + 'px';
                                    dropArea.style.padding = "18px 0";
                                    imgAns.style.opacity = '1';
                                    setTimeout(() => {
                                        jawabanDrop.value = opt;
                                        fetch("<?php echo e(route('admin.materi.halaman9.jawab')); ?>", {
                                            method: 'POST',
                                            headers: {'Content-Type':'application/json','X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
                                            body: JSON.stringify({ no: no, jawaban: opt })
                                        })
                                        .then(res => res.json())
                                        .then(res => {
                                            if (!res.success) {
                                                alert(res.msg ?? 'Terjadi kesalahan!');
                                                return;
                                            }
                                            let badge = document.getElementById('badge-feedback-' + no);
                                            if(badge){
                                                badge.classList.remove('green-card','red-card');
                                                badge.classList.add(res.benar ? 'green-card':'red-card');
                                                badge.innerHTML = res.benar ? 'Jawaban Benar &#10003;' : 'Jawaban Salah &#10007;';
                                            }
                                            let card = document.createElement('div');
                                            card.className = "card card-body border-info bg-light mt-2 w-100";
                                            card.innerHTML = `
                                                <span>${res.penjelasan}
                                                <button type="button" onclick="playPenjelasanAudio(${no}, this)" class="btn btn-audio ms-2">🔊</button>
                                                <audio id="audio-penjelasan-${no}" src=""></audio></span>
                                                <hr>
                                                <span class="badge warna-label yellow-card" style="font-size:1.09em;">
                                                    <strong>Kunci Jawaban:</strong> ${res.kunci.toUpperCase()}
                                                </span>
                                            `;
                                            dropArea.appendChild(card);

                                            showFeedbackPopupAutoAudio(res, no, function(){
                                                fetch('<?php echo e(route('admin.materi.halaman9')); ?>', {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                                                .then(response => response.text())
                                                .then(html => {
                                                    let match = html.match(/let currentStep = (\d+)/);
                                                    let nextUnanswered = match ? parseInt(match[1]) : 1;
                                                    let allAnswered = !!res.semua_sudah;
                                                    setTimeout(() => {
                                                        showStep(nextUnanswered);
                                                        if (allAnswered) {
                                                            window.location.reload();
                                                        }
                                                    }, 100);
                                                });
                                            });
                                        });
                                    }, 350);
                                }, 30);
                            }
                            document.body.removeChild(ghost);
                            ghost = null;
                        }
                        document.removeEventListener('touchmove', moveHandler);
                        document.removeEventListener('touchend', endHandler);
                    };
                    document.addEventListener('touchmove', moveHandler, {passive:false});
                    document.addEventListener('touchend', endHandler);
                });
            }
        });
        dropArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropArea.classList.add('highlight');
        });
        dropArea.addEventListener('dragleave', function(e) {
            dropArea.classList.remove('highlight');
        });
        dropArea.addEventListener('drop', function(e) {
            e.preventDefault();
            dropArea.classList.remove('highlight');
            const draggedId = e.dataTransfer.getData('text/plain');
            const draggedSoal = e.dataTransfer.getData('soal-no');
            const jawabanVal = e.dataTransfer.getData('jawab-val');
            const targetSoal = dropArea.dataset.no;
            if (draggedSoal !== targetSoal) return;
            if (jawabanDrop.value) return;
            const dragged = document.getElementById(draggedId);
            if (!dragged) return;
            dropArea.querySelectorAll('img.drop-gambar-fit').forEach(el => el.remove());
            dropArea.querySelectorAll('.feedback-identik').forEach(el => el.remove());
            let hint = dropArea.querySelector('p.text-muted');
            if(hint) hint.style.opacity = '0.3';
            let imgAns = dragged.cloneNode(true);
            imgAns.setAttribute('draggable', false);
            imgAns.className = 'drop-gambar-fit rounded shadow';
            imgAns.removeAttribute('style');
            let feedback = document.createElement('div');
            feedback.className = "feedback-identik";
            feedback.style.width = "100%";
            feedback.innerHTML = `<span class="badge warna-label mb-2" id="badge-feedback-${targetSoal}" style="font-size:1.18em;"></span>`;
            dropArea.appendChild(feedback);
            dropArea.appendChild(imgAns);
            setTimeout(() => {
                dropArea.style.minHeight = Math.max(120, imgAns.offsetHeight + 40) + 'px';
                dropArea.style.padding = "18px 0";
                imgAns.style.opacity = '1';
                setTimeout(() => {
                    jawabanDrop.value = jawabanVal;
                    fetch("<?php echo e(route('admin.materi.halaman9.jawab')); ?>", {
                        method: 'POST',
                        headers: {'Content-Type':'application/json','X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
                        body: JSON.stringify({ no: targetSoal, jawaban: jawabanVal })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (!res.success) {
                            alert(res.msg ?? 'Terjadi kesalahan!');
                            return;
                        }
                        let badge = document.getElementById('badge-feedback-' + targetSoal);
                        if(badge){
                            badge.classList.remove('green-card','red-card');
                            badge.classList.add(res.benar ? 'green-card':'red-card');
                            badge.innerHTML = res.benar ? 'Jawaban Benar &#10003;' : 'Jawaban Salah &#10007;';
                        }
                        let card = document.createElement('div');
                        card.className = "card card-body border-info bg-light mt-2 w-100";
                        card.innerHTML = `
                            <span>${res.penjelasan}
                            <button type="button" onclick="playPenjelasanAudio(${targetSoal}, this)" class="btn btn-audio ms-2">🔊</button>
                            <audio id="audio-penjelasan-${targetSoal}" src=""></audio></span>
                            <hr>
                            <span class="badge warna-label yellow-card" style="font-size:1.09em;">
                                <strong>Kunci Jawaban:</strong> ${res.kunci.toUpperCase()}
                            </span>
                        `;
                        dropArea.appendChild(card);

                        showFeedbackPopupAutoAudio(res, targetSoal, function(){
                            fetch('<?php echo e(route('admin.materi.halaman9')); ?>', {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                            .then(response => response.text())
                            .then(html => {
                                let match = html.match(/let currentStep = (\d+)/);
                                let nextUnanswered = match ? parseInt(match[1]) : 1;
                                let allAnswered = !!res.semua_sudah;
                                setTimeout(() => {
                                    showStep(nextUnanswered);
                                    if (allAnswered) {
                                        window.location.reload();
                                    }
                                }, 100);
                            });
                        });
                    });
                }, 350);
            }, 30);
        });
    }
    <?php endif; ?>
});

function showFeedbackPopupAutoAudio(res, soalNo, afterClose) {
    let popup = document.getElementById('popup-feedback');
    let popupImg = document.getElementById('popup-img');
    let benar = res.benar === true;
    popupImg.src = benar
        ? '<?php echo e(asset('images/materi/ayo-mencoba-2/benar.png')); ?>'
        : '<?php echo e(asset('images/materi/ayo-mencoba-2/salah.png')); ?>';
    document.getElementById('popup-judul').innerText = res.feedback.judul;
    document.getElementById('popup-text').innerText = res.feedback.text;
    document.getElementById('popup-kunci').innerHTML = `Kunci Jawaban: <b>${res.kunci.toUpperCase()}</b>`;
    let audio = document.getElementById('popup-audio');
    audio.src = benar
        ? `<?php echo e(asset('sounds/materi/hal9/benar')); ?>` + soalNo + `.mp3`
        : `<?php echo e(asset('sounds/materi/hal9/salah')); ?>` + soalNo + `.mp3`;
    audio.currentTime = 0;
    popup.style.display = 'flex';
    audio.play();
    audio.onended = function () {
        popup.style.display = 'none';
        if(typeof afterClose === 'function') afterClose();
    };
}

function playPenjelasanAudio(no, btn){
    let userAnswer = document.getElementById('jawabanDrop'+no)?.value || '';
    if (!userAnswer && window.jawabanUserReview && window.jawabanUserReview['soal'+no]) userAnswer = window.jawabanUserReview['soal'+no];
    const kunci = <?php echo json_encode($kunci); ?>['soal'+no] || '';
    const benar = userAnswer === kunci;
    const src = benar
        ? `<?php echo e(asset('sounds/materi/hal9/benar')); ?>` + no + `.mp3`
        : `<?php echo e(asset('sounds/materi/hal9/salah')); ?>` + no + `.mp3`;
    const audio = document.getElementById('audio-penjelasan-' + no);
    audio.src = src;
    document.querySelectorAll('audio[id^="audio-penjelasan-"]').forEach(a => {
        if(a !== audio){ a.pause(); a.currentTime = 0; }
    });
    if(audio.paused){
        audio.play();
        btn.innerText = "⏸️";
    }else{
        audio.pause();
        btn.innerText = "🔊";
    }
    audio.onended = function(){ btn.innerText = "🔊"; }
}
<?php if(count($jawabanUser) === $totalSoal): ?>
window.jawabanUserReview = <?php echo json_encode($jawabanUser); ?>;
<?php endif; ?>
function showReviewSoal(no){
    document.querySelectorAll('.review-step').forEach(function(el, i){
        el.style.display = (i+1)==no ? '' : 'none';
    });
    for(let i=1;i<=totalSoal;i++){
        let btn = document.getElementById('btn-review-'+i);
        if(btn) btn.classList.toggle('btn-primary', i===no);
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman9.blade.php ENDPATH**/ ?>