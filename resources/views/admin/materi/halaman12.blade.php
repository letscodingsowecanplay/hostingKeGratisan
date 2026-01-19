@extends('layouts.master')

@section('content')

<div class="materi-main-container fs-5">
    <h2 class="fw-bold text-center mb-3" style="font-size:2rem;">Pengukuran</h2>

    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="warna-label blue-card mb-3" style="font-size:1rem;">Alat Ukur Tidak Baku</div>
        <div class="materi-content mb-3 fw-semibold">
            Beberapa alat ukur tidak baku yang digunakan dalam kehidupan sehari-hari:
            <button onclick="toggleAudio(this)" 
                    class="btn-audio"
                    data-id="index-1" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-1" src="{{ asset('sounds/materi/hal12/1.mp3') }}"></audio>
        </div>

        {{-- Grid Gambar --}}
        <div class="materi-image-row flex-wrap mb-3 alat-grid-mobile">
            @php
                $alat = [
                    [
                        'img' => 'jengkal.png', 'label' => 'jengkal', 'audio' => 2
                    ],
                    [
                        'img' => 'hasta.png', 'label' => 'hasta', 'audio' => 3
                    ],
                    [
                        'img' => 'depa.png', 'label' => 'depa', 'audio' => 4
                    ],
                    [
                        'img' => 'telapak-kaki.png', 'label' => 'telapak kaki', 'audio' => 5
                    ],
                    [
                        'img' => 'koin.png', 'label' => 'koin', 'audio' => 6
                    ],
                    [
                        'img' => 'sedotan.png', 'label' => 'sedotan', 'audio' => 7
                    ],
                    [
                        'img' => 'klip-kertas.png', 'label' => 'klip kertas', 'audio' => 8
                    ],
                    [
                        'img' => 'stik-eskrim.png', 'label' => 'stik eskrim', 'audio' => 9
                    ],
                ];
            @endphp
            @foreach($alat as $a)
                <div class="materi-image-col alat-grid-col">
                    <img src="{{ asset('images/materi/' . $a['img']) }}" 
                        class="img-fluid shadow mb-2"
                        style="max-height: 100px; background: #fffbe9;"
                        alt="{{ ucfirst($a['label']) }}">
                    <div class="materi-caption fw-semibold alat-caption-mobile" style="margin-bottom: 0;">
                        {{ $a['label'] }}
                        <button onclick="toggleAudio(this)" 
                                class="btn-audio"
                                data-id="index-{{ $a['audio'] }}" data-playing="false" type="button" style="padding:2px 11px;">🔊</button>
                        <audio id="audio-index-{{ $a['audio'] }}" src="{{ asset('sounds/materi/hal12/'.$a['audio'].'.mp3') }}"></audio>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="materi-section shadow-sm rounded-3 py-3 px-3" style="background:#fff;">
        <div class="materi-content mb-3">
            <strong>Kalian bisa menggunakan benda lain di sekitar.</strong>
            <button onclick="toggleAudio(this)" 
                class="btn-audio"
                data-id="index-10" data-playing="false" type="button">🔊</button>
            <audio id="audio-index-10" src="{{ asset('sounds/materi/hal12/10.mp3') }}"></audio>
        </div>
        <div class="warna-label orange-card"><strong>Penjelasan</strong></div>
        <ul class="materi-list">
            <li>Jengkal adalah menggunakan jari tangan.</li>
            <li>Hasta adalah jarak antara ujung jari tengah ke siku tangan.</li>
            <li>Depa adalah merentangkan kedua tangan.</li>
            <li>Telapak kaki adalah jumlah langkah kaki.</li>
        </ul>
    </div>

    <div class="materi-nav-footer mt-3">
        <a href="{{ route('admin.materi.halaman11') }}" class="btn btn-nav">← Sebelumnya</a>
        <a href="{{ route('admin.materi.halaman13') }}" class="btn btn-nav btn-next">Selanjutnya →</a>
    </div>
</div>
<br>
@endsection

@section('scripts')
<script>
    function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById('audio-' + id);

    document.querySelectorAll('audio').forEach(a => {
        if (a !== audio && a.id !== 'bg-music') {
            a.pause();
            a.currentTime = 0;
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
</script>
@endsection
