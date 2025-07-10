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
                        class="btn-audio-2 ms-2 py-1"
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
                        class="btn-audio-2 ms-2 py-1"
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
                <div class="alert alert-warning mt-3 mb-0 px-3 py-2 custom-alert-warning">
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
                        class="btn-audio-2 ms-2 py-1"
                        data-id="index-3" data-playing="false">🔊</button>
                <audio id="audio-index-3" src="{{ asset('sounds/evaluasi/petunjuk/3.mp3') }}"></audio>
            </div>
            <div class="card-content-wrap w-100">
                <p class="mb-1"><strong>Nama:</strong> {{ $user->name }}</p>
                <p class="mb-1"><strong>Kelas:</strong> 1</p>
                <p class="mb-1"><strong>Sekolah:</strong> SD Banjarmasin</p>
                <p class="mb-3"><strong>Email:</strong> {{ $user->email }}</p>
                {{-- TOMBOL CENTER VERTIKAL DAN HORIZONTAL --}}
                <div class="tombol-card-center w-100">
                    <a href="{{ route('admin.materi.index') }}" 
                        class="card-btn btn-eval rounded-pill tombol-center-materi fs-5">Kembali ke Materi</a>
                    @if(count($kuisBelumSelesai) > 0)
                        <button class="card-btn bg-coklap2 text-white rounded-pill tombol-center-materi fs-5" disabled>Lengkapi Terlebih Dahulu</button>
                    @elseif($hasil && $hasil->status !== 'tidak_lulus')
                        <button class="card-btn bg-coklap2 text-white rounded-pill tombol-center-materi fs-5" disabled>Sudah Dikerjakan</button>
                    @else
                        <a href="{{ route('admin.evaluasi.index') }}" 
                            class="card-btn btn-eval rounded-pill tombol-center-materi fs-5">Mulai Evaluasi</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- Warning jika ada kuis belum selesai --}}
    @if(count($kuisBelumSelesai) > 0)
        <div class="alert alert-warning custom-alert-warning mt-3" style="max-width:880px;margin-left:auto;margin-right:auto;">
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
            <div class="card purple-card" style="border-radius:22px;">
                <div class="card-title text-center pt-3"><strong>Hasil Evaluasi</strong></div>
                <div class="card-content-wrap w-100 px-4 py-3">
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
/* Semua card isi font putih */
.card-box,
.card-box .card-content-wrap,
.card-box .card-title {

}
.card-box .card-content-wrap p,
.card-box .card-content-wrap li,
.card-box .card-content-wrap strong,
.card-box .card-content-wrap ol,
.card-box .card-content-wrap ul {

}

/* Tombol audio baru */
.btn-audio-2 {
    margin-left: 8px;
    border-radius: 9px;
    padding: 3px 13px;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    box-shadow: 0 1px 6px #3f73d329;
    cursor: pointer;
    background: #ffe145;
    color: #284b63;
    transition: background .13s, color .13s;
    vertical-align: middle;
    display: inline-block;
}
.btn-audio-2:hover,
.btn-audio-2[data-playing="true"] {
    background: #fffbe9;
    color: #111;
}

/* Tombol utama: kuning gradien, hover lebih terang */
.card-btn.btn-eval, .card-btn.btn-eval:visited {
    background: linear-gradient(120deg, #ffe145 85%, #fbd046 100%) !important;
    color: #4E1F00 !important;
    border: 2px solid #ffd426 !important;
    transition: background .18s, color .18s, border .18s;
    font-weight: 700;
    text-decoration: none;
}
.card-btn.btn-eval:hover, .card-btn.btn-eval:focus {
    background: linear-gradient(120deg, #fffbe9 85%, #ffe145 100%) !important;
    color: #222 !important;
    border: 2px solid #ffe145 !important;
    box-shadow: 0 2px 16px #ffd42641;
    text-decoration: none;
}
.card-btn.bg-coklap2[disabled],
.card-btn.bg-coklap2:disabled {
    opacity: 0.68 !important;
    cursor: not-allowed !important;
}

/* Centering tombol dalam card biru */
.tombol-card-center {
    display: flex !important;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 170px;
    gap: 16px;
    width: 100%;
}
.tombol-center-materi {
    min-width: 180px;
    min-height: 58px;
    font-size: 1.21rem;
    font-weight: 700;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    margin: 0 !important;
    text-align: center !important;
    width: 100%;
    max-width: 260px;
}

/* Custom Warning Alert: background gradien kuning, font putih */
.alert-warning.custom-alert-warning {
    background: linear-gradient(120deg, #ffe145 85%, #fbd046 100%) !important;
    color: #fff !important;
    border: none !important;
}

@media (max-width: 768px) {
    .tombol-card-center { min-height: 120px; }
    .tombol-center-materi { min-height: 44px; font-size: 1.06rem; }
}
</style>

<script>
function toggleAudio(button) {
        const id = button.getAttribute('data-id');
        const audio = document.getElementById('audio-' + id);

        // Pause semua audio KECUALI background music
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio && a.id !== 'bg-music') {
                a.pause();
                a.currentTime = 0;
            }
        });

        // Reset semua tombol audio KECUALI yang aktif
        document.querySelectorAll('.btn-audio').forEach(btn => {
            if (btn !== button) {
                btn.innerText = '🔊';
                btn.setAttribute('data-playing', 'false');
            }
        });

        // Toggle play/pause untuk audio yang di-klik
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
</script>
@endsection
