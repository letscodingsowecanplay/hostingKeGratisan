

<?php $__env->startSection('content'); ?>
<div class="materi-main-container fs-5" id="halaman15-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Ayo Mencoba
    </div>

    <?php
        $soal = [
            1 => ['gambar' => 'soal1.png', 'teks' => 'Tinggi wadai cincin setara dengan 3 stik es krim.'],
            2 => ['gambar' => 'soal2.png', 'teks' => 'Panjang diameter buah asam payak setara dengan 1 koin.'],
            3 => ['gambar' => 'soal3.png', 'teks' => 'Panjang buah ulin setara dengan 9 kotak.'],
            4 => ['gambar' => 'soal4.png', 'teks' => 'Panjang tempat penyimpanan gaharu setara dengan 1 pensil.'],
        ];
        $penjelasan = [
            1 => [
                'benar' => 'Jawaban benar. Tinggi wadai cincin memang tidak setara dengan 3 stik es krim.',
                'salah' => 'Jawaban salah. Tinggi wadai cincin pada gambar tidak sama dengan 3 stik es krim.'
            ],
            2 => [
                'benar' => 'Jawaban benar. Diameter buah asam payak pada gambar tepat sama dengan 1 koin.',
                'salah' => 'Jawaban salah. Diameter buah asam payak sebenarnya tepat sama dengan 1 koin.'
            ],
            3 => [
                'benar' => 'Jawaban benar. Panjang buah ulin di gambar tidak setara dengan 9 kotak.',
                'salah' => 'Jawaban salah. Panjang buah ulin pada gambar tidak setara dengan 9 kotak.'
            ],
            4 => [
                'benar' => 'Jawaban benar. Panjang tempat penyimpanan gaharu pada gambar sama dengan 1 pensil.',
                'salah' => 'Jawaban salah. Panjang tempat penyimpanan gaharu sebenarnya sama dengan 1 pensil.'
            ]
        ];
        $totalSoal = count($soal);
        $kkm = $kkm ?? 70;
        $firstUnanswered = 1;
        for($i=1;$i<=$totalSoal;$i++){ if(empty($jawabanUser['soal'.$i])) { $firstUnanswered = $i; break; } }
        $sudahMenjawab = count($jawabanUser) === $totalSoal;
        $kunci = $kunci ?? [];
        $skor = $skor ?? 0;
    ?>

    <div id="popup-feedback" style="display:none; position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:1000; background:rgba(40,75,99,.13); align-items:center;justify-content:center;">
        <div style="background:#fff; border-radius:16px; box-shadow:0 7px 38px #2223; padding:32px 38px; max-width:400px; width:98vw; text-align:center; position:relative;">
            <img id="popup-img" src="" style="max-width:110px; max-height:110px; margin-bottom:13px; border-radius:14px; box-shadow:0 3px 15px #0002;">
            <h4 id="popup-judul" style="font-weight:700;"></h4>
            <p id="popup-text" style="font-size:1.1rem;margin-bottom:2px;"></p>
            <div style="margin:7px auto 0 auto; font-size:1.1rem;" id="popup-kunci"></div>
        </div>
        <audio id="popup-audio" src=""></audio>
    </div>

    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label green-card mb-2" style="font-size:1rem;">Contoh Soal</div>
        <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-1" data-playing="false">🔊</button>
        <audio id="audio-index-1" src="<?php echo e(asset('sounds/materi/hal15/1.mp3')); ?>"></audio>
        <div class="materi-content mb-2">
            Amati video berikut dengan saksama!
        </div>
        <div class="materi-image-row justify-content-center mb-2">
            <div class="w-100" style="max-width: 600px;">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.youtube.com/embed/OYAGCtF3xi4?si=Gi9JwxQX7neGxrBq?end=223&rel=0"
                        title="Video Contoh Soal"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
        <div class="materi-section" style="margin-bottom: 0;">
            <div class="kearifan-box" style="background: #fffde7; border-left: 5px solid #ffb300; padding: 16px 18px; border-radius: 10px; font-size: 1.06em; color: #775b08; margin-bottom: 18px; box-shadow: 0 2px 8px #ffb30018;">
                <strong style="font-size:1.1em;">Ingatlah!</strong>
                <br>
                Alat ukur yang digunakan harus lebih kecil dari benda yang akan diukur. Dengan begitu, kita bisa menghitung berapa banyak alat ukur yang diperlukan untuk mengetahui ukuran tersebut.
                <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-4" data-playing="false" style="margin-left:7px;">🔊</button>
                <audio id="audio-index-4" src="<?php echo e(asset('sounds/materi/hal15/4.mp3')); ?>"></audio>
            </div>
        </div>
        <div class="materi-content">
            Setelah menonton video, lihat gambar dan bacalah pernyataannya. Hitung alat ukur pada gambar. Geser kotak kecil ke kiri jika menurutmu salah, atau ke kanan jika menurutmu benar.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-2" data-playing="false">🔊</button>
            <audio id="audio-index-2" src="<?php echo e(asset('sounds/materi/hal15/2.mp3')); ?>"></audio>
        </div>
        <div class="materi-image-row justify-content-center mb-2">
            <div class="materi-caption text-center mb-2">Tinggi tapai di dalam wadah tersebut setara dengan 3 klip kertas.</div>
            <div class="materi-image-col" style="max-width:330px">
                <img src="<?php echo e(asset('images/materi/ayo-mencoba-3/contoh.png')); ?>"
                     class="img-fluid materi-img rounded-4"
                     alt="Contoh Soal"
                     style="max-width:300px;cursor:pointer;"
                     data-bs-toggle="tooltip"
                     data-bs-placement="top"
                     title="Tinggi tapai di dalam wadah setara dengan 3 klip kertas." />
            </div>
        </div>
        <div class="d-flex justify-content-center mb-2">
            <div style="width: 200px; height: 20px; background: #f1f1f1; border-radius: 8px; position: relative;">
                <span style="position: absolute; left:0; top:25px; font-size:13px; color:#b91c1c; font-weight:500;">Salah</span>
                <span style="position: absolute; right:0; top:25px; font-size:13px; color:#388e3c; font-weight:500;">Benar</span>
                <div style="position: absolute; left: 170px; top: -8px;">
                    <div style="width: 32px; height: 36px; background: #d0ebc6; border-radius: 8px; display: flex; align-items: center; justify-content: center; box-shadow: 1px 1px 3px #bbb;">
                        <span style="font-size: 12px; font-weight: bold; color: #388e3c;">benar</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="slider-instruction-box mb-2 px-3 py-2 rounded" style="background:#f8f9fa;border:1px solid #e0e0e0;display:inline-block;">
                <span class="text-muted" style="font-size:15px;">
                    <strong>Geser ke kiri</strong> untuk <span class="text-danger fw-bold">Salah</span>, <strong>ke kanan</strong> untuk <span class="text-success fw-bold">Benar</span>
                </span>
            </div>
        </div>
        <p class="text-muted text-center mb-1"><small>Jawaban: <strong>Benar</strong></small></p>
        <p class="materi-content">Penyelesaian: <br>Pernyataan yang diberikan sudah sesuai dengan apa yang ada di dalam gambar. Jadi, jawaban yang benar adalah Benar.</p>
    </div>

    <div class="materi-section">
        <div class="d-flex align-items-center mb-3 fs-5">
            <span class="warna-label green-card">Ayo Mencoba</span>
            <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-3" data-playing="false">🔊</button>
            <audio id="audio-index-3" src="<?php echo e(asset('sounds/materi/hal15/3.mp3')); ?>"></audio>
        </div>
        <p class="fs-5">Amati gambar berikut dengan saksama! Bacalah pernyataan yang diberikan. Hitung alat ukur yang ada pada gambar. Setelah itu, geser kotak kecil ke kiri jika menurutmu salah, atau ke kanan jika menurutmu benar.</p>
    </div>

    <?php if(!$sudahMenjawab): ?>
    <div id="stepper-soal">
        <div class="d-flex justify-content-center gap-2 mb-2">
            <?php for($no = 1; $no <= $totalSoal; $no++): ?>
                <button type="button"
                    class="btn btn-outline-primary px-3 py-1 stepper-btn <?php if($no === $firstUnanswered): ?> btn-primary <?php endif; ?>"
                    onclick="showStep(<?php echo e($no); ?>)"
                    id="btn-stepper-<?php echo e($no); ?>">
                    Soal <?php echo e($no); ?>

                </button>
            <?php endfor; ?>
        </div>
    </div>
    <?php for($no = 1; $no <= $totalSoal; $no++): ?>
        <?php
            $userJawab = $jawabanUser['soal'.$no] ?? null;
            $kunciJawab = $kunci['soal'.$no] ?? null;
            $isAnswered = !empty($userJawab);
            $isCorrect = $userJawab === $kunciJawab;
            $explain = $isCorrect ? $penjelasan[$no]['benar'] : $penjelasan[$no]['salah'];
        ?>
        <div class="materi-section shadow-sm rounded-3 py-3 px-3 soal-step" id="soal-step-<?php echo e($no); ?>" style="<?php if($no !== $firstUnanswered): ?>display:none;<?php endif; ?>;background:#fff;">
            <div class="materi-content fw-bold mb-2" style="font-size:1.09rem;">
                <?php echo e($no); ?>. <?php echo e($soal[$no]['teks']); ?>

                <button type="button" onclick="toggleAudio(this)" class="btn-audio" title="Dengarkan" data-id="hal15-<?php echo e($no); ?>" data-playing="false">🔊</button>
                <audio id="hal15-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal15/hal15-' . $no . '.mp3')); ?>"></audio>
            </div>
            <div class="materi-image-row justify-content-center mb-2">
                <div class="materi-image-col" style="max-width:330px">
                    <img src="<?php echo e(asset('images/materi/ayo-mencoba-3/' . $soal[$no]['gambar'])); ?>" class="img-fluid materi-img rounded-4" alt="Soal <?php echo e($no); ?>" style="max-width:300px;">
                </div>
            </div>
            <?php if(!$isAnswered): ?>
                <div class="d-flex justify-content-center mb-2" style="position:relative;">
                    <div style="width: 200px; height: 20px; background: #f1f1f1; border-radius: 8px; position: relative;">
                        <span style="position: absolute; left:0; top:25px; font-size:13px; color:#b91c1c; font-weight:500;">Salah</span>
                        <span style="position: absolute; right:0; top:25px; font-size:13px; color:#388e3c; font-weight:500;">Benar</span>
                        <div id="slider-<?php echo e($no); ?>" style="position: absolute; left:0; right:0; top:0; bottom:0; z-index:2;"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="slider-instruction-box mb-2 px-3 py-2 rounded" style="background:#f8f9fa;border:1px solid #e0e0e0;display:inline-block;">
                        <span class="text-muted" style="font-size:15px;">
                            <strong>Geser ke kiri</strong> untuk <span class="text-danger fw-bold">Salah</span>, <strong>ke kanan</strong> untuk <span class="text-success fw-bold">Benar</span>
                        </span>
                    </div>
                </div>
                <input type="hidden" name="jawaban[soal<?php echo e($no); ?>]" id="input-soal<?php echo e($no); ?>" required>
            <?php else: ?>
                <div id="penjelasan-<?php echo e($no); ?>" class="mt-2">
                    <div class="soal-tooltip-review-row">
                        <div class="soal-tooltip-jawaban-wrap">
                            <span class="soal-tooltip-label-salah">Salah</span>
                            <span class="soal-tooltip-label-benar">Benar</span>
                            <div class="soal-tooltip-indikator <?php echo e($userJawab === 'benar' ? 'benar' : 'salah'); ?>">
                                <div class="soal-tooltip-badge <?php echo e($userJawab === 'benar' ? 'benar' : 'salah'); ?>">
                                    <?php echo e($userJawab ?? '-'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="soal-tooltip-jawaban-kunci-row">
                        <span class="badge warna-label yellow-card">
                            Kunci Jawaban: <?php echo e(ucfirst($kunciJawab)); ?>

                        </span>
                    </div>
                    <div class="card card-body mt-2 border-info bg-light d-flex align-items-center gap-3"
                        style="border:2px solid <?php echo e($isCorrect ? '#47cc69' : '#e74c3c'); ?>; background:<?php echo e($isCorrect ? '#eafaf3' : '#fff5f5'); ?>; color:<?php echo e($isCorrect ? '#169652' : '#b22727'); ?>;">
                        <span><?php echo $explain; ?>

                            <button type="button" onclick="playPenjelasanAudio(<?php echo e($no); ?>, this, <?php echo e($isCorrect ? 'true' : 'false'); ?>)" class="btn btn-audio ms-2">🔊</button>
                            <audio id="audio-penjelasan-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal15/' . ($isCorrect ? 'benar' : 'salah') . $no . '.mp3')); ?>"></audio>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(!$isAnswered): ?>
                <div id="penjelasan-<?php echo e($no); ?>" class="mt-2"></div>
            <?php endif; ?>
        </div>
    <?php endfor; ?>
    <?php endif; ?>

    

    <?php if($sudahMenjawab): ?>
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
                <?php
                    $userJawab = $jawabanUser['soal'.$no] ?? null;
                    $kunciJawab = $kunci['soal'.$no] ?? null;
                    $isCorrect = $userJawab === $kunciJawab;
                    $explain = $isCorrect ? $penjelasan[$no]['benar'] : $penjelasan[$no]['salah'];
                ?>
                <div class="materi-section shadow-sm rounded-3 py-3 px-3 review-step" id="review-step-<?php echo e($no); ?>" style="<?php if($no>1): ?>display:none;<?php endif; ?>;background:#fff;">
                    <div class="materi-content fw-bold mb-2" style="font-size:1.09rem;">
                        <?php echo e($no); ?>. <?php echo e($soal[$no]['teks']); ?>

                        <button type="button" onclick="toggleAudio(this)" class="btn-audio" title="Dengarkan" data-id="hal15-<?php echo e($no); ?>" data-playing="false">🔊</button>
                        <audio id="hal15-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal15/hal15-' . $no . '.mp3')); ?>"></audio>
                    </div>
                    <div class="materi-image-row justify-content-center mb-2">
                        <div class="materi-image-col" style="max-width:330px">
                            <img src="<?php echo e(asset('images/materi/ayo-mencoba-3/' . $soal[$no]['gambar'])); ?>" class="img-fluid materi-img rounded-4" alt="Soal <?php echo e($no); ?>" style="max-width:300px;">
                        </div>
                    </div>
                    <div class="soal-tooltip-review-row">
                        <div class="soal-tooltip-jawaban-wrap">
                            <span class="soal-tooltip-label-salah">Salah</span>
                            <span class="soal-tooltip-label-benar">Benar</span>
                            <div class="soal-tooltip-indikator <?php echo e($userJawab === 'benar' ? 'benar' : 'salah'); ?>">
                                <div class="soal-tooltip-badge <?php echo e($userJawab === 'benar' ? 'benar' : 'salah'); ?>">
                                    <?php echo e($userJawab ?? '-'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="soal-tooltip-jawaban-kunci-row">
                        <span class="badge warna-label yellow-card">
                            Kunci Jawaban: <?php echo e(ucfirst($kunciJawab)); ?>

                        </span>
                    </div>
                    <div class="card card-body mt-2 border-info bg-light d-flex align-items-center gap-3"
                         style="border:2px solid <?php echo e($isCorrect ? '#47cc69' : '#e74c3c'); ?>; background:<?php echo e($isCorrect ? '#eafaf3' : '#fff5f5'); ?>; color:<?php echo e($isCorrect ? '#169652' : '#b22727'); ?>;">
                        <span><?php echo $explain; ?>

                            <button type="button" onclick="playPenjelasanAudio(<?php echo e($no); ?>, this, <?php echo e($isCorrect ? 'true' : 'false'); ?>)" class="btn btn-audio ms-2">🔊</button>
                            <audio id="audio-penjelasan-<?php echo e($no); ?>" src="<?php echo e(asset('sounds/materi/hal15/' . ($isCorrect ? 'benar' : 'salah') . $no . '.mp3')); ?>"></audio>
                        </span>
                    </div>
                </div>
            <?php endfor; ?>
            <div id="skor-kkm-area" style="margin-top:10px;">
                <?php if($skor < $kkm): ?>
                    <form action="<?php echo e(route('admin.materi.halaman15.reset')); ?>" method="POST" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger fs-5">Ulangi Kuis</button>
                    </form><br>
                    <div class="text-center flex-grow-1">
                        <div class="alert alert-info d-inline-block mb-0">
                            Nilai Anda: <?php echo e($skor); ?> / 100
                        </div>
                    </div><br>
                    <div class="alert alert-warning mt-3">
                        Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
                    </div>
                <?php else: ?>
                    <div class="text-center flex-grow-1">
                        <div class="alert alert-info d-inline-block mb-0">
                            Nilai Anda: <?php echo e($skor); ?> / 100
                        </div>
                    </div>
                    <div class="alert alert-success mt-3">
                        Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="materi-nav-footer mt-3">
        <a href="<?php echo e(route('admin.materi.halaman14')); ?>" class="btn btn-nav fs-5">← Sebelumnya</a>
        <?php if($sudahMenjawab && $skor >= $kkm): ?>
            <a href="<?php echo e(route('admin.materi.halaman16')); ?>" class="btn btn-nav btn-next fs-5">Selanjutnya →</a>
        <?php else: ?>
            <button class="btn btn-nav btn-next fs-5" disabled>Selanjutnya →</button>
        <?php endif; ?>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.css">
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.js"></script>
<script>
let sudahMenjawab = <?php echo json_encode($sudahMenjawab, 15, 512) ?>;
let kunciJawaban = <?php echo json_encode($kunci, 15, 512) ?>;
let totalSoal = <?php echo e($totalSoal); ?>;
let firstUnanswered = <?php echo e($firstUnanswered); ?>;
let jawabanUser = <?php echo json_encode($jawabanUser ?? [], 15, 512) ?>;
let penjelasanBlade = <?php echo json_encode($penjelasan, 15, 512) ?>;

function showStep(no) {
    for (let i = 1; i <= totalSoal; i++) {
        let el = document.getElementById('soal-step-' + i);
        if(el) el.style.display = (i === no ? '' : 'none');
        let btn = document.getElementById('btn-stepper-' + i);
        if(btn) btn.classList.toggle('btn-primary', i === no);
    }
    localStorage.setItem('hal15_last_soal', no);
}

function findNextUnanswered(jawabanUserObj) {
    for(let i=1; i<=totalSoal; i++) {
        if(!jawabanUserObj['soal'+i]) return i;
    }
    return null;
}

function showFeedbackPopup(feedback, idx, benar) {
    let popup = document.getElementById('popup-feedback');
    document.getElementById('popup-img').src = benar
        ? "<?php echo e(asset('images/materi/ayo-berlatih-3/benar.png')); ?>"
        : "<?php echo e(asset('images/materi/ayo-berlatih-3/salah.png')); ?>";
    document.getElementById('popup-judul').innerText = feedback.judul;
    document.getElementById('popup-text').innerText = feedback.text;
    document.getElementById('popup-kunci').innerHTML = `Kunci Jawaban: <b>${feedback.kunci}</b>`;
    let audio = document.getElementById('popup-audio');
    audio.src = '<?php echo e(asset('sounds/materi/hal15/')); ?>/' + (benar ? 'benar' : 'salah') + idx + '.mp3';
    audio.currentTime = 0;
    popup.style.display = 'flex';
    audio.play();
    audio.onended = function () {
        popup.style.display = 'none';
        let nextIdx = window._nextSoalAfterPopup;
        if(nextIdx) {
            showStep(nextIdx);
            window._nextSoalAfterPopup = null;
        }
    };
}

function afterJawab(res, idx, val) {
    let slider = document.getElementById('slider-'+idx);
    if(slider && slider.noUiSlider) slider.setAttribute('disabled', 'true');
    // Render review style di penjelasan-idx (replace), hanya sekali (tidak dobel!)
    let penjelasan = document.getElementById('penjelasan-' + idx);
    if (penjelasan) {
        let isCorrect = res.benar;
        let kunciJawab = res.kunci;
        let userJawab = val;
        let explain = res.penjelasan;
        penjelasan.innerHTML = `
            <div class="soal-tooltip-review-row">
                <div class="soal-tooltip-jawaban-wrap">
                    <span class="soal-tooltip-label-salah">Salah</span>
                    <span class="soal-tooltip-label-benar">Benar</span>
                    <div class="soal-tooltip-indikator ${userJawab === 'benar' ? 'benar' : 'salah'}">
                        <div class="soal-tooltip-badge ${userJawab === 'benar' ? 'benar' : 'salah'}">
                            ${userJawab ?? '-'}
                        </div>
                    </div>
                </div>
            </div>
            <div class="soal-tooltip-jawaban-kunci-row">
                <span class="badge warna-label yellow-card">
                    Kunci Jawaban: ${kunciJawab.charAt(0).toUpperCase() + kunciJawab.slice(1)}
                </span>
            </div>
            <div class="card card-body mt-2 border-info bg-light d-flex align-items-center gap-3"
                style="border:2px solid ${isCorrect ? '#47cc69' : '#e74c3c'}; background:${isCorrect ? '#eafaf3' : '#fff5f5'}; color:${isCorrect ? '#169652' : '#b22727'};">
                <span>${explain}
                    <button type="button" onclick="playPenjelasanAudio(${idx}, this, ${isCorrect})" class="btn btn-audio ms-2">🔊</button>
                    <audio id="audio-penjelasan-${idx}" src="<?php echo e(asset('sounds/materi/hal15/')); ?>/${isCorrect ? 'benar' : 'salah'}${idx}.mp3"></audio>
                </span>
            </div>
        `;
    }
}

function showReviewSoal(no){
    document.querySelectorAll('.review-step').forEach(function(el, i){
        el.style.display = (i+1)==no ? '' : 'none';
    });
    for(let i=1;i<=totalSoal;i++){
        let btn = document.getElementById('btn-review-'+i);
        if(btn) btn.classList.toggle('btn-primary', i===no);
    }
    localStorage.setItem('hal15_last_review', no);
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

function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById('audio-' + id);
    document.querySelectorAll('audio').forEach(a => {
        if (a !== audio && a.id !== 'bg-music') {
            if (a.id !== 'bg-music') { a.pause(); a.currentTime = 0; }
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

document.addEventListener("DOMContentLoaded", function () {
    if (sudahMenjawab) {
        let reviewLast = parseInt(localStorage.getItem('hal15_last_review') || "1");
        showReviewSoal(isNaN(reviewLast)?1:reviewLast);
        return;
    }
    let lastStep = parseInt(localStorage.getItem('hal15_last_soal') || firstUnanswered);
    let nextUnanswered = findNextUnanswered(jawabanUser);
    if (nextUnanswered) showStep(nextUnanswered);
    else showStep(1);

    for (let i = 1; i <= totalSoal; i++) {
        const sliderBox = document.getElementById('slider-' + i);
        const input = document.getElementById('input-soal' + i);
        let isAnswered = jawabanUser['soal'+i];
        if (sliderBox && input && !isAnswered) {
            noUiSlider.create(sliderBox, {
                start: 0.5,
                step: 0.5,
                connect: [true, false],
                range: { min: 0, max: 1 },
                format: {
                    to: val => (val == 1 ? 'benar' : (val == 0 ? 'salah' : '')),
                    from: val => val === 'benar' ? 1 : (val === 'salah' ? 0 : 0.5)
                }
            });
            sliderBox.noUiSlider.on('update', function (values, handle) {
                if(values[handle] == '' || values[handle] == 'undefined') input.value = '';
            });
            sliderBox.noUiSlider.on('set', function (values, handle) {
                if (sliderBox.getAttribute('disabled') === 'true') return;
                let val = values[handle];
                if (val !== 'benar' && val !== 'salah') return;
                input.value = val;
                fetch("<?php echo e(route('admin.materi.halaman15.jawab')); ?>", {
                    method: 'POST',
                    headers: { 'Content-Type':'application/json','X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                    body: JSON.stringify({ soal: i, jawaban: val })
                })
                .then(res => res.json())
                .then(res => {
                    if (!res.success) {
                        alert(res.msg ?? 'Terjadi kesalahan!');
                        sliderBox.noUiSlider.set(0.5);
                        return;
                    }
                    jawabanUser['soal'+i] = val;
                    let nextIdx = findNextUnanswered(jawabanUser);
                    window._nextSoalAfterPopup = (res.semua_sudah || nextIdx === null) ? null : nextIdx;
                    showFeedbackPopup(res.feedback, i, res.benar);
                    setTimeout(() => { afterJawab(res, i, val); }, 300);
                    if(res.semua_sudah || nextIdx === null) {
                        setTimeout(()=>{ window.location.reload(); }, 1200);
                    }
                    else {
                        localStorage.setItem('hal15_last_soal', nextIdx);
                    }
                });
            });
        }
        // Render ulang penjelasan jika sudah dijawab (review style), hanya jika <div id="penjelasan-i"> kosong!
        if (isAnswered) {
            let penjelasan = document.getElementById('penjelasan-' + i);
            if (penjelasan && !penjelasan.innerHTML.trim()) {
                let userJawab = jawabanUser['soal'+i];
                let kunciJawab = kunciJawaban['soal'+i];
                let isCorrect = userJawab === kunciJawab;
                let text = isCorrect ? penjelasanBlade[i]['benar'] : penjelasanBlade[i]['salah'];
                penjelasan.innerHTML = `
                    <div class="soal-tooltip-review-row">
                        <div class="soal-tooltip-jawaban-wrap">
                            <span class="soal-tooltip-label-salah">Salah</span>
                            <span class="soal-tooltip-label-benar">Benar</span>
                            <div class="soal-tooltip-indikator ${userJawab === 'benar' ? 'benar' : 'salah'}">
                                <div class="soal-tooltip-badge ${userJawab === 'benar' ? 'benar' : 'salah'}">
                                    ${userJawab ?? '-'}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="soal-tooltip-jawaban-kunci-row">
                        <span class="badge warna-label yellow-card">
                            Kunci Jawaban: ${kunciJawab.charAt(0).toUpperCase() + kunciJawab.slice(1)}
                        </span>
                    </div>
                    <div class="card card-body mt-2 border-info bg-light d-flex align-items-center gap-3"
                        style="border:2px solid ${isCorrect ? '#47cc69' : '#e74c3c'}; background:${isCorrect ? '#eafaf3' : '#fff5f5'}; color:${isCorrect ? '#169652' : '#b22727'};">
                        <span>${text}
                            <button type="button" onclick="playPenjelasanAudio(${i}, this, ${isCorrect})" class="btn btn-audio ms-2">🔊</button>
                            <audio id="audio-penjelasan-${i}" src="<?php echo e(asset('sounds/materi/hal15/')); ?>/${isCorrect ? 'benar' : 'salah'}${i}.mp3"></audio>
                        </span>
                    </div>
                `;
            }
        }
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/materi/halaman15.blade.php ENDPATH**/ ?>