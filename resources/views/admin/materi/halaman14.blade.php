@extends('layouts.master')

@section('content')
<div class="materi-main-container fs-5">
    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label orange-card mb-3" style="font-size:1rem;">Perbedaan Hasil Pengukuran</div>
        <div class="materi-content">
            <span class="fw-semibold">Kemungkinan Perbedaan Pengukuran pada Suatu Benda dengan Satuan Tidak Baku.</span><button onclick="toggleAudio(this)" 
                    class="btn-audio"
                    data-id="index-1" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal14/1.mp3') }}"></audio>
            <br><br>
            Ketika kita mengukur suatu benda menggunakan satuan tidak baku, hasilnya bisa berbeda tergantung pada alat atau benda yang digunakan sebagai satuan ukur. Hal ini terjadi karena satuan tidak baku tidak memiliki ukuran yang tetap seperti satuan baku (misalnya meter atau sentimeter).
            <br><br>
            Sebagai contoh, jika kita mengukur tinggi sebuah buku menggunakan stik es krim, hasilnya mungkin 3 stik es krim. Namun, jika kita mengukurnya dengan pensil, hasilnya bisa berbeda, misalnya 2 pensil. Hal ini terjadi karena panjang stik es krim dan pensil tidak sama—stik es krim lebih pendek dibandingkan pensil, sehingga diperlukan lebih banyak stik es krim untuk mengukur tinggi buku tersebut.
            <br><br>
            Perbedaan pengukuran ini menunjukkan bahwa satuan tidak baku bersifat relatif dan bisa berubah tergantung pada benda yang digunakan untuk mengukur.
        </div>
    </div>

    {{-- Gambar dan caption --}}
    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="materi-image-row justify-content-center my-1">
            <div class="materi-image-col" style="max-width:330px">
                <img src="{{ asset('images/materi/perbedaan-hasil-ukur.png') }}" 
                    alt="Gambar Perbedaan Pengukuran"
                    class="img-fluid materi-img rounded-4"
                    style="max-width:300px; background:#fffbe9;"/>
            </div>
        </div>
        <div class="materi-caption text-center mt-2" style="font-size:1.08rem;">
            Panjang buku adalah 3 stik es krim.<br>
            Panjang buku adalah 2 pensil.
            <button onclick="toggleAudio(this)" 
                    class="btn-audio"
                    data-id="index-2" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-2" src="{{ asset('sounds/materi/hal14/2.mp3') }}"></audio>
        </div>
    </div>

    <!-- Box Tahukah Kalian: Kamus Banjar -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #e3f2fd; border-left: 5px solid #1976d2; padding: 16px 18px; border-radius: 10px; font-size: 1.06em; color: #175093; margin-bottom: 18px; box-shadow: 0 2px 8px #1976d218;">
            <strong style="font-size:1.1em;">Tahukah Kalian?</strong>
            <br>
            Kamus bahasa Banjar adalah buku yang berisi kata-kata dalam bahasa Banjar dan artinya dalam bahasa Indonesia. Kamus ini membantu siswa memahami makna kata-kata dalam bahasa Banjar dan memperkaya kosa kata mereka.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-1" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-1" src="{{ asset('sounds/materi/hal14/narasi-1.mp3') }}"></audio>
        </div>
    </div>

    <div class="materi-nav-footer mt-3">
        <a href="{{ route('admin.materi.halaman13') }}" class="btn btn-nav fs-5">← Sebelumnya</a>
        <a href="{{ route('admin.materi.halaman15') }}" class="btn btn-nav btn-next fs-5">Selanjutnya →</a>
    </div>
</div>
<br>
@endsection

@section('scripts')
<script>
    let currentAudio = null;
    let currentButton = null;

    function toggleAudio(button) {
        const id = button.getAttribute('data-id');
        const audio = document.getElementById(`audio-${id}`);

        // Pause semua audio lain
        document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) {
                a.pause();
                a.currentTime = 0;
            }
        });

        // Reset semua tombol ke 🔊
        document.querySelectorAll('button[data-id]').forEach(btn => {
            if (btn !== button) {
                btn.innerText = '🔊';
                btn.setAttribute('data-playing', 'false');
            }
        });

        // Toggle play/pause
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

        // Reset ikon saat audio selesai
        audio.onended = function () {
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        };
    }
</script>
@endsection
