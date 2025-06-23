@extends('layouts.dash') 

@section('content')
<div class="center-dashboard-container py-4 fs-5" style="min-height:100vh;">
    <div style="width:100%;max-width:1120px;margin:0 auto 22px auto;">
        <h2 class="fw-bold" style="font-size:2.1rem; letter-spacing:.5px; color:rgb(0, 0, 0); margin-bottom:34px; text-align:center;">
            Petunjuk Evaluasi
        </h2>
    </div>
    <div class="dashboard-bar" style="gap:32px; flex-wrap:wrap;">
        {{-- Kolom 1: Profil dan Daftar Isi --}}
        <div class="card-box green-card" style="max-width:340px; width:100%;">
            <div class="card-title d-flex align-items-center mb-2">
                <i class="bi bi-info-circle me-2"></i> Evaluasi
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm card-btn ms-2 py-1"
                        data-id="index-1" data-playing="false">🔊</button>
                <audio id="audio-index-1" src="{{ asset('sounds/evaluasi/petunjuk/1.mp3') }}"></audio>
            </div>
            <div class="card-content-wrap w-100">
                <p class="mb-1"><strong>Pengukuran:</strong></p>
                <ol class="ps-3 mb-0">
                    <li>Membandingkan dan Mengurutkan Panjang Benda</li>
                    <li>Mengukur Panjang Benda</li>
                </ol>
            </div>
        </div>

        {{-- Kolom 2: Petunjuk Kuis --}}
        <div class="card-box orange-card" style="max-width:340px; width:100%;">
            <div class="card-title d-flex align-items-center mb-2">
                <i class="bi bi-info-circle me-2"></i> Petunjuk Evaluasi
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm card-btn ms-2 py-1"
                        data-id="index-2" data-playing="false">🔊</button>
                <audio id="audio-index-2" src="{{ asset('sounds/evaluasi/petunjuk/2.mp3') }}"></audio>
            </div>
            <div class="card-content-wrap w-100">
                <ol class="ps-3 mb-0">
                    <li>Jumlah soal dalam evaluasi ini adalah 10 butir pertanyaan.</li>
                    <li>Masing-masing soal bernilai 10 poin, jadi total skor maksimal adalah 100.</li>
                    <li>Pastikan data diri kamu sudah benar sebelum menekan tombol "Mulai Evaluasi".</li>
                    <li>Baca setiap pertanyaan dengan seksama dan pilih jawaban yang paling tepat.</li>
                    <li>Gunakan waktumu dengan bijak. Setelah selesai menjawab semua soal, klik tombol "Selesai".</li>
                    <li>Semangat dan tetap fokus! Semoga mendapatkan hasil terbaik!</li>
                </ol>
                @if(session('error'))
                <div class="alert alert-warning mt-3 mb-0 px-3 py-2">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>

        {{-- Kolom 3: Data Siswa dan Tombol --}}
        <div class="card-box blue-card" style="max-width:340px; width:100%;">
            <div class="card-title d-flex align-items-center mb-2">
                <i class="bi bi-gear me-2"></i> Data Siswa
                <button onclick="toggleAudio(this)" 
                        class="btn btn-sm card-btn ms-2 py-1"
                        data-id="index-3" data-playing="false">🔊</button>
                <audio id="audio-index-3" src="{{ asset('sounds/evaluasi/petunjuk/3.mp3') }}"></audio>
            </div>
            <div class="card-content-wrap w-100">
                <p class="mb-1"><strong>Nama:</strong> {{ $user->name }}</p>
                <p class="mb-1"><strong>Kelas:</strong> 1</p>
                <p class="mb-1"><strong>Sekolah:</strong> SD Banjarmasin</p>
                <p class="mb-3"><strong>Email:</strong> {{ $user->email }}</p>
                <div class="w-100 d-flex flex-column flex-md-row gap-2 mt-3">
                    <a href="{{ route('admin.materi.index') }}" 
                        class="card-btn btn-neutral rounded-pill text-center w-100 fs-5">Kembali ke Materi</a>
                    @if(count($kuisBelumSelesai) > 0)
                        <button class="card-btn bg-coklap2 text-white rounded-pill w-100 fs-5" disabled>Lengkapi Terlebih Dahulu</button>
                    @elseif($hasil && $hasil->status !== 'tidak_lulus')
                        <button class="card-btn bg-coklap2 text-white rounded-pill w-100 fs-5" disabled>Sudah Dikerjakan</button>
                    @else
                        <a href="{{ route('admin.evaluasi.index') }}" 
                            class="card-btn btn-neutral rounded-pill w-100 fs-5 text-center">Mulai Evaluasi</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- Warning jika ada kuis belum selesai --}}
    @if(count($kuisBelumSelesai) > 0)
        <div class="alert alert-warning mt-3" style="max-width:880px;margin-left:auto;margin-right:auto;">
            <strong>Perhatian!</strong> Kamu belum menyelesaikan bagian berikut ini:
            <ul class="mb-0">
                @foreach ($kuisBelumSelesai as $kuis)
                    <li>{{ $kuis }}</li>
                @endforeach
            </ul>
            <small>Silakan selesaikan bagian di atas terlebih dahulu sebelum memulai evaluasi.</small>
        </div>
    @endif

    {{-- Hasil Evaluasi --}}
    @if($hasil)
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="card blue-card" style="border-radius:22px;">
                <div class="card-title text-center pt-3" style="color:#fff;"><strong>Hasil Evaluasi</strong></div>
                <div class="card-content-wrap w-100 px-4 py-3" style="color:#fff;">
                    <p class="mb-2"><strong>Nilai:</strong> {{ $hasil->skor_persen }} / 100</p>
                    <p class="mb-2"><strong>Persentase:</strong> {{ $hasil->skor_persen }}%</p>
                    @if($hasil->skor < 70)
                        <p class="mb-0" style="color:#ffd1d1;font-weight:700;">Nilai Anda di bawah KKM. Silakan pelajari materi lagi dan mulai evaluasi jika sudah siap.</p>
                    @else
                        <p class="mb-0" style="color:#cfffda;font-weight:700;">Selamat! Anda telah lulus Evaluasi ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
/* Neutral button (putih polos, baru berwarna saat hover) */
.card-btn.btn-neutral, .card-btn.btn-neutral:visited {
    background: #fff !important;
    color: rgb(0, 0, 0) !important;
    border: 2px solid #e3caa5 !important;
    transition: background .18s, color .18s, border .18s;
    font-weight: 700;
}
.card-btn.btn-neutral:hover, .card-btn.btn-neutral:focus {
    background: linear-gradient(120deg, #ffe145 80%, #fbd046 100%) !important;
    color: #4E1F00 !important;
    border: 2px solid #ffd426 !important;
    box-shadow: 0 2px 16px #ffd42641;
    text-decoration: none;
}
.card-btn.bg-coklap2[disabled],
.card-btn.bg-coklap2:disabled {
    opacity: 0.68 !important;
    cursor: not-allowed !important;
}
/* Pastikan hasil evaluasi font putih */
.card.blue-card .card-content-wrap p {
    color: #fff !important;
}
</style>

<script>
let currentAudio = null;
let currentButton = null;
function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);
    document.querySelectorAll('audio').forEach(a => {
        if (a !== audio) { a.pause(); a.currentTime = 0; }
    });
    document.querySelectorAll('button[data-id]').forEach(btn => {
        if (btn !== button) { btn.innerText = '🔊'; btn.setAttribute('data-playing', 'false'); }
    });
    if (audio.paused) {
        audio.play();
        button.innerText = '⏸️';
        button.setAttribute('data-playing', 'true');
        currentAudio = audio;
        currentButton = button;
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
</script>
@endsection
