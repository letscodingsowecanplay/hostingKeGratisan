@extends('layouts.master')
@section('content')
@php
    $penjelasan = [
        1 => [
            'benar' => 'Tinggi guci yang diukur menggunakan pensil sebagai satuan tidak baku sudah tepat, karena jumlah pensil yang digunakan sesuai dengan tinggi objek.',
            'salah' => 'Jawaban kurang tepat. Hitung kembali jumlah pensil yang digunakan untuk mengukur tinggi guci agar sesuai dengan objek pada gambar.'
        ],
        2 => [
            'benar' => 'Patung bekantan mini sudah diukur dengan stik es krim secara tepat. Jumlah stik es krim yang disusun sama dengan tinggi patung pada gambar.',
            'salah' => 'Jawaban kurang tepat. Pastikan jumlah stik es krim yang digunakan untuk mengukur patung sama dengan tinggi patung pada gambar.'
        ],
        3 => [
            'benar' => 'Pengukuran miniatur tugu pal 17 dengan kotak sudah sesuai. Jumlah kotak yang digunakan sama dengan tinggi miniatur.',
            'salah' => 'Jawaban kurang tepat. Silakan hitung ulang jumlah kotak yang digunakan agar sesuai dengan tinggi miniatur tugu pada gambar.'
        ],
        4 => [
            'benar' => 'Kerupuk basah kapuas sudah diukur menggunakan penghapus secara akurat, jumlah penghapus sama dengan lebar objek pada gambar.',
            'salah' => 'Jawaban kurang tepat. Perhatikan jumlah penghapus yang dibutuhkan untuk mengukur lebar kerupuk basah pada gambar.'
        ],
        5 => [
            'benar' => 'Dodol asli kandangan sudah diukur dengan korek api secara benar. Jumlah korek api sesuai dengan panjang objek pada gambar.',
            'salah' => 'Jawaban kurang tepat. Coba ulangi dan hitung jumlah korek api yang digunakan agar sama dengan panjang dodol pada gambar.'
        ],
    ];
    $audioPenjelasan = [
        1 => asset('sounds/materi/hal16/penjelasan_1.mp3'),
        2 => asset('sounds/materi/hal16/penjelasan_2.mp3'),
        3 => asset('sounds/materi/hal16/penjelasan_3.mp3'),
        4 => asset('sounds/materi/hal16/penjelasan_4.mp3'),
        5 => asset('sounds/materi/hal16/penjelasan_5.mp3'),
    ];
    $audioFeedback = [
        1 => ['benar' => asset('sounds/materi/hal16/feedback_benar_1.mp3'), 'salah' => asset('sounds/materi/hal16/feedback_salah_1.mp3')],
        2 => ['benar' => asset('sounds/materi/hal16/feedback_benar_2.mp3'), 'salah' => asset('sounds/materi/hal16/feedback_salah_2.mp3')],
        3 => ['benar' => asset('sounds/materi/hal16/feedback_benar_3.mp3'), 'salah' => asset('sounds/materi/hal16/feedback_salah_3.mp3')],
        4 => ['benar' => asset('sounds/materi/hal16/feedback_benar_4.mp3'), 'salah' => asset('sounds/materi/hal16/feedback_salah_4.mp3')],
        5 => ['benar' => asset('sounds/materi/hal16/feedback_benar_5.mp3'), 'salah' => asset('sounds/materi/hal16/feedback_salah_5.mp3')],
    ];
    $soalList = [
        1 => ['gambar' => 'benda0.png', 'satuan' => 'pensil',      'jawaban' => 5, 'orientasi' => 'vertikal',   'kalimat' => 'Ukur guci peninggalan zaman dahulu di Kalimantan menggunakan pensil sebagai satuan tidak baku untuk mengetahui tingginya.'],
        2 => ['gambar' => 'benda1.png', 'satuan' => 'stik-eskrim', 'jawaban' => 5, 'orientasi' => 'vertikal',   'custom_class' => 'custom-drop-2', 'kalimat' =>'Ukur patung bekantan mini menggunakan stik es krim sebagai satuan tidak baku untuk mengetahui tingginya.'],
        3 => ['gambar' => 'benda2.png', 'satuan' => 'kotak',       'jawaban' => 4, 'orientasi' => 'vertikal',   'custom_class' => 'custom-drop-3', 'kalimat' => 'Ukur miniatur tugu pal 17 menggunakan kotak sebagai satuan tidak baku untuk mengetahui tingginya.'],
        4 => ['gambar' => 'benda3.png', 'satuan' => 'penghapus',   'jawaban' => 7, 'orientasi' => 'horizontal', 'custom_class' => 'custom-drop-4', 'kalimat' => 'Ukur kerupuk basah kapuas menggunakan penghapus sebagai satuan tidak baku untuk mengetahui lebarnya. '],
        5 => ['gambar' => 'benda4.png', 'satuan' => 'korek-api',   'jawaban' => 7, 'orientasi' => 'horizontal', 'custom_class' => 'custom-drop-5', 'kalimat' => 'Ukur dodol asli kandangan menggunakan korek api sebagai satuan tidak baku untuk mengetahui lebarnya. '],
    ];
    $jumlahSoal = 5;
    $firstUnanswered = 1;
    for($i=1;$i<=$jumlahSoal;$i++){ if(empty($jawabanUser['soal'.$i])) { $firstUnanswered = $i; break; } }
@endphp

<div class="materi-main-container fs-5" id="halaman16-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Ayo Berlatih
    </div>
    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label orange-card mb-2" style="font-size:1rem;">Ayo Berlatih</div>
        <div class="materi-content mb-3">
            Amati gambar berikut dengan saksama! Susunlah benda-benda berikut untuk mengukur suatu objek secara tepat menggunakan satuan tidak baku!
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal16/1.mp3') }}"></audio>
            <br>
            <span class="fw-semibold mt-1 d-block">Petunjuk:</span>
            <ul class="materi-list">
                <li>Klik benda yang disediakan sebagai satuan tidak baku.</li>
                <li>Seret dan letakkan benda tersebut ke area dropzone pada objek yang akan diukur secara tepat dan sesuai.</li>
            </ul>
        </div>

        {{-- STEP SOAL --}}
        <div id="stepper-soal-container" class="mb-4" @if($sudahMenjawab) style="display:none;" @endif>
            <div class="d-flex justify-content-center gap-2 mb-2" id="stepper-soal">
                @for ($no = 1; $no <= $jumlahSoal; $no++)
                    <button type="button"
                        class="btn btn-outline-primary px-3 py-1 stepper-btn @if($no === $firstUnanswered) btn-primary @endif"
                        onclick="renderSoal({{ $no }})"
                        id="btn-stepper-{{ $no }}">
                        Soal {{ $no }}
                    </button>
                @endfor
            </div>
        </div>

        <form id="kuisForm" autocomplete="off" @if($sudahMenjawab) style="display:none;" @endif>
            @csrf
            <input type="hidden" id="currentSoal" name="currentSoal" value="{{ $firstUnanswered }}">
            <input type="hidden" name="jawabanSiswa" id="jawabanSiswaInput">
            <div id="soalArea"></div>
        </form>

        <div id="reviewArea" class="mt-4" @if(!$sudahMenjawab) style="display:none;" @endif></div>
        <form action="{{ route('admin.materi.halaman16.reset') }}" method="POST" class="mt-3" id="formResetKuis" style="display:none;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger fs-5">Ulangi Kuis</button>
        </form>
        <div id="alertHasilKuis"></div>
    </div>

    <div class="materi-nav-footer mt-3">
        <a href="{{ route('admin.materi.halaman15') }}" class="btn btn-nav fs-5" style="min-width:160px;">← Sebelumnya</a>
        @if($sudahMenjawab && $skor >= $kkm)
            <a href="{{ route('admin.evaluasi.petunjuk') }}" class="btn btn-nav btn-next fs-5" style="min-width:160px;">Selanjutnya →</a>
        @else
            <button class="btn btn-nav btn-next fs-5" style="min-width:160px; opacity:.6; pointer-events:none;">Selanjutnya →</button>
        @endif
    </div>
</div>
<br>
<!-- POPUP FEEDBACK -->
<div id="popupFeedback" style="display:none;position:fixed;z-index:9001;top:0;left:0;width:100vw;height:100vh;justify-content:center;align-items:center;background:rgba(32,32,32,0.12);">
    <div style="background:#fff;border-radius:22px;box-shadow:0 6px 26px #0001;max-width:90vw;width:350px;padding:32px 28px 24px 28px;text-align:center;position:relative;">
        <img id="popupImg" src="" style="width:88px;margin-bottom:14px;">
        <div id="popupText" style="font-size:1.18rem;font-weight:700;color:#222;"></div>
        <audio id="popupFeedbackAudio"></audio>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="{{ asset('css/dragdrop.css') }}">
<script>
const soalList = @json($soalList);
const penjelasan = @json($penjelasan);
const audioPenjelasan = @json($audioPenjelasan);
const audioFeedback = @json($audioFeedback);
const jumlahSoal = {{ $jumlahSoal }};
const kunci = {1:5,2:5,3:4,4:7,5:7};
let jawabanUser = @json($jawabanUser ?? []);
let skorRes = {{ $skor ?? 0 }};
let statusKkmRes = "{{ $status ?? '' }}";
let kkmValue = {{ $kkm ?? 60 }};
let sudahMenjawab = {{ $sudahMenjawab ? 'true' : 'false' }};
let currentNo = {{ $firstUnanswered }};

function renderSoal(no) {
    for(let i=1;i<=jumlahSoal;i++){
        let btn = document.getElementById('btn-stepper-'+i);
        if(btn) btn.classList.toggle('btn-primary', i === no);
    }
    document.getElementById('currentSoal').value = no;
    let soal = soalList[no];
    let orientasi = soal.orientasi;
    let custom_class = soal.custom_class || '';
    let satuan = soal.satuan;
    let gambar = soal.gambar;
    let kalimat = soal.kalimat;
    let maxItems = soal.jawaban;
    let jawabanTersimpan = jawabanUser['soal'+no] || '';
    let sudahDiisi = !!jawabanTersimpan;

    let html = `
    <div class="mb-5 soal-ayo-berlatih" id="blokSoal${no}">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="warna-label ${['green-card','yellow-card','blue-card','orange-card','purple-card'][(no-1)%5]}" style="font-size:1rem;">
                ${no}
            </div>
            <div class="materi-content fw-bold" style="font-size:1.09rem; margin-bottom:0;">
                ${kalimat}
                <button type="button" onclick="toggleAudio(this)" class="btn-audio" title="Dengarkan" data-id="hal16-${no}" data-playing="false">🔊</button>
                <audio id="audio-hal16-${no}" src="{{ asset('sounds/materi/hal16/hal16-') }}${no}.mp3"></audio>
            </div>
        </div>
        <div class="text-center mb-2">
            <div class="gambar-wrapper" style="position:relative;">
                <img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${gambar}" class="gambar-soal">
                <div class="drop-zone ${orientasi} ${custom_class}" id="drop-area-${no}"
                    data-soal="${no}"
                    data-max="${maxItems}"
                    data-orientasi="${orientasi}">
                </div>
            </div>
            <input type="hidden" name="jawaban[soal${no}]" id="jawabanDrop${no}" value="${jawabanTersimpan}">
        </div>
        <div class="text-center mb-2">
            <p><strong>Satuan: ${satuan.replace('-',' ')}</strong></p>
            <div class="satuan-area" id="satuan-area-${no}">
                ${[...Array(10)].map((_,i)=>`
                    <div class="satuan-slot" data-slot="${i+1}">
                        <img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${satuan}.png"
                            class="alat-satuan shadow mb-1"
                            draggable="true"
                            id="alat-${no}-${i+1}"
                            data-soal="${no}"
                            data-index="${i+1}">
                    </div>
                `).join('')}
            </div>
            <button type="button" class="btn btn-success btn-periksa-jawaban mt-2" data-soal="${no}" ${sudahDiisi?'disabled':''}>Periksa</button>
        </div>
        <div class="text-center mt-3 area-feedback" id="areaFeedback${no}" style="display:${sudahDiisi?'':'none'};"></div>
    </div>`;
    document.getElementById('soalArea').innerHTML = html;
    setDragDrop(no);

    document.querySelector('.btn-periksa-jawaban').addEventListener('click', function(){
        periksaSoal(no);
    });

    // Jika sudah menjawab tampilkan feedback di panel soal
    if (sudahDiisi) {
        showPenjelasanSetelahPeriksa(no);
    }
}

function setDragDrop(no){
    let dragged = null;
    let draggedSlot = null;
    document.querySelectorAll(`#blokSoal${no} .alat-satuan[draggable="true"]`).forEach(function (el) {
        el.addEventListener('dragstart', function (e) {
            dragged = el;
            draggedSlot = el.parentNode;
            setTimeout(() => { el.style.visibility = "hidden"; }, 1);
        });
        el.addEventListener('dragend', function (e) {
            if (dragged) dragged.style.visibility = "visible";
            dragged = null;
            draggedSlot = null;
        });
    });
    let zone = document.getElementById('drop-area-'+no);
    let maxItems = parseInt(zone.getAttribute('data-max'), 10);
    zone.addEventListener('dragover', function (e) {
        e.preventDefault();
    });
    zone.addEventListener('drop', function (e) {
        e.preventDefault();
        if (!dragged) return;
        if (dragged.getAttribute('data-soal') != no) return;
        let count = zone.querySelectorAll('img.alat-satuan:not(.opacity-50)').length;
        if (count >= maxItems) return;
        if (draggedSlot && draggedSlot.classList.contains('satuan-slot')) {
            draggedSlot.innerHTML = '';
            draggedSlot.classList.add('empty');
        }
        let clone = dragged.cloneNode(true);
        clone.removeAttribute('id');
        clone.setAttribute('draggable', false);
        clone.classList.add('mb-1');
        clone.style.visibility = "visible";
        zone.appendChild(clone);
        document.getElementById('jawabanDrop'+no).value = count + 1;
    });
}

function showFeedback(benar, penjelasanText, gambar, audioUrl) {
    let popup = document.getElementById('popupFeedback');
    document.getElementById('popupText').innerHTML = penjelasanText;
    document.getElementById('popupImg').src = gambar;
    let audio = document.getElementById('popupFeedbackAudio');
    if(audioUrl){
        audio.src = audioUrl;
        audio.currentTime = 0; audio.play();
    } else {
        audio.pause(); audio.src = '';
    }
    popup.style.display = 'flex';
    setTimeout(() => { popup.style.display = 'none'; audio.pause(); }, 1700);
    audio.onended = function () { popup.style.display = 'none'; };
}

function periksaSoal(no){
    let jawaban = parseInt(document.getElementById('jawabanDrop'+no).value || 0);
    let benar = jawaban === kunci[no];
    let img = benar ? "{{ asset('images/feedback/benar.png') }}" : "{{ asset('images/feedback/salah.png') }}";
    let audioUrl = audioFeedback[no][benar ? 'benar' : 'salah'];
    showFeedback(benar, penjelasan[no][benar ? 'benar' : 'salah'], img, audioUrl);
    jawabanUser['soal'+no] = jawaban;
    setTimeout(() => {
        showPenjelasanSetelahPeriksa(no);

        // Cari soal berikutnya yang belum dijawab
        let next = findNextUnanswered();
        setTimeout(()=>{
            if(next === null){
                document.getElementById('jawabanSiswaInput').value = JSON.stringify(jawabanUser);
                kirimJawabanDanTampilkanHasil();
            } else {
                renderSoal(next);
            }
        }, 900);
    }, 1700);
}

function showPenjelasanSetelahPeriksa(no) {
    let jawaban = parseInt(jawabanUser['soal'+no]||0);
    let benar = jawaban == kunci[no];
    let area = document.getElementById('areaFeedback'+no);
    area.innerHTML =
        `<div class="explain-alert mt-2 mx-auto" style="max-width:420px; border-radius:10px; padding:12px; font-weight:500; border:2px solid ${benar ? '#47cc69' : '#e74c3c'}; background:${benar ? '#eafaf3' : '#fff5f5'}; color:${benar ? '#169652' : '#b22727'};">
            <span style="font-size:1.1em;">${benar ? '✔️ Benar!' : '❌ Salah.'}</span><br>
            <b>Jawaban Kamu:</b> ${jawaban} satuan<br>
            <b>Kunci:</b> ${kunci[no]} satuan<br>
            <b>Penjelasan:</b> ${penjelasan[no][benar ? 'benar' : 'salah']}
            <button type="button" onclick="playPenjelasanAudio(${no}, this)" class="btn btn-audio ms-2">🔊</button>
            <audio id="audio-penjelasan-${no}" src="${audioPenjelasan[no]}"></audio>
        </div>`;
    area.style.display = '';
    document.querySelector(`#blokSoal${no} .drop-zone`).style.pointerEvents = 'none';
    document.querySelector(`#blokSoal${no} .btn-periksa-jawaban`).disabled = true;
}

function findNextUnanswered(){
    for(let i=1;i<=jumlahSoal;i++){
        if(!jawabanUser['soal'+i]) return i;
    }
    return null;
}

function kirimJawabanDanTampilkanHasil() {
    let data = new FormData();
    data.append('_token', document.querySelector('input[name="_token"]').value);
    let jawaban = jawabanUser;
    for(let i=1;i<=jumlahSoal;i++){
        data.append('jawaban[soal'+i+']', jawaban['soal'+i]||'');
    }
    fetch("{{ route('admin.materi.halaman16.simpan') }}", {
        method: 'POST',
        body: data,
    })
    .then(res => res.json())
    .then(json => {
        skorRes = json.skor || 0;
        statusKkmRes = json.status;
        kkmValue = json.kkm || 60;
        sudahMenjawab = true;
        document.getElementById('kuisForm').style.display = 'none';
        document.getElementById('stepper-soal-container').style.display = 'none';
        renderReviewPanel(1);
    })
    .catch(e=>{
        alert('Gagal menyimpan nilai. Silakan refresh halaman.');
    });
    document.querySelectorAll('button, input, .btn-periksa-jawaban').forEach(e=>e.disabled=true);
}

function renderReviewPanel(selected=1) {
    // STEP 1: Stepper yang sama dengan latihan (bukan bulat, style sama!)
    let navHtml = '<div class="d-flex justify-content-center gap-2 mb-2" id="stepper-review">';
    for (let i = 1; i <= jumlahSoal; i++) {
        navHtml += `<button type="button"
            class="btn btn-outline-primary px-3 py-1 stepper-btn${selected==i?' btn-primary':''}"
            onclick="showReviewSoal(${i})"
            id="btn-review-${i}">Soal ${i}</button>`;
    }
    navHtml += '</div>';

    // Skor & status
    let hasil = `
        <div class="alert alert-info d-inline-block mb-0">
            Skor Anda: ${skorRes} / 100
        </div><br>
        <div class="alert ${statusKkmRes === 'lulus' ? 'alert-success' : 'alert-warning'} mt-3">
            ${statusKkmRes === 'lulus'
                ? 'Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.'
                : 'Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.'}
        </div>`;

    // Semua panel review soal, 1 aktif sisanya hidden
    let semuaSoalReview = '';
    for(let i=1; i<=jumlahSoal; i++){
        let soal = soalList[i];
        let jawaban = (jawabanUser && jawabanUser['soal'+i]) ? parseInt(jawabanUser['soal'+i]) : 0;
        let benar = jawaban == kunci[i];
        let satuan = soal.satuan;
        semuaSoalReview += `
        <div class="panel-review-soal" id="panelReviewSoal${i}" style="display:${selected==i?'':'none'};">
            <div class="mb-3 text-center">
                <div class="gambar-wrapper" style="position:relative;">
                    <img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${soal.gambar}" class="gambar-soal">
                    <div class="drop-zone ${soal.orientasi} ${soal.custom_class||''}" style="pointer-events:none;">
                        ${[...Array(jawaban>0?jawaban:0)].map(()=>
                            `<img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${satuan}.png" class="alat-satuan shadow mb-1" style="border:2px solid ${benar?'#4caf50':'#e53935'};" draggable="false">`
                        ).join('')}
                    </div>
                </div>
            </div>
            <div class="text-center mt-2 area-feedback">
                <div class="explain-alert mx-auto" style="max-width:420px; border-radius:10px; padding:12px; font-weight:500; border:2px solid ${benar ? '#47cc69' : '#e74c3c'}; background:${benar ? '#eafaf3' : '#fff5f5'}; color:${benar ? '#169652' : '#b22727'};">
                    <span style="font-size:1.1em;">${benar ? '✔️ Benar!' : '❌ Salah.'}</span><br>
                    <b>Jawaban Kamu:</b> ${jawaban} satuan<br>
                    <b>Kunci:</b> ${kunci[i]} satuan<br>
                    <b>Penjelasan:</b> ${penjelasan[i][benar ? 'benar' : 'salah']}
                    <button type="button" onclick="playPenjelasanAudio(${i}, this)" class="btn btn-audio ms-2">🔊</button>
                    <audio id="audio-penjelasan-${i}" src="${audioPenjelasan[i]}"></audio>
                </div>
            </div>
        </div>
        `;
    }

    document.getElementById('soalArea').innerHTML = '';
    document.getElementById('reviewArea').innerHTML = hasil + navHtml + semuaSoalReview;
    document.getElementById('reviewArea').style.display = '';

    // Tampilkan/hidden tombol ulangi hanya kalau tidak lulus
    if(statusKkmRes === 'lulus'){
        document.getElementById('formResetKuis').style.display = 'none';
    } else {
        document.getElementById('formResetKuis').style.display = '';
    }
}

// Stepper review tombol update
function showReviewSoal(no){
    for(let i=1; i<=jumlahSoal; i++){
        let reviewPanel = document.getElementById('panelReviewSoal'+i);
        let btn = document.getElementById('btn-review-'+i);
        if(reviewPanel) reviewPanel.style.display = (i===no)?'':'none';
        if(btn) btn.className = "btn btn-outline-primary px-3 py-1 stepper-btn"+(i===no?' btn-primary':'');
    }
}

// --- audio ---
function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);
    document.querySelectorAll('audio').forEach(a => {
        if (a !== audio) { a.pause(); a.currentTime = 0; }
    });
    document.querySelectorAll('button[data-id]').forEach(btn => {
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

document.addEventListener("DOMContentLoaded", function () {
    if(sudahMenjawab && Object.keys(jawabanUser).length > 0) {
        // Sembunyikan stepper soal, tampilkan review
        document.getElementById('stepper-soal-container').style.display = 'none';
        renderReviewPanel(1);
    } else {
        document.getElementById('stepper-soal-container').style.display = '';
        document.getElementById('reviewArea').style.display = 'none';
        renderSoal(currentNo);
    }
});
</script>
@endpush
