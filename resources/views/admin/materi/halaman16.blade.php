@extends('layouts.master')
@section('content')
@php
    $penjelasan = [
        1 => [
            'benar' => 'Jawaban benar. Tinggi guci yang diukur menggunakan pensil sebagai satuan tidak baku sudah tepat, karena jumlah pensil yang digunakan sesuai dengan tinggi objek.',
            'salah' => 'Jawaban salah. Hitung kembali jumlah pensil yang digunakan untuk mengukur tinggi guci agar sesuai dengan objek pada gambar.'
        ],
        2 => [
            'benar' => 'Jawaban benar. Patung bekantan mini sudah diukur dengan stik es krim secara tepat. Jumlah stik es krim yang disusun sama dengan tinggi patung pada gambar.',
            'salah' => 'Jawaban salah. Pastikan jumlah stik es krim yang digunakan untuk mengukur patung sama dengan tinggi patung pada gambar.'
        ],
        3 => [
            'benar' => 'Jawaban benar. Pengukuran miniatur tugu pal 17 dengan kotak sudah sesuai. Jumlah kotak yang digunakan sama dengan tinggi miniatur.',
            'salah' => 'Jawaban salah. Silakan hitung ulang jumlah kotak yang digunakan agar sesuai dengan tinggi miniatur tugu pada gambar.'
        ],
        4 => [
            'benar' => 'Jawaban benar. Kerupuk basah kapuas sudah diukur menggunakan penghapus secara akurat, jumlah penghapus sama dengan lebar objek pada gambar.',
            'salah' => 'Jawaban salah. Perhatikan jumlah penghapus yang dibutuhkan untuk mengukur lebar kerupuk basah pada gambar.'
        ],
        5 => [
            'benar' => 'Jawaban benar. Dodol asli kandangan sudah diukur dengan korek api secara benar. Jumlah korek api sesuai dengan panjang objek pada gambar.',
            'salah' => 'Jawaban salah. Coba ulangi dan hitung jumlah korek api yang digunakan agar sama dengan panjang dodol pada gambar.'
        ],
    ];
    $soalList = [
        1 => ['gambar' => 'benda0.png', 'satuan' => 'pensil',      'jawaban' => 5, 'orientasi' => 'vertikal',   'dropzone' => 'guci',      'kalimat' => 'Ukur guci peninggalan zaman dahulu di Kalimantan menggunakan pensil sebagai satuan tidak baku untuk mengetahui tingginya.'],
        2 => ['gambar' => 'benda1.png', 'satuan' => 'stik-eskrim', 'jawaban' => 5, 'orientasi' => 'vertikal',   'dropzone' => 'bekantan',  'kalimat' =>'Ukur patung bekantan mini menggunakan stik es krim sebagai satuan tidak baku untuk mengetahui tingginya.'],
        3 => ['gambar' => 'benda2.png', 'satuan' => 'kotak',       'jawaban' => 4, 'orientasi' => 'vertikal',   'dropzone' => 'tugu',      'kalimat' => 'Ukur miniatur tugu pal 17 menggunakan kotak sebagai satuan tidak baku untuk mengetahui tingginya.'],
        4 => ['gambar' => 'benda3.png', 'satuan' => 'penghapus',   'jawaban' => 7, 'orientasi' => 'horizontal', 'dropzone' => 'kerupuk',   'kalimat' => 'Ukur kerupuk basah kapuas menggunakan penghapus sebagai satuan tidak baku untuk mengetahui lebarnya. '],
        5 => ['gambar' => 'benda4.png', 'satuan' => 'korek-api',   'jawaban' => 7, 'orientasi' => 'horizontal', 'dropzone' => 'dodol-coklat','kalimat' => 'Ukur dodol asli kandangan menggunakan korek api sebagai satuan tidak baku untuk mengetahui lebarnya. '],
    ];
    $jumlahSoal = 5;
    $audioPenjelasan = [
        1 => ['benar' => asset('sounds/materi/hal16/benar1.mp3'),  'salah' => asset('sounds/materi/hal16/salah1.mp3')],
        2 => ['benar' => asset('sounds/materi/hal16/benar2.mp3'),  'salah' => asset('sounds/materi/hal16/salah2.mp3')],
        3 => ['benar' => asset('sounds/materi/hal16/benar3.mp3'),  'salah' => asset('sounds/materi/hal16/salah3.mp3')],
        4 => ['benar' => asset('sounds/materi/hal16/benar4.mp3'),  'salah' => asset('sounds/materi/hal16/salah4.mp3')],
        5 => ['benar' => asset('sounds/materi/hal16/benar5.mp3'),  'salah' => asset('sounds/materi/hal16/salah5.mp3')],
    ];
    $audioFeedback = $audioPenjelasan;
    $firstUnanswered = 1;
    for($i=1;$i<=$jumlahSoal;$i++){ if(empty($jawabanUser['soal'.$i])) { $firstUnanswered = $i; break; } }
@endphp

<div class="materi-main-container fs-5" id="halaman16-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Ayo Berlatih
    </div>
    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
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
        <div class="mb-4" id="stepper-soal-container" style="{{ count($jawabanUser ?? []) === $jumlahSoal ? 'display:none;' : '' }}">
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
        <form id="kuisForm" autocomplete="off" style="{{ count($jawabanUser ?? []) === $jumlahSoal ? 'display:none;' : '' }}">
            @csrf
            <input type="hidden" id="currentSoal" name="currentSoal" value="{{ $firstUnanswered }}">
            <input type="hidden" name="jawabanSiswa" id="jawabanSiswaInput">
            <div id="soalArea"></div>
        </form>
        <div id="reviewArea" class="mt-4" style="{{ count($jawabanUser ?? []) === $jumlahSoal ? '' : 'display:none;' }}"></div>
        <form action="{{ route('admin.materi.halaman16.reset') }}" method="POST" class="mt-3 text-center" id="formResetKuis" style="display:none;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger fs-5" id="btn-reset-kuis">Ulangi Soal</button>
        </form>
        <div id="alertHasilKuis"></div>
    </div>
    <div class="materi-nav-footer mt-3">
        <a href="{{ route('admin.materi.halaman15') }}" class="btn btn-nav" style="min-width:160px;">← Sebelumnya</a>
        @if($sudahMenjawab && $skor >= $kkm)
            <a href="{{ route('admin.evaluasi.petunjuk') }}" class="btn btn-nav btn-next" style="min-width:160px;">Selanjutnya →</a>
        @else
            <button class="btn btn-nav btn-next" style="min-width:160px; opacity:.6; pointer-events:none;">Selanjutnya →</button>
        @endif
    </div>
</div>
<br>
<div id="popupFeedback" style="display:none;position:fixed;z-index:9001;top:0;left:0;width:100vw;height:100vh;justify-content:center;align-items:center;background:rgba(32,32,32,0.12);">
    <div style="background:#fff;border-radius:22px;box-shadow:0 6px 26px #0001;max-width:90vw;width:350px;padding:32px 28px 24px 28px;text-align:center;position:relative;">
        <img id="popupImg" src="" style="width:88px;margin-bottom:14px;">
        <div id="popupText" style="font-size:1.07rem;font-weight:500;color:#222;line-height:1.5;"></div>
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
let currentNo = {{ $firstUnanswered }};

/**
 * Pause semua audio materi, kecuali bg-music dan audio yang sedang akan play
 */
function pauseAllMateriAudio(exceptAudio = null) {
    document.querySelectorAll('audio').forEach(function(a){
        if (a !== exceptAudio && a.id !== 'bg-music') {
            a.pause();
            a.currentTime = 0;
        }
    });
}

function renderSoal(no) {
    for(let i=1;i<=jumlahSoal;i++){
        let btn = document.getElementById('btn-stepper-'+i);
        if(btn) btn.classList.toggle('btn-primary', i === no);
    }
    document.getElementById('currentSoal').value = no;
    let soal = soalList[no];
    let orientasi = soal.orientasi;
    let dropzoneClass = soal.dropzone;
    let satuan = soal.satuan;
    let gambar = soal.gambar;
    let kalimat = soal.kalimat;
    let maxItems = soal.jawaban;
    let jawabanTersimpan = jawabanUser['soal'+no] || '';
    let sudahDiisi = !!jawabanTersimpan;
    let alatSatuanClass = orientasi === 'horizontal' ? 'alat-satuan-horizontal' : 'alat-satuan-vertikal';

    let dropzoneIsi = '';
    let borderReview = '';
    if (sudahDiisi) {
        let jwb = parseInt(jawabanTersimpan) || 0;
        let benar = jwb === kunci[no];
        let border = benar ? '#47cc69' : '#e74c3c';
        dropzoneIsi = [...Array(jwb)].map(() =>
            `<img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${satuan}.png" class="alat-satuan shadow ${alatSatuanClass}" draggable="false" style="border:2px solid ${border};">`
        ).join('');
        borderReview = `border: 2.4px solid ${border} !important;`;
    }

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
        <div>
            <div class="gambar-wrapper">
                <img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${gambar}" class="gambar-soal">
                <div class="drop-zone ${orientasi} ${dropzoneClass}" id="drop-area-${no}"
                    data-soal="${no}"
                    data-max="${maxItems}"
                    data-orientasi="${orientasi}"
                    style="${borderReview}">
                    ${dropzoneIsi}
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
                            class="alat-satuan shadow mb-1 ${alatSatuanClass}"
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
    if (sudahDiisi) { showPenjelasanSetelahPeriksa(no);}
}

/** PATCH: drag drop support mobile + desktop tanpa mengubah tampilan **/
function setDragDrop(no){
    let dragged = null;
    let draggedSlot = null;
    let isTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);

    // Desktop: standar drag-n-drop
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

    zone.addEventListener('dragover', function (e) { e.preventDefault(); });
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

    // MOBILE: touch-based drag-n-drop fallback
    if(isTouch){
        document.querySelectorAll(`#blokSoal${no} .alat-satuan[draggable="true"]`).forEach(function(el){
            let startX, startY, origParent;
            let isDragging = false;
            let ghost = null;
            el.addEventListener('touchstart', function(e){
                if (el.parentNode.classList.contains('satuan-slot') && el.parentNode.classList.contains('empty')) return;
                isDragging = true;
                dragged = el;
                draggedSlot = el.parentNode;
                origParent = el.parentNode;
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;

                // Ghost image
                ghost = el.cloneNode(true);
                ghost.style.position = 'fixed';
                ghost.style.pointerEvents = 'none';
                ghost.style.zIndex = 10001;
                ghost.style.left = (startX-30)+'px';
                ghost.style.top = (startY-30)+'px';
                ghost.style.width = el.offsetWidth + 'px';
                ghost.style.opacity = 0.7;
                document.body.appendChild(ghost);
            });
            el.addEventListener('touchmove', function(e){
                if(!isDragging || !ghost) return;
                e.preventDefault();
                let moveX = e.touches[0].clientX;
                let moveY = e.touches[0].clientY;
                ghost.style.left = (moveX-30)+'px';
                ghost.style.top = (moveY-30)+'px';
            }, {passive:false});
            el.addEventListener('touchend', function(e){
                if(!isDragging) return;
                isDragging = false;
                if(ghost){
                    // Cek overlap dropzone
                    let touch = e.changedTouches[0];
                    let dz = document.getElementById('drop-area-'+no);
                    let rect = dz.getBoundingClientRect();
                    if(
                        touch.clientX >= rect.left && touch.clientX <= rect.right &&
                        touch.clientY >= rect.top && touch.clientY <= rect.bottom
                    ){
                        let count = dz.querySelectorAll('img.alat-satuan:not(.opacity-50)').length;
                        if(count < maxItems){
                            if (draggedSlot && draggedSlot.classList.contains('satuan-slot')) {
                                draggedSlot.innerHTML = '';
                                draggedSlot.classList.add('empty');
                            }
                            let clone = el.cloneNode(true);
                            clone.removeAttribute('id');
                            clone.setAttribute('draggable', false);
                            clone.classList.add('mb-1');
                            clone.style.visibility = "visible";
                            dz.appendChild(clone);
                            document.getElementById('jawabanDrop'+no).value = count + 1;
                        }
                    }
                    document.body.removeChild(ghost);
                    ghost = null;
                }
                dragged = null; draggedSlot = null;
            });
        });
    }
}

function periksaSoal(no){
    let jawaban = parseInt(document.getElementById('jawabanDrop'+no).value || 0);
    let benar = jawaban === kunci[no];
    let img = benar ? "{{ asset('images/materi/ayo-berlatih-3/benar.png') }}" : "{{ asset('images/materi/ayo-berlatih-3/salah.png') }}";
    let audioUrl = audioFeedback[no][benar ? 'benar' : 'salah'];
    jawabanUser['soal'+no] = jawaban;

    // SIMPAN JAWABAN KE DB
    let data = new FormData();
    data.append('_token', document.querySelector('input[name="_token"]').value);
    data.append('soal', no);
    data.append('jawaban', jawaban);
    fetch("{{ route('admin.materi.halaman16.simpan') }}", {
        method: 'POST',
        body: data,
    })
    .then(res => res.json())
    .then(json => {
        let semuaSudah = (json.jumlah_dijawab >= jumlahSoal);
        showFeedback(
            benar,
            `<div>
                <div style="font-size:1.17em;font-weight:700; color:${benar ? '#169652' : '#b22727'};">
                    ${benar ? '✔️ Benar!' : '❌ Salah.'}
                </div>
                <div style="margin-top:8px;">
                    <b>Jawaban Kamu:</b> ${jawaban} satuan<br>
                    <b>Kunci:</b> ${kunci[no]} satuan
                </div>
                <div style="margin-top:10px;">${penjelasan[no][benar ? 'benar' : 'salah']}</div>
            </div>`,
            img, audioUrl, function(){
                showPenjelasanSetelahPeriksa(no);

                let next = findNextUnanswered();
                setTimeout(()=>{
                    if(next === null && semuaSudah){
                        document.getElementById('kuisForm').style.display = 'none';
                        document.getElementById('stepper-soal-container').style.display = 'none';
                        renderReviewPanel(1);
                    } else if (next !== null) {
                        renderSoal(next);
                    }
                }, 220);
            }
        );
    });
}

function showFeedback(benar, penjelasanText, gambar, audioUrl, callback) {
    let popup = document.getElementById('popupFeedback');
    document.getElementById('popupText').innerHTML = penjelasanText;
    document.getElementById('popupImg').src = gambar;
    let audio = document.getElementById('popupFeedbackAudio');
    popup.style.display = 'flex';
    if(audioUrl){
        audio.src = audioUrl;
        pauseAllMateriAudio(audio); // hanya feedback audio yg play
        audio.currentTime = 0; audio.play();
        audio.onended = function () {
            popup.style.display = 'none';
            audio.onended = null;
            if (typeof callback === 'function') callback();
        };
    } else {
        setTimeout(() => {
            popup.style.display = 'none';
            if (typeof callback === 'function') callback();
        }, 1800);
    }
}

function showPenjelasanSetelahPeriksa(no) {
    let jawaban = parseInt(jawabanUser['soal'+no]||0);
    let benar = jawaban == kunci[no];
    let area = document.getElementById('areaFeedback'+no);
    let border = benar ? '#47cc69' : '#e74c3c';

    let zone = document.getElementById('drop-area-'+no);
    let soal = soalList[no];
    let alatSatuanClass = soal.orientasi === 'horizontal' ? 'alat-satuan-horizontal' : 'alat-satuan-vertikal';
    let alatHtml = '';
    if (jawaban > 0 && zone) {
        alatHtml = [...Array(jawaban)].map(() =>
            `<img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${soal.satuan}.png" class="alat-satuan shadow mb-1 ${alatSatuanClass}" draggable="false" style="border:2px solid ${border};">`
        ).join('');
        zone.innerHTML = alatHtml;
        zone.style.border = `2.4px solid ${border}`;
    }
    let audioSrc = benar ? audioPenjelasan[no]['benar'] : audioPenjelasan[no]['salah'];
    area.innerHTML =
        `<div class="explain-alert mt-2 mx-auto" style="max-width:420px; border-radius:10px; padding:12px; font-weight:500; border:2px solid ${border}; background:${benar ? '#eafaf3' : '#fff5f5'}; color:${benar ? '#169652' : '#b22727'};">
            <span style="font-size:1.1em;">${benar ? '✔️ Benar!' : '❌ Salah.'}</span><br>
            <b>Jawaban Kamu:</b> ${jawaban} satuan<br>
            <b>Kunci:</b> ${kunci[no]} satuan<br>
            <b>Penjelasan:</b> ${penjelasan[no][benar ? 'benar' : 'salah']}
            <button type="button" onclick="playPenjelasanAudio(${no}, this, ${benar ? "'benar'" : "'salah'"})" class="btn btn-audio ms-2">🔊</button>
            <audio id="audio-penjelasan-${no}-${benar ? 'benar' : 'salah'}" src="${audioSrc}"></audio>
        </div>`;
    area.style.display = '';
    if(zone) zone.style.pointerEvents = 'none';
    document.querySelector(`#blokSoal${no} .btn-periksa-jawaban`).disabled = true;
}

function findNextUnanswered(){
    for(let i=1;i<=jumlahSoal;i++){
        if(!jawabanUser['soal'+i]) return i;
    }
    return null;
}

// ----------- REVISI: skor & KKM DI BAWAH REVIEW --------------
function renderReviewPanel(selected=1) {
    let navHtml = '<div class="d-flex justify-content-center gap-2 mb-2" id="stepper-review">';
    for (let i = 1; i <= jumlahSoal; i++) {
        navHtml += `<button type="button"
            class="btn btn-outline-primary px-3 py-1 stepper-btn${selected==i?' btn-primary':''}"
            onclick="showReviewSoal(${i})"
            id="btn-review-${i}">Soal ${i}</button>`;
    }
    navHtml += '</div>';
    let semuaSoalReview = '';
    for(let i=1; i<=jumlahSoal; i++){
        let soal = soalList[i];
        let jawaban = (jawabanUser && jawabanUser['soal'+i]) ? parseInt(jawabanUser['soal'+i]) : 0;
        let benar = jawaban == kunci[i];
        let satuan = soal.satuan;
        let alatSatuanClass = soal.orientasi === 'horizontal' ? 'alat-satuan-horizontal' : 'alat-satuan-vertikal';
        let border = benar ? '#47cc69' : '#e74c3c';
        let audioSrc = benar ? audioPenjelasan[i]['benar'] : audioPenjelasan[i]['salah'];
        semuaSoalReview += `
        <div class="panel-review-soal" id="panelReviewSoal${i}" style="display:${selected==i?'':'none'};">
            <div class="mb-3 text-center">
                <div class="gambar-wrapper" style="position:relative;">
                    <img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${soal.gambar}" class="gambar-soal">
                    <div class="drop-zone ${soal.orientasi} ${soal.dropzone||''}" style="pointer-events:none; border:2.4px solid ${border} !important;">
                        ${[...Array(jawaban>0?jawaban:0)].map(()=>
                            `<img src="{{ asset('images/materi/ayo-berlatih-3/') }}/${satuan}.png" class="alat-satuan shadow mb-1 ${alatSatuanClass}" draggable="false" style="border:2px solid ${border};">`
                        ).join('')}
                    </div>
                </div>
            </div>
            <div class="text-center mt-2 area-feedback">
                <div class="explain-alert mx-auto" style="max-width:420px; border-radius:10px; padding:12px; font-weight:500; border:2px solid ${border}; background:${benar ? '#eafaf3' : '#fff5f5'}; color:${benar ? '#169652' : '#b22727'};">
                    <span style="font-size:1.1em;">${benar ? '✔️ Benar!' : '❌ Salah.'}</span><br>
                    <b>Jawaban Kamu:</b> ${jawaban} satuan<br>
                    <b>Kunci:</b> ${kunci[i]} satuan<br>
                    <b>Penjelasan:</b> ${penjelasan[i][benar ? 'benar' : 'salah']}
                    <button type="button" onclick="playPenjelasanAudio(${i}, this, ${benar ? "'benar'" : "'salah'"})" class="btn btn-audio ms-2">🔊</button>
                    <audio id="audio-penjelasan-${i}-${benar ? 'benar' : 'salah'}" src="${audioSrc}"></audio>
                </div>
            </div>
        </div>
        `;
    }
    // SKOR & KET KKM DI BAWAH
    let hasil = `
        ${navHtml}
        ${semuaSoalReview}
        <div class="mt-4 text-center">
            <div class="alert alert-info d-inline-block mb-0">
                Skor Anda: ${skorRes} / 100
            </div><br>
            <div class="alert ${statusKkmRes === 'lulus' ? 'alert-success' : 'alert-warning'} mt-3">
                ${statusKkmRes === 'lulus'
                    ? 'Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.'
                    : 'Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.'}
            </div>
        </div>
        `;
    document.getElementById('soalArea').innerHTML = '';
    document.getElementById('reviewArea').innerHTML = hasil;
    document.getElementById('reviewArea').style.display = '';
    document.getElementById('formResetKuis').style.display = (statusKkmRes === 'lulus') ? 'none' : '';
    document.getElementById('btn-reset-kuis').disabled = false;
    document.getElementById('formResetKuis').onsubmit = function(e){
        setTimeout(function(){ location.reload(); }, 100);
    }
}
function showReviewSoal(no){
    for(let i=1; i<=jumlahSoal; i++){
        let reviewPanel = document.getElementById('panelReviewSoal'+i);
        let btn = document.getElementById('btn-review-'+i);
        if(reviewPanel) reviewPanel.style.display = (i===no)?'':'none';
        if(btn) btn.className = "btn btn-outline-primary px-3 py-1 stepper-btn"+(i===no?' btn-primary':'');
    }
}
function toggleAudio(button) { 
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);
    pauseAllMateriAudio(audio);
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
function playPenjelasanAudio(no, btn, tipe){ 
    const audio = document.getElementById('audio-penjelasan-' + no + '-' + tipe);
    pauseAllMateriAudio(audio);
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
    if(Object.keys(jawabanUser).length >= jumlahSoal) {
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
