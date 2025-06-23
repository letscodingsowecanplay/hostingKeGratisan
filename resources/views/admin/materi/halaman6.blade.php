@extends('layouts.master')

@section('content')
<div class="materi-main-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Pengukuran
    </div>
    <div class="materi-section">
        <div class="d-flex align-items-center mb-3">
            <span class="warna-label green-card">Ayo Belajar</span>
            <button onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal6/1.mp3') }}"></audio>
        </div>
        <p>
            Membandingkan ukuran berarti melihat perbedaan antara dua atau lebih benda berdasarkan panjang, pendek, tinggi, atau rendahnya. Dengan membandingkan, kita bisa mengetahui mana benda yang lebih panjang, lebih pendek, lebih tinggi, atau lebih rendah.  Perhatikan contoh berikut.
        </p>
    </div>

    <div class="materi-section">
        <div class="text-center my-4">
            <img src="{{ asset('images/materi/susunan-foto-banjar.png') }}"
                alt="Susunan Foto Banjar"
                class="rounded shadow"
                style="width:100%; max-width: 600px; height: 300px; object-fit: cover; margin: 0 auto;">
        </div>
    </div>

    <!-- Box Tahukah Kalian -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #fffde7; border-left: 5px solid #ffb300; padding: 16px 18px; border-radius: 10px; font-size: 1.06em; color: #775b08; margin-bottom: 18px; box-shadow: 0 2px 8px #ffb30018;">
            <strong style="font-size:1.1em;">Tahukah Kalian?</strong>
            <br>
            Lukisan-lukisan pada gambar di atas menampilkan keindahan budaya masyarakat Banjar yang tinggal di wilayah lahan basah Kalimantan Selatan. Kehidupan di lahan basah sangat erat dengan sungai, hewan bekantan, perahu jukung, dan berbagai tradisi unik lainnya yang sering menjadi inspirasi dalam karya seni. Dengan memperhatikan lukisan ini, kita bisa belajar mengenal ciri khas budaya dan alam daerah lahan basah.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-1" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-1" src="{{ asset('sounds/materi/hal6/narasi-1.mp3') }}"></audio>
        </div>
    </div>

    <div class="materi-section">
        <button onclick="toggleAudio(this)"
                class="btn-audio"
                data-id="index-2" data-playing="false">🔊</button>
        <audio id="audio-index-2" src="{{ asset('sounds/materi/hal6/2.mp3') }}"></audio>
        <p class="mt-2">
            Kita akan membandingkan tinggi lukisan khas Kalimantan yang digantung yaitu c dan d.
        </p>
        <p class="mt-2">
            Lukisan c lebih tinggi dari lukisan d.
        </p>
        <p class="mt-2">
            Lukisan d lebih rendah dari lukisan c.
        </p>
        <p class="mt-2">
            Kita dapat membandingkan tinggi dua benda.
            Kita menggunakan kata:<br>
            <b>• lebih tinggi</b><br>
            <b>• lebih rendah</b>
        </p>
        <p class="mt-2">
            Kita akan membandingkan tinggi lukisan b dan c.
        </p>
        <p class="mt-2">
            Lukisan b sama tinggi dengan lukisan c.
        </p>
        <p class="mt-2">
            Dua benda ada yang sama tingginya. Kita menggunakan kata sama tinggi untuk membandingkannya.
        </p>
    </div>

    <div class="materi-nav-footer" style="margin-top:32px;">
        <a href="{{ route('admin.materi.halaman5') }}" class="btn-nav" style="min-width:160px;">
            ← Sebelumnya
        </a>
        <a href="{{ route('admin.materi.halaman7') }}" class="btn-nav btn-next" style="min-width:160px;">
            Selanjutnya →
        </a>
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
        document.querySelectorAll('.btn-audio').forEach(btn => {
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

        // Auto-reset ikon saat audio selesai
        audio.onended = function () {
            button.innerText = '🔊';
            button.setAttribute('data-playing', 'false');
        };
    }
</script>
@endsection
