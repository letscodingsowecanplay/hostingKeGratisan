@extends('layouts.master')

@section('title', 'Ayo Berlatih')

@section('content')
<div class="materi-main-container fs-5" id="hal10-container">
    <h2 class="fw-bold text-center mb-3" style="font-size: 2rem;">Ayo Berlatih</h2>

    {{-- POPUP FEEDBACK --}}
    <div id="popup-feedback" style="display:none; position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:1000; background:rgba(40,75,99,.13); align-items:center;justify-content:center;">
        <div style="background:#fff; border-radius:16px; box-shadow:0 7px 38px #2223; padding:32px 38px; max-width:400px; width:98vw; text-align:center; position:relative;">
            <img id="popup-img" src="" style="max-width:130px; max-height:130px; margin-bottom:15px; border-radius:15px; box-shadow:0 3px 15px #0002;">
            <h4 id="popup-judul" style="font-weight:700;"></h4>
            <p id="popup-text" style="font-size:1.1rem;margin-bottom:2px;"></p>
            <div style="margin:7px auto 0 auto; font-size:1.13rem;" id="popup-kunci"></div>
        </div>
        <audio id="popup-audio" src=""></audio>
    </div>

    <p class="mb-4">
        Pilihlah salah satu jawaban yang benar dari pilihan A, B, dan C!
        <button onclick="toggleAudio(this)"
                class="btn-audio"
                data-id="index-1" data-playing="false" type="button">🔊</button>
        <audio id="audio-index-1" src="{{ asset('sounds/materi/hal10/1.mp3') }}"></audio>
    </p>

    @php
        $totalSoal = count($soal);
        $firstUnanswered = 1;
        for($i=0;$i<$totalSoal;$i++){ if(!isset($jawabanUser[$i])) { $firstUnanswered = $i+1; break; } }
        $penjelasan = [
            0 => [
                'benar' => 'Jawaban kamu benar. Urutan miniatur rumah banjar dari yang paling tinggi adalah a-b-c.',
                'salah' => 'Jawaban kamu salah. Perhatikan kembali urutan tinggi rumah pada gambar.',
                'audio' => asset('sounds/materi/hal10/penjelasan_1.mp3')
            ],
            1 => [
                'benar' => 'Jawaban kamu benar. Tas kerajinan khas Kalimantan yang digantung paling rendah adalah c-b-a.',
                'salah' => 'Jawaban kamu salah. Lihat kembali posisi tas pada gambar.',
                'audio' => asset('sounds/materi/hal10/penjelasan_2.mp3')
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Urutan patung dayak fiber glass dari yang paling panjang adalah b, a, lalu c sesuai gambar.',
                'salah' => 'Jawaban kamu salah. Cermati kembali ukuran patung.',
                'audio' => asset('sounds/materi/hal10/penjelasan_3.mp3')
            ],
            3 => [
                'benar' => 'Jawaban kamu benar. Urutan vas bunga akar keladi dari yang paling pendek adalah c, lalu b, dan paling tinggi a.',
                'salah' => 'Jawaban kamu salah. Perhatikan kembali ukuran vas pada gambar.',
                'audio' => asset('sounds/materi/hal10/penjelasan_4.mp3')
            ],
            4 => [
                'benar' => 'Jawaban kamu benar. Urutan kain sasirangan dari yang paling panjang adalah a, lalu c, lalu b.',
                'salah' => 'Jawaban kamu salah. Lihat kembali panjang kain pada gambar.',
                'audio' => asset('sounds/materi/hal10/penjelasan_5.mp3')
            ],
        ];
        $audioFeedback = [
            0 => [ 'benar' => asset('sounds/materi/hal10/feedback_benar_1.mp3'), 'salah' => asset('sounds/materi/hal10/feedback_salah_1.mp3')],
            1 => [ 'benar' => asset('sounds/materi/hal10/feedback_benar_2.mp3'), 'salah' => asset('sounds/materi/hal10/feedback_salah_2.mp3')],
            2 => [ 'benar' => asset('sounds/materi/hal10/feedback_benar_3.mp3'), 'salah' => asset('sounds/materi/hal10/feedback_salah_3.mp3')],
            3 => [ 'benar' => asset('sounds/materi/hal10/feedback_benar_4.mp3'), 'salah' => asset('sounds/materi/hal10/feedback_salah_4.mp3')],
            4 => [ 'benar' => asset('sounds/materi/hal10/feedback_benar_5.mp3'), 'salah' => asset('sounds/materi/hal10/feedback_salah_5.mp3')],
        ];
        $kkm = $kkm ?? 70;
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
        @foreach($soal as $index => $item)
            @php
                $no = $index + 1;
                $userAnswer = $jawabanUser[$index] ?? null;
                $kunci = $kunciJawaban[$index] ?? null;
                $penjelasanSoal = $penjelasan[$index] ?? ['benar' => '', 'salah' => '', 'audio'=>''];
                $isBenar = ($userAnswer !== null && $userAnswer === $kunci);
            @endphp

            <div class="mb-5 materi-section shadow-sm rounded-3 py-3 px-3 soal-step"
                 id="soal-step-{{ $no }}" style="@if($no !== $firstUnanswered)display:none;@endif;background:#fff;">
                <div class="d-flex align-items-center mb-2" style="gap: 16px;">
                    <span class="warna-label yellow-card" style="font-size:1rem; margin-bottom:0; padding:6px 18px;">
                        {{ $no }}.
                    </span>
                    <span class="fw-bold materi-content" style="font-size:1.13rem; flex:1;">
                        {{ $item['pertanyaan'] }}
                    </span>
                    @if(!empty($item['audio']))
                        <button
                            type="button"
                            onclick="toggleAudio(this)"
                            class="btn-audio"
                            data-id="hal10-{{ $no }}" data-playing="false"
                            aria-label="Dengarkan soal"
                            style="margin-left:10px;"
                        >🔊</button>
                        <audio id="hal10-{{ $no }}" src="{{ asset('sounds/materi/hal10/hal10-' . $no . '.mp3') }}"></audio>
                    @endif
                </div>
                @if(!empty($item['gambar']))
                    <div class="materi-image-row justify-content-center my-2">
                        <div class="materi-image-col" style="max-width:340px">
                            <img src="{{ asset('images/materi/ayo-berlatih-2/' . $item['gambar']) }}"
                                 alt="Gambar soal {{ $no }}"
                                 class="img-fluid materi-img rounded-4"
                                 style="max-width:320px;"/>
                        </div>
                    </div>
                @endif
                <div class="mt-3" id="pilihan-{{ $index }}">
                    @foreach($item['pilihan'] as $key => $pilihan)
                        @php
                            $isUserAnswer = ($userAnswer === $key);
                            $isKunci = ($kunci === $key);
                            $highlightClass = '';
                            if($userAnswer !== null && $isUserAnswer) {
                                $highlightClass = $isBenar ? 'bg-success text-white' : 'bg-danger text-white';
                            }
                            $audioPilihan = asset("sounds/materi/hal10/pilihan/{$no}-{$key}.mp3");
                            $audioId = "audio-hal10-{$no}-{$key}";
                        @endphp
                        <div class="card mb-2 bg-cokren {{ $highlightClass }}" id="card-{{ $index }}-{{ $key }}">
                            <div class="card-body p-2 d-flex align-items-center">
                                @if($userAnswer === null)
                                    <div class="form-check flex-grow-1 d-flex align-items-center">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="jawaban_{{ $index }}"
                                            id="soal{{ $index }}_{{ $key }}"
                                            value="{{ $key }}"
                                            data-index="{{ $index }}"
                                            data-no="{{ $no }}"
                                            >
                                        <label class="form-check-label ms-2" for="soal{{ $index }}_{{ $key }}" style="color:#222;font-weight:600;">
                                            <span style="font-weight:700; color:#222;">{{ strtoupper($key) }}</span>)
                                            {{ $pilihan }}
                                        </label>
                                        <button type="button" onclick="toggleAudio(this)"
                                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                                data-id="{{ $audioId }}" data-playing="false">🔊</button>
                                        <audio id="{{ $audioId }}" src="{{ $audioPilihan }}"></audio>
                                    </div>
                                @else
                                    <div class="flex-grow-1 d-flex align-items-center">
                                        <span style="font-weight:700; color:#222;">{{ strtoupper($key) }}</span>)
                                        <span style="color:#222; margin-left:3px;">{{ $pilihan }}</span>
                                        @if($isKunci)
                                            <span style="font-size:1.45em; margin-left:12px; margin-right:2px; color:#111; display:inline-block; vertical-align:middle;">✔</span>
                                        @elseif($isUserAnswer && !$isKunci)
                                            <span style="font-size:1.45em; margin-left:12px; margin-right:2px; color:#111; display:inline-block; vertical-align:middle;">✖</span>
                                        @endif
                                        @if($isUserAnswer)
                                            <span class="badge bg-light text-dark ms-2">Jawaban Kamu</span>
                                        @endif
                                        <button type="button" onclick="toggleAudio(this)"
                                                class="btn btn-sm btn-outline-dark bg-coklapbet text-white ms-2"
                                                data-id="{{ $audioId }}" data-playing="false">🔊</button>
                                        <audio id="{{ $audioId }}" src="{{ $audioPilihan }}"></audio>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="penjelasan-{{ $index }}" class="mt-2"></div>
            </div>
        @endforeach
    </div>
    @endif

    {{-- Review + Skor setelah selesai --}}
    @if(count($jawabanUser) === $totalSoal)
        <div id="review-area">
            <div class="text-center mb-3">
                <h4 class="fw-bold">Review Jawabanmu</h4>
            </div>
            <div class="mb-3 d-flex justify-content-center gap-2">
                @for ($no = 1; $no <= $totalSoal; $no++)
                    <button type="button" class="btn btn-outline-primary px-3 py-1" onclick="showReviewSoal({{ $no }})" id="btn-review-{{ $no }}">
                        Soal {{ $no }}
                    </button>
                @endfor
            </div>
            @for ($no = 1; $no <= $totalSoal; $no++)
            <div class="materi-section mb-5 fs-5 review-step" id="review-step-{{ $no }}" style="@if($no>1)display:none;@endif">
                @php
                    $item = $soal[$no-1];
                    $userAnswer = $jawabanUser[$no-1] ?? null;
                    $kunci = $kunciJawaban[$no-1] ?? null;
                    $isBenar = ($userAnswer !== null && $userAnswer === $kunci);
                    $penjelasanSoal = $penjelasan[$no-1] ?? ['benar' => '', 'salah' => '', 'audio'=>''];
                @endphp
                <div class="d-flex align-items-center mb-2" style="gap: 16px;">
                    <span class="warna-label yellow-card" style="font-size:1rem; margin-bottom:0; padding:6px 18px;">
                        {{ $no }}.
                    </span>
                    <span class="fw-bold materi-content" style="font-size:1.13rem; flex:1;">
                        {{ $item['pertanyaan'] }}
                    </span>
                </div>
                @if(!empty($item['gambar']))
                    <div class="materi-image-row justify-content-center my-2">
                        <div class="materi-image-col" style="max-width:340px">
                            <img src="{{ asset('images/materi/ayo-berlatih-2/' . $item['gambar']) }}"
                                 alt="Gambar soal {{ $no }}"
                                 class="img-fluid materi-img rounded-4"
                                 style="max-width:320px;"/>
                        </div>
                    </div>
                @endif
                <div class="mt-3" id="pilihan-review-{{ $no }}">
                    @foreach($item['pilihan'] as $key => $pilihan)
                        @php
                            $isUserAnswer = ($userAnswer === $key);
                            $isKunci = ($kunci === $key);
                            $highlightClass = '';
                            if($userAnswer !== null && $isUserAnswer) {
                                $highlightClass = $isBenar ? 'border border-3 border-success' : 'border border-3 border-danger';
                            }
                        @endphp
                        <div class="card mb-2 bg-cokren {{ $highlightClass }}" id="review-card-{{ $no }}-{{ $key }}">
                            <div class="card-body p-2 d-flex align-items-center">
                                <span style="font-weight:700; color:#222;">{{ strtoupper($key) }}</span>)
                                <span style="color:#222; margin-left:3px;">{{ $pilihan }}</span>
                                @if($isKunci)
                                    <span style="font-size:1.45em; margin-left:12px; margin-right:2px; color:#111; display:inline-block; vertical-align:middle;">✔</span>
                                @elseif($isUserAnswer && !$isKunci)
                                    <span style="font-size:1.45em; margin-left:12px; margin-right:2px; color:#111; display:inline-block; vertical-align:middle;">✖</span>
                                @endif
                                @if($isUserAnswer)
                                    <span class="badge bg-light text-dark ms-2">Jawaban Kamu</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-2 mb-3">
                    <span class="badge warna-label {{ $isBenar ? 'green-card':'red-card' }} mb-1">
                        Jawaban {{ $isBenar ? 'Benar':'Salah' }}
                        @if($isBenar)
                            <span style="font-size:1.15em;vertical-align:middle;">✔</span>
                        @else
                            <span style="font-size:1.15em;vertical-align:middle;">✖</span>
                        @endif
                    </span>
                    <span class="badge warna-label yellow-card mb-1">
                        Kunci Jawaban:  {{ strtoupper($kunci) }}
                    </span>
                    <div class="card card-body border-info bg-light d-flex align-items-center gap-3">
                        <span>{!! $penjelasanSoal[$isBenar ? 'benar' : 'salah'] !!} 
                        <button type="button" onclick="playPenjelasanAudio({{ $no }}, this)" class="btn btn-audio ms-2">
                            🔊
                        </button>
                        <audio id="audio-penjelasan-{{ $no }}" src="{{ $penjelasanSoal['audio'] }}"></audio>
                        </span>
                    </div>
                </div>
            </div>
            @endfor
            <div id="skor-kkm-area" style="margin-top:10px;">
                @if($skor < $kkm)
                    <form action="{{ route('admin.materi.halaman10.reset') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-danger fs-5">Ulangi Kuis</button>
                    </form>
                @endif
                <div class="text-center flex-grow-1 fs-5">
                    <div id="skor-anda" class="alert alert-info d-inline-block mb-0">
                        Nilai Anda: {{ $skor }} / 100
                    </div>
                </div>
                <div id="kkm-anda" class="alert alert-success mt-3 fs-5">
                    @if($skor >= $kkm)
                        Selamat, kamu telah mencapai KKM. Kamu boleh melanjutkan ke halaman berikutnya.
                    @else
                        Nilai kamu belum mencapai KKM. Silakan ulangi kuis ini.
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="materi-nav-footer" style="margin-top:32px;">
        <a href="{{ route('admin.materi.halaman9') }}" class="btn-nav" style="min-width:160px">← Sebelumnya</a>
        @if(count($jawabanUser) === $totalSoal && $skor >= $kkm)
            <a href="{{ route('admin.materi.halaman11') }}" class="btn-nav btn-next" style="min-width:160px">Selanjutnya →</a>
        @else
            <button class="btn-nav btn-next" style="opacity:0.6; pointer-events:none; min-width:160px;">Selanjutnya →</button>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(id.startsWith('audio-') ? id : 'audio-' + id) || document.getElementById(id);
    document.querySelectorAll('audio').forEach(a => { if (a !== audio) { a.pause(); a.currentTime = 0; } });
    document.querySelectorAll('.btn-audio').forEach(btn => {
        if (btn !== button) { btn.innerText = '🔊'; btn.setAttribute('data-playing', 'false'); }
    });
    if (audio && audio.paused) {
        audio.play(); button.innerText = '⏸️'; button.setAttribute('data-playing', 'true');
    } else if(audio) {
        audio.pause(); button.innerText = '🔊'; button.setAttribute('data-playing', 'false');
    }
    if(audio) audio.onended = function () { button.innerText = '🔊'; button.setAttribute('data-playing', 'false'); };
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

const totalSoal = {{ $totalSoal }};
let currentStep = {{ $firstUnanswered }};
const answered = {!! json_encode($jawabanUser) !!};

function showStep(no) {
    for (let i = 1; i <= totalSoal; i++) {
        let el = document.getElementById('soal-step-' + i);
        if(el) el.style.display = (i === no ? '' : 'none');
        let btn = document.getElementById('btn-stepper-' + i);
        if(btn) btn.classList.toggle('btn-primary', i === no);
    }
    currentStep = no;
}

// Logic: ke soal berikutnya yang belum dijawab, jika semua sudah reload
document.addEventListener('DOMContentLoaded', function() {
    @if(count($jawabanUser) < $totalSoal)
    document.querySelectorAll('.soal-step input[type=radio][name^="jawaban_"]').forEach(function(radio) {
        radio.addEventListener('change', function(e) {
            if (this.disabled) return;
            let index = parseInt(this.getAttribute('data-index'));
            let no = parseInt(this.getAttribute('data-no'));
            let jawaban = this.value;
            let radios = document.querySelectorAll('input[name="jawaban_'+index+'"]');
            radios.forEach(x => x.disabled = true);
            fetch('{{ route('admin.materi.halaman10.jawab') }}', {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify({index: index, jawaban: jawaban})
            })
            .then(res => res.json())
            .then(res => {
                if (!res.success) {
                    alert(res.msg ?? 'Terjadi kesalahan!');
                    window.location.reload();
                    return;
                }
                showFeedbackPopup(res.feedback, index);

                setTimeout(() => {
                    let penjelasanArea = document.getElementById('penjelasan-' + index);
                    if (penjelasanArea) {
                        penjelasanArea.innerHTML =
                            `<span class="badge warna-label ${res.benar ? 'green-card':'red-card'} mb-1">Jawaban ${res.benar ? 'Benar':'Salah'} ${res.benar ? '✔':'✖'}</span>
                            <div class="card card-body border-info bg-light d-flex align-items-center gap-3">${res.penjelasan}
                            <button type="button" onclick="playPenjelasanAudio(${no}, this)" class="btn btn-audio ms-2">🔊</button>
                            <audio id="audio-penjelasan-${no}" src="${res.audioPenjelasan}"></audio>
                            </div>
                            <div class="mt-1"><span class="badge warna-label green-card">Kunci Jawaban: ${res.kunci.toUpperCase()}</span></div>`;
                    }
                    // Cari soal berikutnya yang belum dijawab dari sisi client
                    let nextUnanswered = null;
                    for (let i = 0; i < totalSoal; i++) {
                        let isAnswered = document.querySelector('input[name="jawaban_'+i+'"]:checked');
                        if (!isAnswered) {
                            nextUnanswered = i + 1;
                            break;
                        }
                    }
                    setTimeout(() => {
                        if (nextUnanswered) {
                            showStep(nextUnanswered);
                        } else {
                            window.location.reload();
                        }
                    }, 800);
                }, 1200);
            });
        });
    });
    @endif
});

function showFeedbackPopup(feedback, index) {
    let popup = document.getElementById('popup-feedback');
    let popupImg = document.getElementById('popup-img');
    let popupJudul = document.getElementById('popup-judul');
    let popupText = document.getElementById('popup-text');
    let popupKunci = document.getElementById('popup-kunci');
    let popupAudio = document.getElementById('popup-audio');

    let isBenar = feedback.benar === true || (feedback.judul && feedback.judul.toLowerCase().includes('benar'));
    popupImg.src = isBenar
        ? '{{ asset('images/feedback/benar.png') }}'
        : '{{ asset('images/feedback/salah.png') }}';

    popupJudul.innerText = feedback.judul;
    popupText.innerText = feedback.text;
    popupKunci.innerHTML = `Kunci Jawaban: <b>${feedback.kunci}</b>`;

    // Gunakan feedback.audio untuk popup
    popupAudio.src = feedback.audio || "";
    popupAudio.currentTime = 0;
    popupAudio.play();

    popup.style.display = 'flex';
    setTimeout(() => { popup.style.display = 'none'; popupAudio.pause(); }, 1700);

    popupAudio.onended = function () { popup.style.display = 'none'; };
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
@endsection
