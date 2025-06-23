@extends('layouts.master')

@section('content')

<div class="materi-main-container">
    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:12px;">
        Pengukuran
    </div>

    <div class="materi-section fs-5">
        <p class="mb-1">
            Kita bandingkan kain sasirangan a, b, dan c.
            <button onclick="toggleAudio(this)"
                    class="btn-audio ms-2"
                    data-id="index-1" data-playing="false">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal8/1.mp3') }}"></audio>
        </p>
    </div>

    <div class="materi-section">
        <div class="text-center my-4">
            <img src="{{ asset('images/materi/susunan-sasi.png') }}"
                alt="Susunan Sasirangan"
                class="rounded shadow"
                style="width:100%; max-width: 600px; height: 300px; object-fit: cover; margin: 0 auto;">
        </div>
    </div>

    <!-- Box Tahukah Kalian: Sasirangan -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #fffde7; border-left: 5px solid #ffb300; padding: 16px 18px; border-radius: 10px; font-size: 1.06em; color: #775b08; margin-bottom: 18px; box-shadow: 0 2px 8px #ffb30018;">
            <strong style="font-size:1.1em;">Tahukah Kalian?</strong>
            <br>
            Kain sasirangan adalah kain tradisional khas Kalimantan Selatan yang dibuat dengan cara diikat dan dicelupkan ke dalam pewarna. Kain ini biasanya dipakai pada acara adat dan memiliki motif-motif yang indah dan penuh makna. Kain sasirangan dibuat secara manual oleh para pengrajin, sehingga setiap kain menjadi unik.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-1" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-1" src="{{ asset('sounds/materi/hal8/narasi-1.mp3') }}"></audio>
        </div>
    </div>

    <div class="materi-section fs-5">
        <button onclick="toggleAudio(this)"
                class="btn-audio"
                data-id="index-2" data-playing="false">🔊</button>
        <audio id="audio-index-2" src="{{ asset('sounds/materi/hal8/2.mp3') }}"></audio>

        <p class="mt-2">
            Kain sasirangan a lebih pendek dari kain sasirangan b.<br>
            Kain sasirangan b lebih pendek dari kain sasirangan c.<br>
            Kain sasirangan a lebih pendek dari kain sasirangan b dan c.<br>
            Kain sasirangan a paling pendek.
        </p>
        <p class="mt-2">
            Kain sasirangan c lebih panjang dari kain sasirangan b.<br>
            Kain sasirangan c lebih panjang dari kain sasirangan a.<br>
            Kain sasirangan c lebih panjang dari kain sasirangan b dan a.<br>
            Kain sasirangan c paling panjang.
        </p>
        <p class="mt-2">
            Kita dapat membandingkan panjang benda.<br>
            Kita menggunakan kata:<br>
            <b>• lebih panjang</b><br>
            <b>• lebih pendek</b><br>
            <b>• paling panjang</b><br>
            <b>• paling pendek</b>
        </p>
    </div>

    <div class="materi-nav-footer" style="margin-top:32px;">
        <a href="{{ route('admin.materi.halaman7') }}" class="btn-nav" style="min-width:160px;">
            ← Sebelumnya
        </a>
        <a href="{{ route('admin.materi.halaman9') }}" class="btn-nav btn-next" style="min-width:160px;">
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
