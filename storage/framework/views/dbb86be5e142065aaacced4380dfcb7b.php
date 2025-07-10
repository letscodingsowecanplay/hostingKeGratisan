
<?php $__env->startSection('title', 'Ayo Berlatih'); ?>
<?php $__env->startSection('content'); ?>
<div class="materi-main-container fs-5" id="hal10-container">
    <h2 class="fw-bold text-center mb-3" style="font-size: 2rem;">Ayo Berlatih</h2>
    <div id="popup-feedback" style="display:none; position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:1000; background:rgba(40,75,99,.13); align-items:center;justify-content:center;">
        <div style="background:#fff; border-radius:16px; box-shadow:0 7px 38px #2223; padding:32px 38px; max-width:400px; width:98vw; text-align:center; position:relative;">
            <img id="popup-img" src="" style="max-width:130px; max-height:130px; margin-bottom:15px; border-radius:15px; box-shadow:0 3px 15px #0002;">
            <h4 id="popup-judul" style="font-weight:700;"></h4>
            <p id="popup-text" style="font-size:1.1rem;margin-bottom:2px;"></p>
            <div style="margin:7px auto 0 auto; font-size:1.13rem;" id="popup-kunci"></div>
        </div>
        <audio id="popup-audio" src=""></audio>
    </div>
    <div class="materi-content">
        <p class="mb-4">
            Amati gambar berikut dengan saksama! Pilih salah satu jawaban yang benar dari pilihan A, B, atau C di bawah ini!
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-1" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal10/1.mp3')); ?>"></audio>
        </p>
    </div>
    <?php
        $totalSoal = count($soal);
        $firstUnanswered = 1;
        for($i=0;$i<$totalSoal;$i++){ if(!isset($jawabanUser[$i])) { $firstUnanswered = $i+1; break; } }
        $penjelasan = [
            0 => [
                'benar' => 'Jawaban kamu benar. Urutan miniatur rumah banjar dari yang paling tinggi adalah a-b-c.',
                'salah' => 'Jawaban kamu salah. Perhatikan kembali urutan tinggi rumah pada gambar.',
            ],
            1 => [
                'benar' => 'Jawaban kamu benar. Tas kerajinan khas Kalimantan yang digantung paling rendah adalah c-b-a.',
                'salah' => 'Jawaban kamu salah. Lihat kembali posisi tas pada gambar.',
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Urutan patung dayak dari yang paling panjang adalah b, a, lalu c sesuai gambar.',
                'salah' => 'Jawaban kamu salah. Cermati kembali ukuran patung.',
            ],
            3 => [
                'benar' => 'Jawaban kamu benar. Urutan vas bunga akar keladi dari yang paling pendek adalah c, lalu b, dan paling tinggi a.',
                'salah' => 'Jawaban kamu salah. Perhatikan kembali ukuran vas pada gambar.',
            ],
            4 => [
                'benar' => 'Jawaban kamu benar. Urutan kain sasirangan dari yang paling panjang adalah a, lalu c, lalu b.',
                'salah' => 'Jawaban kamu salah. Lihat kembali panjang kain pada gambar.',
            ],
        ];
        $kkm = $kkm ?? 70;
    ?>

    
    <div id="stepper-soal"
         style="<?php if(count($jawabanUser) === $totalSoal): ?>display:none;<?php endif; ?>">
        <div class="d-flex justify-content-center gap-2 mb-4">
            <?php for($no = 1; $no <= $totalSoal; $no++): ?>
                <button type="button"
                    class="btn btn-outline-primary px-3 py-1 stepper-btn"
                    onclick="showStep(<?php echo e($no); ?>)"
                    id="btn-stepper-<?php echo e($no); ?>">
                    Soal <?php echo e($no); ?>

                </button>
            <?php endfor; ?>
        </div>
        <?php $__currentLoopData = $soal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $no = $index + 1;
                $userAnswer = $jawabanUser[$index] ?? null;
                $kunci = $kunciJawaban[$index] ?? null;
                $penjelasanSoal = $penjelasan[$index] ?? ['benar' => '', 'salah' => ''];
                $isBenar = ($userAnswer !== null && $userAnswer === $kunci);
            ?>
            <div class="mb-5 materi-section shadow-sm rounded-3 py-3 px-3 soal-step"
                 id="soal-step-<?php echo e($no); ?>" style="display:none;background:#fff;">
                <div class="d-flex align-items-center mb-2" style="gap: 16px;">
                    <span class="warna-label yellow-card" style="font-size:1rem; margin-bottom:0; padding:6px 18px;">
                        <?php echo e($no); ?>.
                    </span>
                    <span class="fw-bold materi-content" style="font-size:1.13rem; flex:1;">
                        <?php echo e($item['pertanyaan']); ?>

                    </span>
                    <?php if(!empty($item['audio'])): ?>
                        <button type="button" onclick="toggleAudio(this)" class="btn-audio" data-id="hal10-<?php echo e($no); ?>" data-playing="false" aria-label="Dengarkan soal" style="margin-left:10px;">🔊</button>
                        <audio id="hal10-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal10/hal10-' . $no . '.mp3')); ?>"></audio>
                    <?php endif; ?>
                </div>
                <?php if(!empty($item['gambar'])): ?>
                    <div class="materi-image-row justify-content-center my-2">
                        <div class="materi-image-col" style="max-width:340px">
                            <img src="<?php echo e(asset('images/materi/ayo-berlatih-2/' . $item['gambar'])); ?>"
                                 alt="Gambar soal <?php echo e($no); ?>"
                                 class="img-fluid materi-img rounded-4"
                                 style="max-width:320px;"/>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="mt-3" id="pilihan-<?php echo e($index); ?>">
                    <?php $__currentLoopData = $item['pilihan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pilihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isUserAnswer = ($userAnswer === $key);
                            $isKunci = ($kunci === $key);
                            $highlightClass = '';
                            if($userAnswer !== null && $isUserAnswer) {
                                $highlightClass = $isBenar ? 'bg-success text-white' : 'bg-danger text-white';
                            }
                            $audioPilihan = asset("sounds/materi/hal10/pilihan/{$no}-{$key}.mp3");
                            $audioId = "audio-hal10-{$no}-{$key}";
                        ?>
                        <div class="card mb-2 bg-cokren <?php echo e($highlightClass); ?>" id="card-<?php echo e($index); ?>-<?php echo e($key); ?>">
                            <div class="card-body p-2 d-flex align-items-center">
                                <?php if($userAnswer === null): ?>
                                    <div class="form-check flex-grow-1 d-flex align-items-center">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="jawaban_<?php echo e($index); ?>"
                                            id="soal<?php echo e($index); ?>_<?php echo e($key); ?>"
                                            value="<?php echo e($key); ?>"
                                            data-index="<?php echo e($index); ?>"
                                            data-no="<?php echo e($no); ?>"
                                        >
                                        <label class="form-check-label ms-2" for="soal<?php echo e($index); ?>_<?php echo e($key); ?>" style="color:#222;font-weight:600;">
                                            <span style="font-weight:700; color:#222;"><?php echo e(strtoupper($key)); ?></span>)
                                            <?php echo e($pilihan); ?>

                                        </label>
                                        <button type="button" onclick="playRadioAudio(this)" class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2" data-audio-id="<?php echo e($audioId); ?>" data-playing="false">🔊</button>
                                        <audio id="<?php echo e($audioId); ?>" src="<?php echo e($audioPilihan); ?>"></audio>
                                    </div>
                                <?php else: ?>
                                    <div class="flex-grow-1 d-flex align-items-center">
                                        <span style="font-weight:700; color:#222;"><?php echo e(strtoupper($key)); ?></span>)
                                        <span style="color:#222; margin-left:3px;"><?php echo e($pilihan); ?></span>
                                        <?php if($isKunci): ?>
                                            <span style="font-size:1.45em; margin-left:12px; margin-right:2px; color:#111; display:inline-block; vertical-align:middle;">✔</span>
                                        <?php elseif($isUserAnswer && !$isKunci): ?>
                                            <span style="font-size:1.45em; margin-left:12px; margin-right:2px; color:#111; display:inline-block; vertical-align:middle;">✖</span>
                                        <?php endif; ?>
                                        <?php if($isUserAnswer): ?>
                                            <span class="badge bg-light text-dark ms-2">Jawaban Kamu</span>
                                        <?php endif; ?>
                                        <button type="button" onclick="playRadioAudio(this)" class="btn-audio" data-audio-id="<?php echo e($audioId); ?>" data-playing="false">🔊</button>
                                        <audio id="<?php echo e($audioId); ?>" src="<?php echo e($audioPilihan); ?>"></audio>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div id="penjelasan-<?php echo e($index); ?>" class="mt-2">
                <?php if($userAnswer !== null): ?>
                    <span class="badge warna-label <?php echo e($isBenar ? 'green-card':'red-card'); ?> mb-1">
                        Jawaban <?php echo e($isBenar ? 'Benar':'Salah'); ?>

                        <?php if($isBenar): ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✔</span>
                        <?php else: ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✖</span>
                        <?php endif; ?>
                    </span>
                    <span class="badge warna-label yellow-card mb-1">
                        Kunci Jawaban: <?php echo e(strtoupper($kunci)); ?>

                    </span>
                    <div class="card card-body border-info bg-light d-flex align-items-center gap-3">
                        <span><?php echo $penjelasanSoal[$isBenar ? 'benar' : 'salah']; ?>

                        <button type="button" onclick="playPenjelasanAudio(<?php echo e($no); ?>, this, <?php echo e($isBenar ? 'true' : 'false'); ?>)" class="btn btn-audio ms-2">🔊</button>
                        <audio id="audio-penjelasan-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal10/' . ($isBenar ? 'benar' : 'salah') . $no . '.mp3')); ?>"></audio>
                        </span>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php
                    $item = $soal[$no-1];
                    $userAnswer = $jawabanUser[$no-1] ?? null;
                    $kunci = $kunciJawaban[$no-1] ?? null;
                    $isBenar = ($userAnswer !== null && $userAnswer === $kunci);
                    $penjelasanSoal = $penjelasan[$no-1] ?? ['benar' => '', 'salah' => ''];
                ?>
                <div class="d-flex align-items-center mb-2" style="gap: 16px;">
                    <span class="warna-label yellow-card" style="font-size:1rem; margin-bottom:0; padding:6px 18px;">
                        <?php echo e($no); ?>.
                    </span>
                    <span class="fw-bold materi-content" style="font-size:1.13rem; flex:1;">
                        <?php echo e($item['pertanyaan']); ?>

                    </span>
                    <button
                        type="button"
                        onclick="toggleAudio(this)"
                        class="btn-audio ms-2"
                        title="Dengarkan"
                        data-id="hal10-<?php echo e($no); ?>"
                        data-playing="false">
                        🔊
                    </button>
                    <audio id="audio-hal10-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal10/hal10-' . $no . '.mp3')); ?>"></audio>
                </div>
                <?php if(!empty($item['gambar'])): ?>
                    <div class="materi-image-row justify-content-center my-2">
                        <div class="materi-image-col" style="max-width:340px">
                            <img src="<?php echo e(asset('images/materi/ayo-berlatih-2/' . $item['gambar'])); ?>"
                                 alt="Gambar soal <?php echo e($no); ?>"
                                 class="img-fluid materi-img rounded-4"
                                 style="max-width:320px;"/>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="mt-3" id="pilihan-review-<?php echo e($no); ?>">
                    <?php $__currentLoopData = $item['pilihan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pilihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isUserAnswer = ($userAnswer === $key);
                            $isKunci = ($kunci === $key);
                            $highlightClass = '';
                            if($userAnswer !== null && $isUserAnswer) {
                                $highlightClass = $isBenar ? 'border border-3 border-success' : 'border border-3 border-danger';
                            }
                        ?>
                        <div class="card mb-2 bg-cokren <?php echo e($highlightClass); ?>" id="review-card-<?php echo e($no); ?>-<?php echo e($key); ?>">
                            <div class="card-body p-2 d-flex align-items-center">
                                <span style="font-weight:700; color:#222;"><?php echo e(strtoupper($key)); ?></span>)
                                <span style="color:#222; margin-left:3px;"><?php echo e($pilihan); ?></span>
                                <?php if($isKunci): ?>
                                    <span style="font-size:1.45em; margin-left:12px; margin-right:2px; color:#111; display:inline-block; vertical-align:middle;">✔</span>
                                <?php elseif($isUserAnswer && !$isKunci): ?>
                                    <span style="font-size:1.45em; margin-left:12px; margin-right:2px; color:#111; display:inline-block; vertical-align:middle;">✖</span>
                                <?php endif; ?>
                                <?php if($isUserAnswer): ?>
                                    <span class="badge bg-light text-dark ms-2">Jawaban Kamu</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-2 mb-3">
                    <span class="badge warna-label <?php echo e($isBenar ? 'green-card':'red-card'); ?> mb-1">
                        Jawaban <?php echo e($isBenar ? 'Benar':'Salah'); ?>

                        <?php if($isBenar): ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✔</span>
                        <?php else: ?>
                            <span style="font-size:1.15em;vertical-align:middle;">✖</span>
                        <?php endif; ?>
                    </span>
                    <span class="badge warna-label yellow-card mb-1">
                        Kunci Jawaban:  <?php echo e(strtoupper($kunci)); ?>

                    </span>
                    <div class="card card-body border-info bg-light d-flex align-items-center gap-3">
                        <span><?php echo $penjelasanSoal[$isBenar ? 'benar' : 'salah']; ?> 
                        <button type="button" onclick="playPenjelasanAudio(<?php echo e($no); ?>, this, <?php echo e($isBenar ? 'true' : 'false'); ?>)" class="btn btn-audio ms-2">
                            🔊
                        </button>
                        <audio id="audio-penjelasan-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal10/' . ($isBenar ? 'benar' : 'salah') . $no . '.mp3')); ?>"></audio>
                        </span>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
            <div id="skor-kkm-area" style="margin-top:10px;">
                <?php if($skor < $kkm): ?>
                    <form action="<?php echo e(route('admin.materi.halaman10.reset')); ?>" method="POST" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger fs-5">Ulangi Soal</button>
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
        <a href="<?php echo e(route('admin.materi.halaman9')); ?>" class="btn-nav" style="min-width:160px">← Sebelumnya</a>
        <?php if(count($jawabanUser) === $totalSoal && $skor >= $kkm): ?>
            <a href="<?php echo e(route('admin.materi.halaman11')); ?>" class="btn-nav btn-next" style="min-width:160px">Selanjutnya →</a>
        <?php else: ?>
            <button class="btn-nav btn-next" style="opacity:0.6; pointer-events:none; min-width:160px;">Selanjutnya →</button>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById('audio-' + id);
    if(!audio) return;
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

function playRadioAudio(button){
    const audioId = button.getAttribute('data-audio-id');
    const audio = document.getElementById(audioId);
    if(!audio) return;
    document.querySelectorAll('audio').forEach(a => {
        if(a !== audio && a.id !== 'bg-music'){
            a.pause();
            a.currentTime = 0;
        }
    });
    document.querySelectorAll('button[data-audio-id]').forEach(btn => {
        if(btn !== button){
            btn.innerText = '🔊';
            btn.setAttribute('data-playing', 'false');
        }
    });
    if(audio.paused){
        audio.play();
        button.innerText = "⏸️";
        button.setAttribute('data-playing', 'true');
    }else{
        audio.pause();
        button.innerText = "🔊";
        button.setAttribute('data-playing', 'false');
    }
    audio.onended = function(){
        button.innerText = '🔊';
        button.setAttribute('data-playing', 'false');
    };
}

function playPenjelasanAudio(no, btn, benar){
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

const totalSoal = <?php echo e($totalSoal); ?>;
let currentStep = <?php echo e($firstUnanswered); ?>;
const answered = <?php echo json_encode($jawabanUser); ?>;

function showStep(no) {
    for (let i = 1; i <= totalSoal; i++) {
        let el = document.getElementById('soal-step-' + i);
        if(el) el.style.display = (i === no ? '' : 'none');
        let btn = document.getElementById('btn-stepper-' + i);
        if(btn) btn.classList.toggle('btn-primary', i === no);
    }
    currentStep = no;
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

// --- INIT ON LOAD ---
document.addEventListener('DOMContentLoaded', function() {
    // --- logika restore step aktif (soal yang belum dijawab, atau review jika sudah selesai) ---
    if (typeof answered === 'object' && Object.keys(answered).length === totalSoal) {
        // Semua sudah dijawab → langsung tampil review
        document.getElementById('stepper-soal') && (document.getElementById('stepper-soal').style.display = 'none');
        document.getElementById('review-area') && (document.getElementById('review-area').style.display = '');
        showReviewSoal(1);
    } else {
        // Belum selesai, tampilkan step soal yang belum dijawab
        let firstUnanswered = 1;
        for(let i=0;i<totalSoal;i++) {
            if(typeof answered[i] === 'undefined' || answered[i] === null) {
                firstUnanswered = i+1; break;
            }
        }
        showStep(firstUnanswered);
        document.getElementById('stepper-soal').style.display = '';
        document.getElementById('review-area') && (document.getElementById('review-area').style.display = 'none');
    }

    // Event handler untuk input radio (jawab soal)
    if(typeof answered === 'object' && Object.keys(answered).length < totalSoal){
        document.querySelectorAll('.soal-step input[type=radio][name^="jawaban_"]').forEach(function(radio) {
            radio.addEventListener('change', function(e) {
                if (this.disabled) return;
                let index = parseInt(this.getAttribute('data-index'));
                let no = parseInt(this.getAttribute('data-no'));
                let jawaban = this.value;
                let radios = document.querySelectorAll('input[name="jawaban_'+index+'"]');
                radios.forEach(x => x.disabled = true);
                fetch('<?php echo e(route('admin.materi.halaman10.jawab')); ?>', {
                    method: 'POST',
                    headers: {'Content-Type':'application/json','X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
                    body: JSON.stringify({index: index, jawaban: jawaban})
                })
                .then(res => res.json())
                .then(res => {
                    if (!res.success) {
                        alert(res.msg ?? 'Terjadi kesalahan!');
                        window.location.reload();
                        return;
                    }
                    showFeedbackPopupAudio(no, res.benar, res.feedback, res.kunci, null, function(){
                        let penjelasanArea = document.getElementById('penjelasan-' + index);
                        let isBenar = res.benar;
                        let kunci = res.kunci;
                        let noSoal = no;
                        let penjelasan = res.penjelasan;
                        penjelasanArea.innerHTML =
                            `<span class="badge warna-label ${isBenar ? 'green-card':'red-card'} mb-1">Jawaban ${isBenar ? 'Benar':'Salah'} ${isBenar ? '✔':'✖'}</span>
                            <span class="badge warna-label yellow-card mb-1">Kunci Jawaban: ${kunci.toUpperCase()}</span>
                            <div class="card card-body border-info bg-light d-flex align-items-center gap-3">
                                <span>${penjelasan}
                                <button type="button" onclick="playPenjelasanAudio(${noSoal}, this, ${isBenar ? 'true' : 'false'})" class="btn btn-audio ms-2">🔊</button>
                                <audio id="audio-penjelasan-${noSoal}" src="<?php echo e(asset('sounds/materi/hal10/')); ?>/${isBenar ? 'benar' : 'salah'}${noSoal}.mp3"></audio>
                                </span>
                            </div>`;
                        let allAnswered = true;
                        for(let i=0;i<totalSoal;i++){
                            if(!document.querySelector('input[name="jawaban_'+i+'"]:checked')) {
                                allAnswered = false;
                                break;
                            }
                        }
                        if (allAnswered) {
                            window.location.reload();
                            return;
                        }
                        let nextUnanswered = null;
                        for (let i = 0; i < totalSoal; i++) {
                            let isAnswered = document.querySelector('input[name="jawaban_'+i+'"]:checked');
                            if (!isAnswered) {
                                nextUnanswered = i + 1;
                                break;
                            }
                        }
                        if (nextUnanswered) {
                            showStep(nextUnanswered);
                        }
                    });
                });
            });
        });
    }
});

// Popup feedback audio
function showFeedbackPopupAudio(no, benar, feedback, kunci, afterContent, afterAudio) {
    let popup = document.getElementById('popup-feedback');
    let popupImg = document.getElementById('popup-img');
    let popupJudul = document.getElementById('popup-judul');
    let popupText = document.getElementById('popup-text');
    let popupKunci = document.getElementById('popup-kunci');
    let popupAudio = document.getElementById('popup-audio');
    popupImg.src = benar
        ? '<?php echo e(asset('images/materi/ayo-berlatih-2/benar.png')); ?>'
        : '<?php echo e(asset('images/materi/ayo-berlatih-2/salah.png')); ?>';
    popupJudul.innerText = feedback.judul;
    popupText.innerText = feedback.text;
    popupKunci.innerHTML = `Kunci Jawaban: <b>${kunci}</b>`;
    let audioSrc = benar
        ? `<?php echo e(asset('sounds/materi/hal10/benar')); ?>` + no + `.mp3`
        : `<?php echo e(asset('sounds/materi/hal10/salah')); ?>` + no + `.mp3`;
    popupAudio.src = audioSrc;
    popupAudio.currentTime = 0;
    popup.style.display = 'flex';
    popupAudio.play();
    if(typeof afterContent === 'function'){
        setTimeout(afterContent, 700);
    }
    popupAudio.onended = function () {
        popup.style.display = 'none';
        if(typeof afterAudio === 'function') afterAudio();
    };
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman10.blade.php ENDPATH**/ ?>