

<?php $__env->startSection('content'); ?>
<div class="materi-main-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Ayo Berlatih
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="materi-section fs-5">
        <p>
            Amati gambar berikut dengan saksama! Isilah titik-titik di bawah ini menggunakan pilihan kata <strong>panjang</strong>, <strong>pendek</strong>, <strong>tinggi</strong>, atau <strong>rendah</strong> melalui menu dropdown!
            <button onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal5/1.mp3')); ?>"></audio>
        </p>
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
        $opsiDropdown = ['panjang', 'pendek', 'tinggi', 'rendah'];
        $totalSoal = 4;
        $firstUnanswered = 1;
        for($i=1;$i<=$totalSoal;$i++){ if(empty($jawabanUser['soal'.$i])) { $firstUnanswered = $i; break; } }
        $penjelasan = [
            1 => [
                'benar' => 'Jawaban kamu benar. Sendok nasi memang berukuran pendek daripada sutil.',
                'salah' => 'Jawaban kamu salah. Perhatikan ukuran sendok nasi dengan sutil pada gambar.'
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Kotak tisu memang berukuran panjang dari kotak pensil.',
                'salah' => 'Jawaban kamu salah. Perhatikan ukuran kotak tisu dengan kotak pensil pada gambar.'
            ],
            3 => [
                'benar' => 'Jawaban kamu benar. Tugu asli memang berukuran tinggi dari versi miniaturnya.',
                'salah' => 'Jawaban kamu salah. Perhatikan perbandingan tugu asli dengan miniatur pada gambar.'
            ],
            4 => [
                'benar' => 'Jawaban kamu benar. Miniatur perisai dayak memang berukuran rendah dari aslinya.',
                'salah' => 'Jawaban kamu salah. Perhatikan perbandingan miniatur perisai dayak dengan aslinya pada gambar.'
            ],
        ];
        $audioPenjelasan = [
            1 => asset('sounds/materi/hal5/penjelasan_1.mp3'),
            2 => asset('sounds/materi/hal5/penjelasan_2.mp3'),
            3 => asset('sounds/materi/hal5/penjelasan_3.mp3'),
            4 => asset('sounds/materi/hal5/penjelasan_4.mp3'),
        ];
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
        <?php for($no=1; $no<=$totalSoal; $no++): ?>
        <div class="materi-section mb-4 soal-step" id="soal-step-<?php echo e($no); ?>" style="<?php if($no !== $firstUnanswered): ?>display:none;<?php endif; ?>">
            <h5 class="mb-2 d-flex align-items-center">
                <span class="warna-label blue-card" style="margin-right:10px;"><?php echo e($no); ?></span>
            </h5>
            <div class="row mb-2 align-items-center justify-content-center">
                <div class="col-6 text-center">
                    <img src="<?php echo e(asset("images/materi/ayo-berlatih-1/soal{$no}a.png")); ?>" class="img-fluid rounded shadow"
                         style="max-width:180px; max-height:200px; width:180px; height:180px; object-fit:cover;">
                </div>
                <div class="col-6 text-center">
                    <img src="<?php echo e(asset("images/materi/ayo-berlatih-1/soal{$no}b.png")); ?>" class="img-fluid rounded shadow"
                         style="max-width:180px; max-height:200px; width:180px; height:180px; object-fit:cover;">
                </div>
            </div>
            <p>
                <?php echo match($no) {
                    1 => 'Sendok nasi dari kayu ulin ini berukuran <strong>________</strong> jika dibandingkan sutil dari kayu ulin.',
                    2 => 'Kotak tisu yang terbuat dari batok kelapa ini memiliki ukuran <strong>________</strong> jika dibandingkan kotak pensil kain motif Dayak di sebelahnya.',
                    3 => 'Tugu Obor Api Tabalong yang berada di Kalimantan Selatan ini berukuran <strong>________</strong> jika dibandingkan versi miniaturnya.',
                    4 => 'Miniatur perisai dayak itu sangat <strong>________</strong> jika dibandingkan versi aslinya.',
                }; ?>

                <button
                    type="button"
                    onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    title="Dengarkan"
                    data-id="hal5-<?php echo e($no); ?>"
                    data-playing="false">
                    🔊
                </button>
                <audio id="audio-hal5-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal5/hal5-' . $no . '.mp3')); ?>"></audio>
            </p>
            <div class="d-flex align-items-center gap-2 mb-2">
                <select name="jawaban[soal<?php echo e($no); ?>]" class="form-select soal-dropdown" id="dropdown-<?php echo e($no); ?>" data-no="<?php echo e($no); ?>"
                    <?php if(isset($jawabanUser['soal'.$no])): ?> disabled <?php endif; ?>
                    required style="max-width: 200px;">
                    <option value="">-- Pilih jawaban --</option>
                    <?php $__currentLoopData = $opsiDropdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opsi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($opsi); ?>" <?php if(($jawabanUser['soal'.$no] ?? old("jawaban.soal$no")) == $opsi): ?> selected <?php endif; ?>><?php echo e(ucfirst($opsi)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <audio id="audio-dropdown-<?php echo e($no); ?>" src=""></audio>
            </div>
            <div id="penjelasan-<?php echo e($no); ?>"></div>
        </div>
        <?php endfor; ?>
        <div class="materi-nav-footer" style="margin-top:24px;">
            <a href="<?php echo e(route('admin.materi.halaman4')); ?>" class="btn-nav" style="min-width:160px">← Sebelumnya</a>
            <button class="btn-nav btn-next" style="min-width:160px; opacity:0.6; pointer-events:none;">Selanjutnya →</button>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if(count($jawabanUser) === $totalSoal): ?>
        <div id="review-area">
            <div class="text-center mb-3">
                <h4 class="fw-bold">Review Jawabanmu</h4>
            </div>
            <div class="mb-3 d-flex justify-content-center gap-2">
                <?php for($no=1;$no<=$totalSoal;$no++): ?>
                <button type="button" class="btn btn-outline-primary px-3 py-1" onclick="showReviewSoal(<?php echo e($no); ?>)" id="btn-review-<?php echo e($no); ?>">
                    Soal <?php echo e($no); ?>

                </button>
                <?php endfor; ?>
            </div>
            <?php for($no=1;$no<=$totalSoal;$no++): ?>
            <div class="materi-section mb-5 fs-5 review-step" id="review-step-<?php echo e($no); ?>" style="<?php if($no>1): ?>display:none;<?php endif; ?>">
                <h5 class="mb-2 d-flex align-items-center">
                    <span class="warna-label blue-card" style="margin-right:10px;"><?php echo e($no); ?></span>
                </h5>
                <div class="row mb-2 align-items-center justify-content-center">
                    <div class="col-6 text-center">
                        <img src="<?php echo e(asset("images/materi/ayo-berlatih-1/soal{$no}a.png")); ?>" class="img-fluid rounded shadow"
                             style="max-width:180px; max-height:200px; width:180px; height:180px; object-fit:cover;">
                    </div>
                    <div class="col-6 text-center">
                        <img src="<?php echo e(asset("images/materi/ayo-berlatih-1/soal{$no}b.png")); ?>" class="img-fluid rounded shadow"
                             style="max-width:180px; max-height:200px; width:180px; height:180px; object-fit:cover;">
                    </div>
                </div>
                <p>
                    <?php echo match($no) {
                        1 => 'Sendok nasi dari kayu ulin ini berukuran <strong>________</strong> jika dibandingkan sutil dari kayu ulin.',
                        2 => 'Kotak tisu yang terbuat dari batok kelapa ini memiliki ukuran <strong>________</strong> jika dibandingkan kotak pensil kain motif Dayak di sebelahnya.',
                        3 => 'Tugu Obor Api Tabalong yang berada di Kalimantan Selatan ini berukuran <strong>________</strong> jika dibandingkan versi miniaturnya.',
                        4 => 'Miniatur perisai dayak itu sangat <strong>________</strong> jika dibandingkan versi aslinya.',
                    }; ?>

                </p>
                <div class="mb-2">
                    <?php
                        $userAnswer = $jawabanUser['soal'.$no] ?? null;
                        $kunciJawab = $kunci['soal'.$no] ?? null;
                        $isCorrect = $userAnswer === $kunciJawab;
                        $explainType = $isCorrect ? 'benar' : 'salah';
                    ?>
                    <span class="badge warna-label <?php echo e($isCorrect ? 'green-card' : 'red-card'); ?> mb-1">
                        Jawaban <?php echo e($isCorrect ? 'Benar' : 'Salah'); ?>

                        <?php if($isCorrect): ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✔</span>
                        <?php else: ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✖</span>
                        <?php endif; ?>
                    </span>
                    <span class="badge warna-label yellow-card mt-1">Jawaban: <?php echo e(ucfirst($jawabanUser['soal'.$no])); ?></span>
                    <div class="card card-body border-info bg-light mt-2">
                        <span><?php echo $penjelasan[$no][$explainType] ?? ''; ?>

                        <button type="button" onclick="playPenjelasanAudio(<?php echo e($no); ?>, this)" class="btn btn-audio ms-2">
                            🔊
                        </button>
                        <audio id="audio-penjelasan-<?php echo e($no); ?>" src="<?php echo e($audioPenjelasan[$no] ?? ''); ?>"></audio> </span>
                    </div>
                    <div class="mt-1"><span class="badge warna-label blue-card">Kunci Jawaban: <?php echo e(ucfirst($kunciJawab)); ?></span></div>
                </div>
            </div>
            <?php endfor; ?>
            <div id="skor-kkm-area" style="margin-top:10px;">
                <?php if($skor < $kkm): ?>
                    <form action="<?php echo e(route('admin.materi.halaman5.reset')); ?>" method="POST" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Ulangi Soal</button>
                    </form>
                    <div class="alert alert-warning mt-3">
                        Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
                    </div>
                <?php else: ?>
                    <div class="text-center flex-grow-1 fs-5">
                        <div id="skor-anda" class="alert alert-info d-inline-block mb-0">
                            Nilai Anda: <?php echo e($skor); ?> / 100
                        </div>
                    </div>
                    <br>
                    <div class="alert alert-success mt-3 fs-5">
                        Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
                    </div>
                <?php endif; ?>
            </div>
            <div class="materi-nav-footer" style="margin-top:32px;">
                <a href="<?php echo e(route('admin.materi.halaman4')); ?>" class="btn-nav" style="min-width:160px;">← Sebelumnya</a>
                <?php if($skor >= $kkm): ?>
                    <a href="<?php echo e(route('admin.materi.halaman6')); ?>" class="btn-nav btn-next" style="min-width:160px;">Selanjutnya →</a>
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
const answered = <?php echo json_encode($jawabanUser); ?>;

// Stepper mode (menjawab)
function showStep(no) {
    for (let i = 1; i <= totalSoal; i++) {
        document.getElementById('soal-step-' + i).style.display = (i === no ? '' : 'none');
        let btn = document.getElementById('btn-stepper-' + i);
        if(btn) btn.classList.toggle('btn-primary', i === no);
    }
    currentStep = no;
}

// Review navigation
function showReviewSoal(no){
    document.querySelectorAll('.review-step').forEach(function(el, i){
        el.style.display = (i+1)==no ? '' : 'none';
    });
    for(let i=1;i<=totalSoal;i++){
        let btn = document.getElementById('btn-review-'+i);
        if(btn) btn.classList.toggle('btn-primary', i===no);
    }
}

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

document.addEventListener('DOMContentLoaded', function () {
    // --- AUTOPLAY & DELAY EVALUASI SETELAH AUDIO ---
    <?php if(count($jawabanUser) < $totalSoal): ?>
    document.querySelectorAll('.soal-dropdown').forEach(function(select){
        select.addEventListener('change', function(){
            let no = parseInt(this.getAttribute('data-no'));
            let value = this.value;
            if (!value) return;

            // Disable sementara select sampai audio selesai
            select.disabled = true;

            // Mainkan audio sesuai jawaban
            const audioEl = document.getElementById('audio-dropdown-' + no);
            const audioPath = `<?php echo e(asset('sounds/materi/hal5/')); ?>/soal${no}-${value}.mp3`;
            audioEl.src = audioPath; audioEl.load();

            // Pause semua audio lain agar tidak overlap
            document.querySelectorAll('audio').forEach(a => {
                if (a !== audioEl) { a.pause(); a.currentTime = 0; }
            });

            // Play audio, lalu setelah selesai baru kirim fetch penilaian
            audioEl.play();
            audioEl.onended = function() {
                fetch("<?php echo e(route('admin.materi.halaman5.jawab')); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ no: no, jawaban: value })
                })
                .then(res => res.json())
                .then(res => {
                    if (!res.success) {
                        alert(res.msg ?? 'Terjadi kesalahan!');
                        select.disabled = true;
                        return;
                    }
                    showFeedbackPopup(res.feedback, no);
                    setTimeout(() => {
                        let penjelasanArea = document.getElementById('penjelasan-' + no);
                        if (penjelasanArea) {
                            penjelasanArea.innerHTML =
                                `<span class="badge warna-label ${res.benar ? 'green-card':'red-card'} mb-1">Jawaban ${res.benar ? 'Benar':'Salah'} ${res.benar ? '✔':'✖'}</span>
                                <div class="card card-body border-info bg-light mt-2">${res.penjelasan}
                                </div>
                                <div class="mt-1"><span class="badge warna-label green-card">Kunci Jawaban: ${res.kunci.charAt(0).toUpperCase()+res.kunci.slice(1)}</span></div>`;
                        }
                        // Fetch currentStep/firstUnanswered
                        fetch('<?php echo e(route('admin.materi.halaman5')); ?>', {headers: {'X-Requested-With': 'XMLHttpRequest'}})
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
                            }, 800);
                        });
                    }, 1100);
                });
            };
            audioEl.onerror = function() {
                // Jika audio gagal (file tidak ditemukan), langsung proses penilaian
                fetch("<?php echo e(route('admin.materi.halaman5.jawab')); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ no: no, jawaban: value })
                })
                .then(res => res.json())
                .then(res => {
                    if (!res.success) {
                        alert(res.msg ?? 'Terjadi kesalahan!');
                        select.disabled = true;
                        return;
                    }
                    showFeedbackPopup(res.feedback, no);
                    setTimeout(() => {
                        let penjelasanArea = document.getElementById('penjelasan-' + no);
                        if (penjelasanArea) {
                            penjelasanArea.innerHTML =
                                `<span class="badge warna-label ${res.benar ? 'green-card':'red-card'} mb-1">Jawaban ${res.benar ? 'Benar':'Salah'} ${res.benar ? '✔':'✖'}</span>
                                <div class="card card-body border-info bg-light mt-2">${res.penjelasan}
                                </div>
                                <div class="mt-1"><span class="badge warna-label green-card">Kunci Jawaban: ${res.kunci.charAt(0).toUpperCase()+res.kunci.slice(1)}</span></div>`;
                        }
                        fetch('<?php echo e(route('admin.materi.halaman5')); ?>', {headers: {'X-Requested-With': 'XMLHttpRequest'}})
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
                            }, 800);
                        });
                    }, 1100);
                });
            };
        });
    });
    <?php endif; ?>
});

function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);
    document.querySelectorAll('audio').forEach(a => { if (a !== audio) { a.pause(); a.currentTime = 0; } });
    document.querySelectorAll('button[data-id]').forEach(btn => {
        if (btn !== button) { btn.innerText = '🔊'; btn.setAttribute('data-playing', 'false'); }
    });
    if (audio.paused) {
        audio.play(); button.innerText = '⏸️'; button.setAttribute('data-playing', 'true');
    } else {
        audio.pause(); button.innerText = '🔊'; button.setAttribute('data-playing', 'false');
    }
    audio.onended = function () { button.innerText = '🔊'; button.setAttribute('data-playing', 'false'); };
}

function showFeedbackPopup(feedback, soalNo) {
    let popup = document.getElementById('popup-feedback');
    let popupImg = document.getElementById('popup-img');
    let isBenar = feedback.benar === true || (feedback.judul && feedback.judul.toLowerCase().includes('benar'));
    popupImg.src = isBenar
        ? '<?php echo e(asset('images/feedback/benar.png')); ?>'
        : '<?php echo e(asset('images/feedback/salah.png')); ?>';
    document.getElementById('popup-judul').innerText = feedback.judul;
    document.getElementById('popup-text').innerText = feedback.text;
    document.getElementById('popup-kunci').innerHTML = `Kunci Jawaban: <b>${feedback.kunci.charAt(0).toUpperCase()+feedback.kunci.slice(1)}</b>`;
    let audio = document.getElementById('popup-audio');
    audio.src = feedback.audio; audio.currentTime = 0; audio.play();
    popup.style.display = 'flex';
    setTimeout(() => { popup.style.display = 'none'; audio.pause(); }, 1300);
    audio.onended = function () { popup.style.display = 'none'; };
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman5.blade.php ENDPATH**/ ?>