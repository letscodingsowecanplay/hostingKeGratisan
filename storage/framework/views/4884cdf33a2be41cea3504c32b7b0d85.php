

<?php $__env->startSection('content'); ?>
<div class="materi-main-container" id="halaman4-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Ayo Mencoba
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="materi-section mb-5 fs-5">
        <div class="d-flex align-items-center mb-3">
            <span class="warna-label yellow-card">Contoh Soal</span>
            <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal4/1.mp3')); ?>"></audio>
        </div>
        <p>Amati gambar berikut dengan saksama!</p>
        <p>
            <span class="warna-label blue-card">Pilih bungkus bubuk minuman dengan bentuk yang tinggi!</span>
            <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-2" data-playing="false">🔊</button>
            <audio id="audio-index-2" src="<?php echo e(asset('sounds/materi/hal4/2.mp3')); ?>"></audio>
        </p>
        <div class="position-relative mx-auto mb-3 contoh-gambar-h4" style="max-width: 600px; height: 300px;">
            <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/contoh-lat-1.png')); ?>" class="w-100 h-100 rounded shadow contoh-gambar-bg" style="object-fit: cover;">
            <div class="position-absolute contoh-gambar-kiri" style="top: 65%; left: 25%; transform: translate(-50%, -50%);">
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/contoh-lat-2.png')); ?>" width="180" height="180" class="shadow contoh-gambar-pilihan">
                <div class="text-center mt-1"><span class="badge warna-label yellow-card">...</span></div>
            </div>
            <div class="position-absolute contoh-gambar-kanan" style="top: 65%; left: 75%; transform: translate(-50%, -50%);">
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/contoh-lat-3.png')); ?>" width="180" height="180" class="shadow contoh-gambar-pilihan">
                <div class="text-center mt-1"><span class="badge warna-label green-card">✔</span></div>
            </div>
        </div>
        <div class="mt-3">
            <p>
                <span class="warna-label orange-card">Penyelesaian:</span><br>
                Ketika kita amati kedua bungkus bubuk minuman ini, <b>kopi pasak bumi</b> di sebelah kiri memiliki bentuk yang rendah, sedangkan <b>teh pasak bumi</b> di sebelah kanan memiliki bentuk yang tinggi. Oleh karena itu, kita memilih gambar <b>teh pasak bumi</b> sebagai bungkus bubuk minuman dengan bentuk yang tinggi.
            </p>
        </div>
    </div>
    <div style="border-top: 2px solid #eee; margin: 10px 0 12px 0;"></div>

    <div class="materi-section">
        <div class="d-flex align-items-center mb-3 fs-5">
            <span class="warna-label green-card">Ayo Mencoba</span>
            <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-3" data-playing="false">🔊</button>
            <audio id="audio-index-3" src="<?php echo e(asset('sounds/materi/hal4/3.mp3')); ?>"></audio>
        </div>
        <p class="fs-5">Amati gambar berikut dengan saksama! Jawablah dengan memilih gambar yang paling sesuai dengan perintah pada soal di bawah ini!</p>
    </div>

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
        $soalText = [
            1 => 'Pilih iwak dengan bentuknya yang panjang!',
            2 => 'Pilih olahan iwak wadi khas banjar dengan bentuknya yang pendek!',
            3 => 'Pilih tempat biji-bijian khas Kalimantan berdasarkan posisi gantungnya yang tinggi!',
            4 => 'Pilih jam dinding rotan oleh-oleh khas Kalimantan berdasarkan posisi gantungnya yang rendah!',
        ];
        $positions = [
            1 => ['a_top' => '60%', 'a_left' => '25%', 'b_top' => '60%', 'b_left' => '75%'],
            2 => ['a_top' => '65%', 'a_left' => '25%', 'b_top' => '65%', 'b_left' => '75%'],
            3 => ['a_top' => '55%', 'a_left' => '25%', 'b_top' => '35%', 'b_left' => '75%'],
            4 => ['a_top' => '55%', 'a_left' => '25%', 'b_top' => '35%', 'b_left' => '75%'],
        ];
        $penjelasanText = [
            1 => [
                'benar' => 'Jawaban kamu benar. Pilihan b adalah ikan yang bentuknya panjang.',
                'salah' => 'Jawaban kamu salah. Yang benar adalah ikan pada pilihan b yang bentuknya panjang.',
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Pilihan a adalah olahan iwak wadi yang bentuknya pendek.',
                'salah' => 'Jawaban kamu salah. Yang benar adalah iwak wadi pada pilihan a yang bentuknya pendek.',
            ],
            3 => [
                'benar' => 'Jawaban kamu benar. Pilihan b adalah tempat biji-bijian yang tergantung tinggi.',
                'salah' => 'Jawaban kamu salah. Yang benar adalah tempat biji-bijian pada pilihan b yang tergantung tinggi.',
            ],
            4 => [
                'benar' => 'Jawaban kamu benar. Pilihan a adalah jam dinding rotan yang tergantung rendah.',
                'salah' => 'Jawaban kamu salah. Yang benar adalah jam dinding rotan pada pilihan a yang tergantung rendah.',
            ],
        ];
        $totalSoal = 4;
        $firstUnanswered = 1;
        for($i=1;$i<=$totalSoal;$i++){ if(empty($jawabanUser['soal'.$i])) { $firstUnanswered = $i; break; } }
        $kunci = $kunci ?? [];
    ?>

    <?php if(count($jawabanUser) < $totalSoal): ?>
    <div id="stepper-soal">
        <div class="d-flex justify-content-center gap-2 mb-4">
            <?php for($no = 1; $no <= $totalSoal; $no++): ?>
                <button type="button"
                    class="btn btn-outline-primary px-3 py-1 stepper-btn <?php if($no === $firstUnanswered): ?> btn-primary <?php endif; ?>"
                    onclick="showStep(<?php echo e($no); ?>)"
                    id="btn-stepper-<?php echo e($no); ?>">
                    Soal <?php echo e($no); ?>

                </button>
            <?php endfor; ?>
        </div>
        <?php for($no = 1; $no <= $totalSoal; $no++): ?>
        <div class="materi-section mb-5 fs-5 soal-step" id="soal-step-<?php echo e($no); ?>" style="<?php if($no !== $firstUnanswered): ?>display:none;<?php endif; ?>">
            <p class="mb-3 d-flex align-items-center">
                <span class="warna-label blue-card" style="margin-right:9px;"><?php echo e($no); ?></span>
                <strong><?php echo e($soalText[$no]); ?></strong>
                <button onclick="toggleAudio(this)" type="button" class="btn-audio ms-2" data-id="hal4_<?php echo e($no); ?>" data-playing="false">🔊</button>
                <audio id="audio-hal4_<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal4/hal4_' . $no . '.mp3')); ?>"></audio>
            </p>
            <div class="position-relative mx-auto mb-3 soal-pilihan-gambar" style="max-width: 660px; height: 370px;">
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/soal'.$no.'_bg.png')); ?>" class="w-100 h-100 rounded shadow" style="object-fit: cover;">
                <label for="soal<?php echo e($no); ?>a"
                    class="soal-label-gambar position-absolute d-flex flex-column align-items-center"
                    style="top: <?php echo e($positions[$no]['a_top']); ?>; left: <?php echo e($positions[$no]['a_left']); ?>; transform: translate(-50%, -50%); cursor: pointer; z-index: 10;">
                    <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/soal'.$no.'_a.png')); ?>"
                        width="180"
                        height="180"
                        class="shadow img-radio-pilihan"
                        style="border-radius:14px; transition:.2s;">
                    <input type="radio"
                        class="form-check-input radio-pilihan mt-2"
                        name="jawaban[soal<?php echo e($no); ?>]"
                        value="a"
                        id="soal<?php echo e($no); ?>a"
                        required
                        data-no="<?php echo e($no); ?>"
                        <?php if(isset($jawabanUser['soal'.$no])): ?> checked disabled <?php endif; ?>
                    >
                    <span class="badge warna-label orange-card mt-1">a</span>
                </label>
                <label for="soal<?php echo e($no); ?>b"
                    class="soal-label-gambar position-absolute d-flex flex-column align-items-center"
                    style="top: <?php echo e($positions[$no]['b_top']); ?>; left: <?php echo e($positions[$no]['b_left']); ?>; transform: translate(-50%, -50%); cursor: pointer; z-index: 10;">
                    <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/soal'.$no.'_b.png')); ?>"
                        width="180"
                        height="180"
                        class="shadow img-radio-pilihan"
                        style="border-radius:14px; transition:.2s;">
                    <input type="radio"
                        class="form-check-input radio-pilihan mt-2"
                        name="jawaban[soal<?php echo e($no); ?>]"
                        value="b"
                        id="soal<?php echo e($no); ?>b"
                        data-no="<?php echo e($no); ?>"
                        <?php if(isset($jawabanUser['soal'.$no])): ?> checked disabled <?php endif; ?>
                    >
                    <span class="badge warna-label purple-card mt-1">b</span>
                </label>
            </div>
            <div id="penjelasan-<?php echo e($no); ?>" class="mt-2 mb-3">
                <?php if(isset($jawabanUser['soal'.$no])): ?>
                    <?php
                        $jawab = $jawabanUser['soal'.$no];
                        $benar = $jawab == ($kunci['soal'.$no] ?? '');
                        $explainType = $benar ? 'benar' : 'salah';
                        $kuncijawab = $kunci['soal'.$no] ?? '-';
                        $audioPenjelasanId = 'audio-penjelasan-' . $explainType . $no;
                        $audioPenjelasanSrc = asset('sounds/materi/hal4/' . $explainType . $no . '.mp3');
                    ?>
                    <span class="badge warna-label <?php echo e($benar ? 'green-card':'red-card'); ?> mb-1">
                        Jawaban <?php echo e($benar ? 'Benar':'Salah'); ?>

                        <?php if($benar): ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✔</span>
                        <?php else: ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✖</span>
                        <?php endif; ?>
                    </span>
                    <span class="badge warna-label yellow-card mb-1">
                        Kunci Jawaban:  <?php echo e($kuncijawab); ?>

                    </span>
                    <div class="card card-body border-info bg-light d-flex flex-column align-items-center gap-3">
                        <span><?php echo $penjelasanText[$no][$explainType]; ?>

                        <button onclick="toggleAudio(this)" type="button" class="btn-audio mt-2"
                        data-id="penjelasan-<?php echo e($explainType . $no); ?>" data-playing="false">🔊</button>
                        <audio id="audio-penjelasan-<?php echo e($explainType . $no); ?>" src="<?php echo e($audioPenjelasanSrc); ?>"></audio></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endfor; ?>
    </div>
    <?php endif; ?>

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
                <p class="mb-3 d-flex align-items-center">
                    <span class="warna-label blue-card" style="margin-right:9px;"><?php echo e($no); ?></span>
                    <strong><?php echo e($soalText[$no]); ?></strong>
                    <button onclick="toggleAudio(this)" type="button" class="btn-audio ms-2" data-id="hal4_<?php echo e($no); ?>" data-playing="false">🔊</button>
                    <audio id="audio-hal4_<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal4/hal4_' . $no . '.mp3')); ?>"></audio>
                </p>
                <div class="position-relative mx-auto mb-3 soal-pilihan-gambar" style="max-width: 660px; height: 370px;">
                    <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/soal'.$no.'_bg.png')); ?>" class="w-100 h-100 rounded shadow" style="object-fit: cover;">
                    <div class="soal-label-gambar position-absolute d-flex flex-column align-items-center"
                        style="top: <?php echo e($positions[$no]['a_top']); ?>; left: <?php echo e($positions[$no]['a_left']); ?>; transform: translate(-50%, -50%); z-index: 10;">
                        <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/soal'.$no.'_a.png')); ?>"
                            width="180"
                            height="180"
                            class="shadow img-radio-pilihan
                            <?php if($jawabanUser['soal'.$no]=='a'): ?>
                                <?php if($kunci['soal'.$no] == 'a'): ?> border border-3 border-success
                                <?php else: ?> border border-3 border-danger
                                <?php endif; ?>
                            <?php endif; ?>"
                            style="border-radius:14px; transition:.2s;">
                        <span class="badge warna-label orange-card mt-1">a</span>
                    </div>
                    <div class="soal-label-gambar position-absolute d-flex flex-column align-items-center"
                        style="top: <?php echo e($positions[$no]['b_top']); ?>; left: <?php echo e($positions[$no]['b_left']); ?>; transform: translate(-50%, -50%); z-index: 10;">
                        <img src="<?php echo e(asset('images/materi/ayo-mencoba-1/soal'.$no.'_b.png')); ?>"
                            width="180"
                            height="180"
                            class="shadow img-radio-pilihan
                            <?php if($jawabanUser['soal'.$no]=='b'): ?>
                                <?php if($kunci['soal'.$no] == 'b'): ?> border border-3 border-success
                                <?php else: ?> border border-3 border-danger
                                <?php endif; ?>
                            <?php endif; ?>"
                            style="border-radius:14px; transition:.2s;">
                        <span class="badge warna-label purple-card mt-1">b</span>
                    </div>
                </div>
                <?php
                    $benar = $jawabanUser['soal'.$no] == $kunci['soal'.$no];
                    $kuncijawab = $kunci['soal'.$no];
                    $explainType = $benar ? 'benar' : 'salah';
                    $audioPenjelasanId = 'audio-penjelasan-' . $explainType . $no;
                    $audioPenjelasanSrc = asset('sounds/materi/hal4/' . $explainType . $no . '.mp3');
                ?>
                <div class="mt-2 mb-3">
                    <span class="badge <?php if($benar): ?> warna-label green-card <?php else: ?> warna-label red-card <?php endif; ?> mb-1">
                        Jawaban <?php echo e($benar ? 'Benar' : 'Salah'); ?>

                        <?php if($benar): ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✔</span>
                        <?php else: ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✖</span>
                        <?php endif; ?>
                    </span>
                    <span class="badge warna-label yellow-card mb-1">
                        Kunci Jawaban:  <?php echo e($kuncijawab); ?>

                    </span>
                    <div class="card card-body border-info bg-light d-flex flex-column align-items-center gap-3">
                        <span><?php echo $penjelasanText[$no][$explainType]; ?>

                        <button onclick="toggleAudio(this)" type="button" class="btn-audio mt-2"
                        data-id="penjelasan-<?php echo e($explainType . $no); ?>" data-playing="false">🔊</button>
                        <audio id="audio-penjelasan-<?php echo e($explainType . $no); ?>" src="<?php echo e($audioPenjelasanSrc); ?>"></audio></span>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
            <div id="skor-kkm-area" style="margin-top:10px;">
                <?php if($skor < $kkm): ?>
                    <form action="<?php echo e(route('admin.materi.halaman4.reset')); ?>" method="POST" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger fs-5">Ulangi Latihan</button>
                    </form><br>
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
        </div>
    <?php endif; ?>

    <div class="materi-nav-footer" style="margin-top:32px;">
        <a href="<?php echo e(route('admin.materi.halaman3')); ?>" class="btn-nav" style="min-width:160px">← Sebelumnya</a>
        <?php if(count($jawabanUser) === $totalSoal && $skor >= $kkm): ?>
            <a href="<?php echo e(route('admin.materi.halaman5')); ?>" class="btn-nav btn-next" style="min-width:160px">Selanjutnya →</a>
        <?php else: ?>
            <button class="btn-nav btn-next" style="opacity:0.6; pointer-events:none; min-width:160px;">Selanjutnya →</button>
        <?php endif; ?>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);
    const audioBGM = document.getElementById('bg-music');
    document.querySelectorAll('audio').forEach(a => {
        if (a !== audio && (!audioBGM || a !== audioBGM)) {
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
        audio.currentTime = 0;
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
const answered = <?php echo json_encode($jawabanUser); ?>;

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
    document.querySelectorAll('.soal-step input[type=radio][name^="jawaban[soal"]').forEach(function(radio) {
        radio.addEventListener('change', function(e) {
            if (this.disabled) return;
            let soalNo = parseInt(this.getAttribute('data-no'));
            let jawaban = this.value;
            let radios = document.querySelectorAll('input[name="jawaban[soal'+soalNo+']"]');
            radios.forEach(x => x.disabled = true);
            fetch('<?php echo e(route('admin.materi.halaman4.jawab')); ?>', {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
                body: JSON.stringify({no: soalNo, jawaban: jawaban})
            })
            .then(res => res.json())
            .then(res => {
                if (!res.success) {
                    alert(res.msg ?? 'Terjadi kesalahan!');
                    window.location.reload();
                    return;
                }
                showFeedbackPopup(res.feedback, soalNo, res.benar, function() {
                    fetch('<?php echo e(route('admin.materi.halaman4')); ?>', {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                    .then(response => response.text())
                    .then(html => {
                        let regex = /let currentStep = (\d+)/;
                        let match = html.match(regex);
                        let firstUnanswered = match ? parseInt(match[1]) : 1;
                        let allAnswered = false;
                        if (typeof res.semua_sudah !== "undefined") allAnswered = res.semua_sudah;
                        setTimeout(() => {
                            if (allAnswered) {
                                window.location.reload();
                            } else {
                                showStep(firstUnanswered);
                            }
                        }, 400);
                    });
                });
                setTimeout(() => {
                    let penjelasanArea = document.getElementById('penjelasan-' + soalNo);
                    if (penjelasanArea) {
                        // Format SAMA seperti di blade!
                        let benar = res.benar;
                        let exType = benar ? 'benar' : 'salah';
                        let kunci = res.kunci ?? '-';
                        let audioPenjelasanSrc = res.audioPenjelasanSrc;
                        penjelasanArea.innerHTML =
                            `<span class="badge warna-label ${benar ? 'green-card':'red-card'} mb-1">
                                Jawaban ${benar ? 'Benar':'Salah'} ${benar ? '✔':'✖'}
                            </span>
                            <span class="badge warna-label yellow-card mb-1">
                                Kunci Jawaban:  ${kunci}
                            </span>
                            <div class="card card-body border-info bg-light d-flex flex-column align-items-center gap-3">
                                <span>${res.penjelasan}
                                <button onclick="toggleAudio(this)" type="button" class="btn-audio mt-2"
                                    data-id="penjelasan-${exType}${soalNo}" data-playing="false">🔊</button>
                                <audio id="audio-penjelasan-${exType}${soalNo}" src="${audioPenjelasanSrc}"></audio>
                                </span>
                            </div>`;
                    }
                }, 350);
            });
        });
    });
    <?php endif; ?>
});

function showFeedbackPopup(feedback, soalNo, isBenar, afterClose) {
    let popup = document.getElementById('popup-feedback');
    let popupImg = document.getElementById('popup-img');
    let popupJudul = document.getElementById('popup-judul');
    let popupText = document.getElementById('popup-text');
    let popupKunci = document.getElementById('popup-kunci');
    let popupAudio = document.getElementById('popup-audio');
    let audioPath = isBenar
        ? '<?php echo e(asset('sounds/materi/hal4/benar')); ?>' + soalNo + '.mp3'
        : '<?php echo e(asset('sounds/materi/hal4/salah')); ?>' + soalNo + '.mp3';
    popupImg.src = isBenar
        ? '<?php echo e(asset('images/materi/ayo-mencoba-1/benar.png')); ?>'
        : '<?php echo e(asset('images/materi/ayo-mencoba-1/salah.png')); ?>';
    popupJudul.innerText = feedback.judul;
    popupText.innerText = feedback.text;
    popupKunci.innerHTML = `Kunci Jawaban: <b>${feedback.kunci}</b>`;
    popupAudio.src = audioPath;
    popupAudio.currentTime = 0;
    popup.style.display = 'flex';
    popupAudio.play();
    popupAudio.onended = function () {
        popup.style.display = 'none';
        if (typeof afterClose === "function") afterClose();
    };
}

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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman4.blade.php ENDPATH**/ ?>