@extends('layouts.master')

@section('content')
<div class="materi-main-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Ayo Berlatih
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="materi-section fs-5">
        <p>
            Amati gambar berikut dengan saksama! Isilah titik-titik di bawah ini menggunakan pilihan kata <strong>panjang</strong>, <strong>pendek</strong>, <strong>tinggi</strong>, atau <strong>rendah</strong> melalui menu dropdown!
            <button onclick="toggleAudio(this)" class="btn-audio ms-2" data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal5/1.mp3') }}"></audio>
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

    @php
        $opsiDropdown = ['panjang', 'pendek', 'tinggi', 'rendah'];
        $totalSoal = 4;
        $firstUnanswered = 1;
        for($i=1;$i<=$totalSoal;$i++){ if(empty($jawabanUser['soal'.$i])) { $firstUnanswered = $i; break; } }
        $penjelasan = [
            1 => [
                'benar' => 'Jawaban kamu benar. Sendok makan memang berukuran pendek daripada sutil.',
                'salah' => 'Jawaban kamu salah. Perhatikan ukuran sendok makan dengan sutil pada gambar.'
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Kotak tisu memang berukuran panjang daripada kotak pensil.',
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
        $kunci = [
            1 => 'pendek',
            2 => 'panjang',
            3 => 'tinggi',
            4 => 'rendah',
        ];
    @endphp

    @if(count($jawabanUser) < $totalSoal)
    <div id="stepper-soal">
        <div class="d-flex justify-content-center gap-2 mb-4">
            @for ($no = 1; $no <= $totalSoal; $no++)
                <button type="button"
                    class="btn btn-outline-primary px-3 py-1 stepper-btn @if($no === $firstUnanswered) btn-primary @endif"
                    onclick="showStep({{ $no }})"
                    id="btn-stepper-{{ $no }}">
                    Soal {{ $no }}
                </button>
            @endfor
        </div>
        @for($no=1; $no<=$totalSoal; $no++)
        <div class="materi-section mb-4 soal-step" id="soal-step-{{ $no }}" style="@if($no !== $firstUnanswered)display:none;@endif">
            <h5 class="mb-2 d-flex align-items-center">
                <span class="warna-label blue-card" style="margin-right:10px;">{{ $no }}</span>
            </h5>
            <div class="row mb-2 align-items-center justify-content-center">
                <div class="col-6 text-center">
                    <img src="{{ asset("images/materi/ayo-berlatih-1/soal{$no}a.png") }}" class="img-fluid rounded shadow"
                         style="max-width:180px; max-height:200px; width:180px; height:180px; object-fit:cover;">
                </div>
                <div class="col-6 text-center">
                    <img src="{{ asset("images/materi/ayo-berlatih-1/soal{$no}b.png") }}" class="img-fluid rounded shadow"
                         style="max-width:180px; max-height:200px; width:180px; height:180px; object-fit:cover;">
                </div>
            </div>
            <p>
                {!! match($no) {
                    1 => 'Sendok makan dari kayu ulin ini berukuran <strong>________</strong> jika dibandingkan sutil dari kayu ulin.',
                    2 => 'Kotak tisu yang terbuat dari batok kelapa ini memiliki ukuran <strong>________</strong> jika dibandingkan kotak pensil kain motif Dayak di sebelahnya.',
                    3 => 'Tugu Obor Api Tabalong yang berada di Kalimantan Selatan ini berukuran <strong>________</strong> jika dibandingkan versi miniaturnya.',
                    4 => 'Miniatur perisai dayak itu sangat <strong>________</strong> jika dibandingkan versi aslinya.',
                } !!}
                <button
                    type="button"
                    onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    title="Dengarkan"
                    data-id="hal5-{{ $no }}"
                    data-playing="false">
                    🔊
                </button>
                <audio id="audio-hal5-{{ $no }}" src="{{ asset('sounds/materi/hal5/hal5-' . $no . '.mp3') }}"></audio>
            </p>
            <div class="d-flex align-items-center gap-2 mb-2">
                <select name="jawaban[soal{{ $no }}]" class="form-select soal-dropdown" id="dropdown-{{ $no }}" data-no="{{ $no }}"
                    @if(isset($jawabanUser['soal'.$no])) disabled @endif
                    required style="max-width: 200px;">
                    <option value="">-- Pilih jawaban --</option>
                    @foreach($opsiDropdown as $opsi)
                        <option value="{{ $opsi }}" @if(($jawabanUser['soal'.$no] ?? old("jawaban.soal$no")) == $opsi) selected @endif>{{ ucfirst($opsi) }}</option>
                    @endforeach
                </select>
                <audio id="audio-dropdown-{{ $no }}" src=""></audio>
            </div>
            {{-- Penjelasan langsung muncul jika sudah menjawab --}}
            @php
                $userAnswer = $jawabanUser['soal'.$no] ?? null;
                $kunciJawab = $kunci[$no] ?? null;
                $isCorrect = $userAnswer === $kunciJawab;
                $explainType = $isCorrect ? 'benar' : 'salah';
            @endphp
            <div id="penjelasan-{{ $no }}">
            @if($userAnswer)
                <span class="badge warna-label {{ $isCorrect ? 'green-card' : 'red-card' }} mb-1">
                    Jawaban {{ $isCorrect ? 'Benar' : 'Salah' }} {!! $isCorrect ? '<span style="font-size:1.15em;vertical-align:middle;">✔</span>' : '<span style="font-size:1.15em;vertical-align:middle;">✖</span>' !!}
                </span>
                <div class="card card-body border-info bg-light mt-2">
                    <span>
                        {!! $penjelasan[$no][$explainType] ?? '' !!}
                        <button type="button" onclick="playPenjelasanAudio({{ $no }}, this)" class="btn btn-audio ms-2">
                            🔊
                        </button>
                        <audio id="audio-penjelasan-{{ $no }}" src=""></audio>
                    </span>
                </div>
                <div class="mt-1"><span class="badge warna-label blue-card">Kunci Jawaban: {{ ucfirst($kunciJawab) }}</span></div>
            @endif
            </div>
        </div>
        @endfor
        <div class="materi-nav-footer" style="margin-top:24px;">
            <a href="{{ route('admin.materi.halaman4') }}" class="btn-nav" style="min-width:160px">← Sebelumnya</a>
            <button class="btn-nav btn-next" style="min-width:160px; opacity:0.6; pointer-events:none;">Selanjutnya →</button>
        </div>
    </div>
    @endif

    @if(count($jawabanUser) === $totalSoal)
        <div id="review-area">
            <div class="text-center mb-3">
                <h4 class="fw-bold">Review Jawabanmu</h4>
            </div>
            <div class="mb-3 d-flex justify-content-center gap-2">
                @for($no=1;$no<=$totalSoal;$no++)
                <button type="button" class="btn btn-outline-primary px-3 py-1" onclick="showReviewSoal({{ $no }})" id="btn-review-{{ $no }}">
                    Soal {{ $no }}
                </button>
                @endfor
            </div>
            @for($no=1;$no<=$totalSoal;$no++)
            <div class="materi-section mb-5 fs-5 review-step" id="review-step-{{ $no }}" style="@if($no>1)display:none;@endif">
                <h5 class="mb-2 d-flex align-items-center">
                    <span class="warna-label blue-card" style="margin-right:10px;">{{ $no }}</span>
                </h5>
                <div class="row mb-2 align-items-center justify-content-center">
                    <div class="col-6 text-center">
                        <img src="{{ asset("images/materi/ayo-berlatih-1/soal{$no}a.png") }}" class="img-fluid rounded shadow"
                             style="max-width:180px; max-height:200px; width:180px; height:180px; object-fit:cover;">
                    </div>
                    <div class="col-6 text-center">
                        <img src="{{ asset("images/materi/ayo-berlatih-1/soal{$no}b.png") }}" class="img-fluid rounded shadow"
                             style="max-width:180px; max-height:200px; width:180px; height:180px; object-fit:cover;">
                    </div>
                </div>
                <p>
                    {!! match($no) {
                        1 => 'Sendok nasi dari kayu ulin ini berukuran <strong>________</strong> jika dibandingkan sutil dari kayu ulin.',
                        2 => 'Kotak tisu yang terbuat dari batok kelapa ini memiliki ukuran <strong>________</strong> jika dibandingkan kotak pensil kain motif Dayak di sebelahnya.',
                        3 => 'Tugu Obor Api Tabalong yang berada di Kalimantan Selatan ini berukuran <strong>________</strong> jika dibandingkan versi miniaturnya.',
                        4 => 'Miniatur perisai dayak itu sangat <strong>________</strong> jika dibandingkan versi aslinya.',
                    } !!}
                </p>
                <div class="mb-2">
                    @php
                        $userAnswer = $jawabanUser['soal'.$no] ?? null;
                        $kunciJawab = $kunci[$no] ?? null;
                        $isCorrect = $userAnswer === $kunciJawab;
                        $explainType = $isCorrect ? 'benar' : 'salah';
                    @endphp
                    <div class="mb-2" style="max-width: 210px;">
                        <select class="form-select" disabled>
                            @foreach($opsiDropdown as $opsi)
                                <option value="{{ $opsi }}" @if($userAnswer == $opsi) selected @endif>{{ ucfirst($opsi) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="badge warna-label {{ $isCorrect ? 'green-card' : 'red-card' }} mb-1">
                        Jawaban {{ $isCorrect ? 'Benar' : 'Salah' }}
                        @if($isCorrect)
                            <span style="font-size:1.15em;vertical-align:middle;">✔</span>
                        @else
                            <span style="font-size:1.15em;vertical-align:middle;">✖</span>
                        @endif
                    </span>
                    <div class="card card-body border-info bg-light mt-2">
                        <span>{!! $penjelasan[$no][$explainType] ?? '' !!}
                        <button type="button" onclick="playPenjelasanAudio({{ $no }}, this)" class="btn btn-audio ms-2">
                            🔊
                        </button>
                        <audio id="audio-penjelasan-{{ $no }}" src=""></audio> </span>
                    </div>
                    <div class="mt-1"><span class="badge warna-label blue-card">Kunci Jawaban: {{ ucfirst($kunciJawab) }}</span></div>
                </div>
            </div>
            @endfor
            <div id="skor-kkm-area" style="margin-top:10px;">
                @if($skor < $kkm)
                    <form action="{{ route('admin.materi.halaman5.reset') }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger fs-5">Ulangi Soal</button>
                    </form><br>
                    <div class="text-center flex-grow-1 fs-5">
                        <div id="skor-anda" class="alert alert-info d-inline-block mb-0">
                            Nilai Anda: {{ $skor }} / 100
                        </div>
                    </div>
                    <br>
                    <div class="alert alert-warning mt-3 fs-5">
                        Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
                    </div>
                @else
                    <div class="text-center flex-grow-1 fs-5">
                        <div id="skor-anda" class="alert alert-info d-inline-block mb-0">
                            Nilai Anda: {{ $skor }} / 100
                        </div>
                    </div>
                    <br>
                    <div class="alert alert-success mt-3 fs-5">
                        Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
                    </div>
                @endif
            </div>
            <div class="materi-nav-footer" style="margin-top:32px;">
                <a href="{{ route('admin.materi.halaman4') }}" class="btn-nav" style="min-width:160px;">← Sebelumnya</a>
                @if($skor >= $kkm)
                    <a href="{{ route('admin.materi.halaman6') }}" class="btn-nav btn-next" style="min-width:160px;">Selanjutnya →</a>
                @else
                    <button class="btn-nav btn-next" style="opacity:0.6; pointer-events:none; min-width:160px;">Selanjutnya →</button>
                @endif
            </div>
        </div>
    @endif
</div>
<br>
@endsection

@section('scripts')
<script>
const totalSoal = {{ $totalSoal }};
let currentStep = {{ $firstUnanswered }};
const answered = {!! json_encode($jawabanUser) !!};

function showStep(no) {
    for (let i = 1; i <= totalSoal; i++) {
        document.getElementById('soal-step-' + i).style.display = (i === no ? '' : 'none');
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

function playPenjelasanAudio(no, btn){
    const userAnswer = {!! json_encode($jawabanUser) !!}['soal'+no] || '';
    const kunci = {!! json_encode($kunci) !!}[no] || '';
    const benar = userAnswer === kunci;
    const src = benar
        ? `{{ asset('sounds/materi/hal5/benar') }}` + no + '.mp3'
        : `{{ asset('sounds/materi/hal5/salah') }}` + no + '.mp3';
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

document.addEventListener('DOMContentLoaded', function () {
    @if(count($jawabanUser) < $totalSoal)
    document.querySelectorAll('.soal-dropdown').forEach(function(select){
        select.addEventListener('change', function(){
            let no = parseInt(this.getAttribute('data-no'));
            let value = this.value;
            if (!value) return;
            select.disabled = true;
            const audioEl = document.getElementById('audio-dropdown-' + no);
            const audioPath = `{{ asset('sounds/materi/hal5/') }}/soal${no}-${value}.mp3`;
            audioEl.src = audioPath; audioEl.load();
            document.querySelectorAll('audio').forEach(a => {
                if (
                    a !== audioEl &&
                    a.id !== 'bg-music'
                ) { a.pause(); a.currentTime = 0; }
            });
            audioEl.play();
            audioEl.onended = function() {
                fetch("{{ route('admin.materi.halaman5.jawab') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                    showFeedbackPopupCustom(res, no, function() {
                        fetch('{{ route('admin.materi.halaman5') }}', {headers: {'X-Requested-With': 'XMLHttpRequest'}})
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
                            }, 200);
                        });
                    });
                    setTimeout(() => {
                        // Inject penjelasan area identik dengan review
                        let penjelasanArea = document.getElementById('penjelasan-' + no);
                        if (penjelasanArea) {
                            penjelasanArea.innerHTML =
                                `<span class="badge warna-label ${res.benar ? 'green-card':'red-card'} mb-1">Jawaban ${res.benar ? 'Benar':'Salah'} ${res.benar ? '✔':'✖'}</span>
                                <div class="card card-body border-info bg-light mt-2">
                                    <span>${res.penjelasan}
                                    <button type="button" onclick="playPenjelasanAudio(${no}, this)" class="btn btn-audio ms-2">🔊</button>
                                    <audio id="audio-penjelasan-${no}" src=""></audio>
                                    </span>
                                </div>
                                <div class="mt-1"><span class="badge warna-label blue-card">Kunci Jawaban: ${res.kunci.charAt(0).toUpperCase()+res.kunci.slice(1)}</span></div>`;
                        }
                    }, 200);
                });
            };
            audioEl.onerror = function() {
                fetch("{{ route('admin.materi.halaman5.jawab') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                    showFeedbackPopupCustom(res, no, function() {
                        fetch('{{ route('admin.materi.halaman5') }}', {headers: {'X-Requested-With': 'XMLHttpRequest'}})
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
                            }, 200);
                        });
                    });
                    setTimeout(() => {
                        let penjelasanArea = document.getElementById('penjelasan-' + no);
                        if (penjelasanArea) {
                            penjelasanArea.innerHTML =
                                `<span class="badge warna-label ${res.benar ? 'green-card':'red-card'} mb-1">Jawaban ${res.benar ? 'Benar':'Salah'} ${res.benar ? '✔':'✖'}</span>
                                <div class="card card-body border-info bg-light mt-2">
                                    <span>${res.penjelasan}
                                    <button type="button" onclick="playPenjelasanAudio(${no}, this)" class="btn btn-audio ms-2">🔊</button>
                                    <audio id="audio-penjelasan-${no}" src=""></audio>
                                    </span>
                                </div>
                                <div class="mt-1"><span class="badge warna-label blue-card">Kunci Jawaban: ${res.kunci.charAt(0).toUpperCase()+res.kunci.slice(1)}</span></div>`;
                        }
                    }, 200);
                });
            };
        });
    });
    @endif
});

function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);
    document.querySelectorAll('audio').forEach(a => {
        if (
            a !== audio &&
            a.id !== 'bg-music'
        ) { a.pause(); a.currentTime = 0; }
    });
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

function showFeedbackPopupCustom(res, no, afterClose) {
    let popup = document.getElementById('popup-feedback');
    let popupImg = document.getElementById('popup-img');
    let benar = res.benar === true;
    popupImg.src = benar
        ? '{{ asset('images/materi/ayo-berlatih-1/benar.png') }}'
        : '{{ asset('images/materi/ayo-berlatih-1/salah.png') }}';
    document.getElementById('popup-judul').innerText = res.feedback.judul;
    document.getElementById('popup-text').innerText = res.feedback.text;
    document.getElementById('popup-kunci').innerHTML = `Kunci Jawaban: <b>${res.kunci.charAt(0).toUpperCase()+res.kunci.slice(1)}</b>`;
    let audio = document.getElementById('popup-audio');
    audio.src = benar
        ? `{{ asset('sounds/materi/hal5/benar') }}` + no + '.mp3'
        : `{{ asset('sounds/materi/hal5/salah') }}` + no + '.mp3';
    audio.currentTime = 0;
    popup.style.display = 'flex';
    audio.play();
    audio.onended = function () {
        popup.style.display = 'none';
        if (typeof afterClose === "function") afterClose();
    };
}
</script>
@endsection
