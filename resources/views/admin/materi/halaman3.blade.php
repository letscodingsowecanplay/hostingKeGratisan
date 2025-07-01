@extends('layouts.master')

@section('content')

<div class="materi-main-container">

    <div class="materi-title" style="font-size:2rem; font-weight:800; color:#222; text-align:center; margin-bottom:10px;">
        Pengukuran
    </div>

    <!-- Box Tahukah Kalian: Jukung -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #fffde7; border-left: 5px solid #ffb300; padding: 15px 18px; border-radius: 10px; font-size: 1.08rem; color: #775b08; margin-bottom: 18px; box-shadow: 0 2px 8px #ffb30018;">
            <strong>Tahukah Kalian?</strong><br>
            Jukung adalah perahu tradisional yang biasa digunakan oleh masyarakat Banjar di Kalimantan Selatan. Jukung dipakai sebagai alat transportasi di sungai untuk berbagai kegiatan sehari-hari, seperti pergi ke kebun, mencari ikan, dan berdagang di pasar terapung. Sampai sekarang, jukung masih sering digunakan karena sangat membantu masyarakat yang tinggal di dekat sungai.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-1" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-1" src="{{ asset('sounds/materi/hal3/narasi-1.mp3') }}"></audio>
        </div>
    </div>

    <!-- Gambar dan Kalimat 1 -->
    <div class="materi-section">
        <div class="materi-image-row">
            <div class="materi-image-col">
                <img src="{{ asset('images/materi/jukung-big.png') }}" class="img-fluid rounded shadow" alt="Jukung Panjang">
                <div class="materi-caption">
                    Jukung memiliki bentuk yang panjang.
                    <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-1" data-playing="false">🔊</button>
                    <audio id="audio-index-1" src="{{ asset('sounds/materi/hal3/1.mp3') }}"></audio>
                </div>
            </div>
            <div class="materi-image-col">
                <img src="{{ asset('images/materi/jukung-mini.png') }}" class="img-fluid rounded shadow" alt="Jukung Pendek">
                <div class="materi-caption">
                    Miniatur jukung memiliki bentuk yang pendek.
                    <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-2" data-playing="false">🔊</button>
                    <audio id="audio-index-2" src="{{ asset('sounds/materi/hal3/2.mp3') }}"></audio>
                </div>
            </div>
        </div>
    </div>

    <!-- Box Tahukah Kalian: Rumah Adat -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #e3f2fd; border-left: 5px solid #1976d2; padding: 15px 18px; border-radius: 10px; font-size: 1.08rem; color: #175093; margin-bottom: 18px; box-shadow: 0 2px 8px #1976d218;">
            <strong>Tahukah Kalian?</strong><br>
            Rumah adat Banjar adalah rumah tradisional suku Banjar di Kalimantan Selatan. Rumah ini berbentuk panggung dan berdiri di atas tiang kayu agar cocok dengan daerah rawa. Rumah adat Banjar menjadi ciri khas dan kebanggaan masyarakat Banjar.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-2" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-2" src="{{ asset('sounds/materi/hal3/narasi-2.mp3') }}"></audio>
        </div>
    </div>

    <!-- Gambar dan Kalimat 2 -->
    <div class="materi-section">
        <div class="materi-image-row">
            <div class="materi-image-col">
                <img src="{{ asset('images/materi/rumahadat-big.png') }}" class="img-fluid rounded shadow" alt="Rumah Adat Banjar Tinggi">
                <div class="materi-caption">
                    Rumah Adat Banjar Anjung Surung memiliki bentuk yang tinggi.
                    <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-3" data-playing="false">🔊</button>
                    <audio id="audio-index-3" src="{{ asset('sounds/materi/hal3/3.mp3') }}"></audio>
                </div>
            </div>
            <div class="materi-image-col">
                <img src="{{ asset('images/materi/rumahadat-mini.png') }}" class="img-fluid rounded shadow" alt="Rumah Adat Mini">
                <div class="materi-caption">
                    Miniatur Rumah Adat Banjar Tadah Alas memiliki bentuk yang rendah.
                    <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-4" data-playing="false">🔊</button>
                    <audio id="audio-index-4" src="{{ asset('sounds/materi/hal3/4.mp3') }}"></audio>
                </div>
            </div>
        </div>
    </div>

    <!-- Box Tahukah Kalian: Bekantan -->
    <div class="materi-section" style="margin-bottom: 0;">
        <div class="kearifan-box" style="background: #fff3e0; border-left: 5px solid #ff9800; padding: 15px 18px; border-radius: 10px; font-size: 1.08rem; color: #a95d05; margin-bottom: 18px; box-shadow: 0 2px 8px #ff980018;">
            <strong>Tahukah Kalian?</strong><br>
            Bekantan adalah hewan yang hanya hidup di Pulau Kalimantan, yaitu di Indonesia, Malaysia, dan Brunei Darussalam. Ciri khas bekantan jantan adalah hidungnya yang besar dan panjang. Bekantan juga menjadi maskot Provinsi Kalimantan Selatan.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="narasi-3" data-playing="false" style="margin-left:7px;">🔊</button>
            <audio id="audio-narasi-3" src="{{ asset('sounds/materi/hal3/narasi-3.mp3') }}"></audio>
        </div>
    </div>

    <!-- Gambar dan Kalimat 3 -->
    <div class="materi-section">
        <div class="materi-image-row">
            <div class="materi-image-col">
                <img src="{{ asset('images/materi/bekantan-big.png') }}" class="img-fluid rounded shadow" alt="Patung Bekantan Tinggi">
                <div class="materi-caption">
                    Patung Bekantan memiliki bentuk yang tinggi.
                    <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-5" data-playing="false">🔊</button>
                    <audio id="audio-index-5" src="{{ asset('sounds/materi/hal3/5.mp3') }}"></audio>
                </div>
            </div>
            <div class="materi-image-col">
                <img src="{{ asset('images/materi/bekantan-mini.png') }}" class="img-fluid rounded shadow" alt="Miniatur Bekantan">
                <div class="materi-caption">
                    Miniatur Bekantan memiliki bentuk yang rendah.
                    <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-6" data-playing="false">🔊</button>
                    <audio id="audio-index-6" src="{{ asset('sounds/materi/hal3/6.mp3') }}"></audio>
                </div>
            </div>
        </div>
    </div>

    <!-- Dua Paragraf Penjelasan -->
    <div class="materi-section">
        <div class="materi-content">
            <span class="warna-label yellow-card">Panjang & Pendek</span>
            <br>
            Panjang dan pendek digunakan untuk membandingkan ukuran benda dari satu ujung ke ujung lainnya, biasanya dari kiri ke kanan atau sebaliknya. Benda yang membentang lebih jauh disebut panjang, sedangkan yang membentang sedikit disebut pendek. Panjang menunjukkan seberapa panjang bentuk benda.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-7" data-playing="false">🔊</button>
            <audio id="audio-index-7" src="{{ asset('sounds/materi/hal3/7.mp3') }}"></audio>
        </div>
        <div class="materi-content" style="margin-top:16px;">
            <span class="warna-label blue-card">Tinggi & Rendah</span>
            <br>
            Tinggi dan rendah digunakan untuk membandingkan ukuran benda dari bawah ke atas atau sebaliknya. Benda yang menjulang ke atas disebut tinggi, sedangkan yang hanya menjulang sedikit disebut rendah. Tinggi menunjukkan seberapa tinggi suatu benda.
            <button onclick="toggleAudio(this)" class="btn-audio" data-id="index-8" data-playing="false">🔊</button>
            <audio id="audio-index-8" src="{{ asset('sounds/materi/hal3/8.mp3') }}"></audio>
        </div>
    </div>

    <!-- Navigasi bawah -->
    <div class="materi-nav-footer">
        <a href="{{ route('admin.materi.halaman2') }}" class="btn-nav">
            ← Sebelumnya
        </a>
        <a href="{{ route('admin.materi.halaman4') }}" class="btn-nav btn-next">
            Selanjutnya →
        </a>
    </div>
</div>
<br>
@endsection

@section('scripts')
<script>
    function toggleAudio(button) {
    const id = button.getAttribute('data-id');
    const audio = document.getElementById(`audio-${id}`);

    // Pause semua audio KECUALI background music
    document.querySelectorAll('audio').forEach(a => {
        // Cek id
        if (a !== audio && a.id !== 'bg-music') {
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
