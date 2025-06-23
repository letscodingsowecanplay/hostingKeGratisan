

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
            2 => ['a' => ['top'=>'60%','left'=>'38%'], 'b'=>['top'=>'66%','left'=>'67%']],
            3 => ['a' => ['top'=>'65%','left'=>'37%'], 'b'=>['top'=>'60%','left'=>'69%']],
            4 => ['a' => ['top'=>'66%','left'=>'29%'], 'b'=>['top'=>'62%','left'=>'74%']],
        ];
        $ukuranPilihan = [
            1 => ['a'=>['w'=>170,'h'=>170], 'b'=>['w'=>170,'h'=>170]],
            2 => ['a'=>['w'=>180,'h'=>180], 'b'=>['w'=>150,'h'=>150]],
            3 => ['a'=>['w'=>155,'h'=>155], 'b'=>['w'=>170,'h'=>170]],
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
                'a' => 'Jawaban kamu benar. Badik Ashu A memang lebih panjang di antara pilihan.',
                'b' => 'Jawaban kamu salah. Badik Ashu A lebih panjang daripada B.'
            ],
            2 => [
                'a' => 'Jawaban kamu benar. Guci A adalah yang lebih tinggi dibandingkan yang lain.',
                'b' => 'Jawaban kamu salah. Guci B tidak lebih tinggi dari A.'
            ],
            3 => [
                'a' => 'Jawaban kamu benar. Dayung kelotok A yang lebih panjang.',
                'b' => 'Jawaban kamu salah. Dayung kelotok B lebih pendek daripada A.'
            ],
            4 => [
                'a' => 'Jawaban kamu benar. Mandau A tergantung di posisi lebih rendah.',
                'b' => 'Jawaban kamu salah. Mandau B posisinya tidak lebih rendah dari A.'
            ],
        ];
        $audioPenjelasan = [
            1 => asset('sounds/materi/hal9/penjelasan_1.mp3'),
            2 => asset('sounds/materi/hal9/penjelasan_2.mp3'),
            3 => asset('sounds/materi/hal9/penjelasan_3.mp3'),
            4 => asset('sounds/materi/hal9/penjelasan_4.mp3'),
        ];
    ?>

    
    <div class="materi-section mb-5">
        <div class="d-flex align-items-center mb-2">
            <span class="warna-label yellow-card" style="margin-right:10px;">Contoh Soal</span>
            <button onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal9/1.mp3')); ?>"></audio>
        </div>
        <p>
            Amati gambar berikut dengan saksama! Jawablah pertanyaan di bawah ini dengan menyeret dan meletakkan pilihan jawaban yang sesuai.
        </p>
        <p>
            Kain Sasirangan yang memiliki bentuk lebih pendek adalah ....
            <button onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    data-id="index-2" data-playing="false">🔊</button>
            <audio id="audio-index-2" src="<?php echo e(asset('sounds/materi/hal9/2.mp3')); ?>"></audio>
        </p>
        <div class="position-relative mx-auto mb-2" style="max-width: 420px; height: 235px;">
            <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/contoh_bg.png')); ?>" class="w-100 h-100 rounded shadow" style="object-fit:cover;">
            <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/contoh_a.png')); ?>" style="position:absolute;top:63%;left:32%;width:170px;height:170px;transform:translate(-50%,-50%);" class="rounded shadow">
            <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/contoh_b.png')); ?>" style="position:absolute;top:67%;left:73%;width:170px;height:170px;transform:translate(-50%,-50%);" class="rounded shadow">
        </div>
        <div class="drop-area-style text-center mb-4">
            <p class="text-muted mb-1">Jawaban yang benar:</p>
            <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/contoh_a.png')); ?>" class="drop-gambar-fit rounded shadow">
        </div>
        <p>
            Penyelesaian: <br> Ketika dibandingkan dengan saksama antara kain Sasirangan A dan B, terlihat bahwa kain Sasirangan A memiliki bentuk yang lebih pendek dibandingkan dengan kain Sasirangan B. Oleh karena itu, jawabannya adalah A.
        </p>
    </div>
    <hr>

    <div class="materi-section">
        <div class="d-flex align-items-center mb-3 fs-5">
            <span class="warna-label green-card">Ayo Mencoba</span>
            <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-3" data-playing="false">🔊</button>
            <audio id="audio-index-3" src="<?php echo e(asset('sounds/materi/hal4/3.mp3')); ?>"></audio>
        </div>
        <p class="fs-5">Amati gambar berikut dengan saksama! Jawablah pertanyaan di bawah ini dengan menyeret dan meletakkan pilihan jawaban yang sesuai.</p>
    </div>

    
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
                <span class="warna-label green-card me-2">Soal <?php echo e($no); ?></span>
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
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['bg'])); ?>" class="w-100 h-100 rounded shadow" style="object-fit:cover;">
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['a'])); ?>"
                     id="option-<?php echo e($no); ?>-a"
                     data-no="<?php echo e($no); ?>"
                     data-val="a"
                     draggable="true"
                     class="rounded shadow drag-opt"
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
                     class="rounded shadow drag-opt"
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
            </div>
            <div id="penjelasan-<?php echo e($no); ?>"></div>
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
            <div class="materi-section mb-5 fs-5 review-step" id="review-step-<?php echo e($no); ?>" style="<?php if($no>1): ?>display:none;<?php endif; ?>">
                <div class="d-flex align-items-center mb-2">
                    <span class="warna-label green-card me-2">Soal <?php echo e($no); ?></span>
                    <strong class="flex-grow-1"><?php echo e($soalList[$no]); ?></strong>
                </div>
                <div class="position-relative mx-auto mb-2" style="max-width: 440px; height: 240px;">
                    <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['bg'])); ?>" class="w-100 h-100 rounded shadow" style="object-fit:cover;">
                    <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['a'])); ?>"
                         style="position:absolute;
                                top:<?php echo e($positions[$no]['a']['top']); ?>;
                                left:<?php echo e($positions[$no]['a']['left']); ?>;
                                width:<?php echo e($ukuranPilihan[$no]['a']['w']); ?>px;
                                height:<?php echo e($ukuranPilihan[$no]['a']['h']); ?>px;
                                transform:translate(-50%,-50%);
                                z-index:9;
                                opacity:<?php echo e(($jawabanUser['soal'.$no] ?? '')=='a' ? '1' : '.35'); ?>;">
                    <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no]['b'])); ?>"
                         style="position:absolute;
                                top:<?php echo e($positions[$no]['b']['top']); ?>;
                                left:<?php echo e($positions[$no]['b']['left']); ?>;
                                width:<?php echo e($ukuranPilihan[$no]['b']['w']); ?>px;
                                height:<?php echo e($ukuranPilihan[$no]['b']['h']); ?>px;
                                transform:translate(-50%,-50%);
                                z-index:9;
                                opacity:<?php echo e(($jawabanUser['soal'.$no] ?? '')=='b' ? '1' : '.35'); ?>;">
                </div>
                <div class="drop-area-style text-center mb-3">
                    <?php
                        $jawab = $jawabanUser['soal'.$no] ?? null;
                        $benar = $jawab === ($kunci['soal'.$no] ?? null);
                    ?>
                    <?php if($jawab): ?>
                        <img src="<?php echo e(asset('images/materi/ayo-mencoba-2/' . $gambarList[$no][$jawab])); ?>"
                             class="drop-gambar-fit rounded shadow"
                             alt="Jawaban Gambar">
                        <div class="block-option <?php echo e($benar ? 'bg-success' : 'bg-danger'); ?> text-white d-inline-block px-3 py-2 rounded mt-2" style="cursor: default;" draggable="false">
                            <?php echo e(strtoupper($jawab)); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-muted">Belum dijawab</div>
                    <?php endif; ?>
                </div>
                <div class="card card-body border-info bg-light mt-2">
                    <?php
                        $jawab = $jawabanUser['soal'.$no] ?? null;
                        $benar = $jawab === ($kunci['soal'.$no] ?? null);
                        $explain = $jawab ? ($penjelasan[$no][$jawab] ?? 'Belum ada penjelasan.') : 'Kamu belum memilih jawaban.';
                    ?>
                    <span><?php echo $explain; ?>

                    <button type="button" onclick="playPenjelasanAudio(<?php echo e($no); ?>, this)" class="btn btn-audio ms-2">🔊</button>
                    <audio id="audio-penjelasan-<?php echo e($no); ?>" src="<?php echo e($audioPenjelasan[$no] ?? ''); ?>"></audio></span>
                    <hr>
                    <span class="text-success"><strong>Kunci Jawaban:</strong> <?php echo e(strtoupper($kunci['soal'.$no] ?? '-')); ?></span>
                </div>
            </div>
            <?php endfor; ?>
            <div id="skor-kkm-area" style="margin-top:10px;">
                <?php if($skor < $kkm): ?>
                    <form action="<?php echo e(route('admin.materi.halaman9.reset')); ?>" method="POST" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger fs-5">Ulangi Latihan</button>
                    </form>
                <?php endif; ?>
                <div class="text-center flex-grow-1 fs-5">
                    <div id="skor-anda" class="alert alert-info d-inline-block mb-0">
                        Nilai Anda: <?php echo e($skor); ?> / 100
                    </div>
                </div>
                <div id="kkm-anda" class="alert alert-success mt-3 fs-5">
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
<br>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
const totalSoal = <?php echo e($totalSoal); ?>;
let currentStep = <?php echo e($firstUnanswered); ?>;
function showStep(no) {
    for (let i = 1; i <= totalSoal; i++) {
        document.getElementById('soal-step-' + i).style.display = (i === no ? '' : 'none');
    }
    currentStep = no;
}
document.addEventListener('DOMContentLoaded', function() {
    <?php if(count($jawabanUser) < $totalSoal): ?>
    for(let no=1; no<=totalSoal; no++) {
        let dropArea = document.getElementById('drop-area-' + no);
        let jawabanDrop = document.getElementById('jawabanDrop' + no);
        if (!dropArea) continue;
        ['a','b'].forEach(function(opt){
            let dragImg = document.getElementById(`option-${no}-${opt}`);
            if (!dragImg) return;
            dragImg.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('text/plain', this.id);
                e.dataTransfer.setData('soal-no', this.dataset.no);
                e.dataTransfer.setData('jawab-val', this.dataset.val);
            });
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
            // Hapus gambar sebelumnya di drop area
            dropArea.querySelectorAll('img').forEach(el => el.remove());
            let hint = dropArea.querySelector('p.text-muted');
            if(hint) hint.style.opacity = '0';
            // Tambahkan gambar fit di drop area
            let imgAns = dragged.cloneNode(true);
            imgAns.setAttribute('draggable', false);
            imgAns.className = 'drop-gambar-fit rounded shadow';
            imgAns.removeAttribute('style'); // Hapus semua inline style
            dropArea.appendChild(imgAns);
            // Pastikan fit dengan area (CSS handle ukuran, bukan inline)
            setTimeout(() => {
                dropArea.style.minHeight = Math.max(120, imgAns.offsetHeight + 40) + 'px';
                dropArea.style.padding = "18px 0";
                imgAns.style.opacity = '1';
                // Nilai otomatis setelah animasi
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
                        imgAns.style.boxShadow = '0 0 0 4px ' + (res.benar ? '#43ad4e':'#ee5151');
                        showFeedbackPopup(res.feedback, targetSoal);
                        setTimeout(() => {
                            let penjelasanArea = document.getElementById('penjelasan-' + targetSoal);
                            if (penjelasanArea) {
                                penjelasanArea.innerHTML =
                                    '<span class="badge warna-label ' + (res.benar ? 'green-card':'red-card') + ' mb-1">Jawaban ' + (res.benar ? 'Benar':'Salah') + '</span>' +
                                    '<div class="card card-body border-info bg-light mt-2">' + res.penjelasan +
                                    ' <button type="button" onclick="playPenjelasanAudio(' + targetSoal + ', this)" class="btn btn-audio ms-2">🔊</button>' +
                                    ' <audio id="audio-penjelasan-' + targetSoal + '" src="' + (res.audio_penjelasan ?? '') + '"></audio>' +
                                    '</div>' +
                                    '<div class="mt-1"><span class="badge warna-label green-card">Kunci Jawaban: ' + res.kunci.toUpperCase() + '</span></div>';
                            }
                            fetch('<?php echo e(route('admin.materi.halaman9')); ?>', {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                            .then(response => response.text())
                            .then(html => {
                                let match = html.match(/let currentStep = (\d+)/);
                                let nextUnanswered = match ? parseInt(match[1]) : 1;
                                let allAnswered = !!res.semua_sudah;
                                setTimeout(() => {
                                    if (allAnswered) {
                                        window.location.reload();
                                    } else {
                                        showStep(nextUnanswered);
                                    }
                                }, 900);
                            });
                        }, 1100);
                    });
                }, 350);
            }, 30);
        });
    }
    <?php endif; ?>
});

// FEEDBACK POPUP
function showFeedbackPopup(feedback, soalNo) {
    let popup = document.getElementById('popup-feedback');
    let popupImg = document.getElementById('popup-img');
    let isBenar = feedback.benar === true || feedback.judul.toLowerCase().includes('benar');
    popupImg.src = isBenar
        ? '<?php echo e(asset('images/feedback/benar.png')); ?>'
        : '<?php echo e(asset('images/feedback/salah.png')); ?>';
    document.getElementById('popup-judul').innerText = feedback.judul;
    document.getElementById('popup-text').innerText = feedback.text;
    document.getElementById('popup-kunci').innerHTML = `Kunci Jawaban: <b>${feedback.kunci.toUpperCase()}</b>`;
    let audio = document.getElementById('popup-audio');
    audio.src = feedback.audio; audio.currentTime = 0; audio.play();
    popup.style.display = 'flex';
    setTimeout(() => { popup.style.display = 'none'; audio.pause(); }, 1350);
    audio.onended = function () { popup.style.display = 'none'; };
}

// AUDIO penjelasan soal
function playPenjelasanAudio(no, btn){
    const audio = document.getElementById('audio-penjelasan-' + no);
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

// Navigasi review
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