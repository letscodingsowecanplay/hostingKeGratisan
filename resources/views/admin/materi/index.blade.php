@extends('layouts.dash')

@section('content')
<div class="center-dashboard-container">

    <div style="text-align:center; margin-bottom: 18px; margin-top: -16px;">
        <h2 style="font-family:'Montserrat',Arial,sans-serif; font-weight: 700; font-size:2.1rem; color:rgb(0, 0, 0); letter-spacing:1px; margin-bottom:0;">
            Pilih Subbab Materi
        </h2>
    </div>
    <div class="dashboard-bar" id="subbab-materi-bar">

        <!-- Card Subbab 1 (Selalu Aktif) -->
        <div class="card-box red-card" id="menu-subbab-1">
            <div class="card-content-wrap">
                <div style="margin-bottom:13px;">
                    <!-- Ikon Feather: Book Open -->
                    <svg style="width: 38px; height: 38px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#bf3b45" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                </div>
                <div class="card-title ">SubBab 1
                    <button onclick="toggleAudio(this)" 
                        class="btn-audio ms-3"
                        data-id="index-0" data-playing="false"
                        style="margin-left:24px;">
                    🔊
                </button>
                <audio id="audio-index-0" src="{{ asset('sounds/materi/index/1.mp3') }}"></audio>
                </div>
                <div class="card-content ">Membandingkan dan Mengurutkan Panjang Benda</div>
                <a href="{{ route('admin.materi.halaman2') }}" class="card-btn">Buka Materi</a>
            </div>
        </div>

        <!-- Card Subbab 2 (Bisa Terkunci) -->
        <div class="card-box green-card position-relative" id="menu-subbab-2">
            <div class="card-content-wrap">
                <div style="margin-bottom:13px;">
                    <!-- Ikon Feather: Ruler (optional) -->
                    <svg style="width: 38px; height: 38px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#80b484" stroke-width="2">
                        <rect x="3" y="8" width="18" height="8" rx="2" stroke-width="2"/>
                        <path d="M6 8v8M10 8v8M14 8v8M18 8v8" stroke-width="1.4"/>
                    </svg>
                </div>
                <div class="card-title ">SubBab 2
                    <button onclick="toggleAudio(this)" 
                        class="btn-audio ms-3"
                        data-id="index-1" data-playing="false"
                        style="margin-left:24px;">
                    🔊
                </button>
                <audio id="audio-index-1" src="{{ asset('sounds/materi/index/3.mp3') }}"></audio>
                </div>
                <div class="card-content ">Mengukur Panjang Benda
                </div>
                <a id="link-subbab-2" href="{{ route('admin.materi.halaman11') }}" class="card-btn">Buka Materi</a>
                <!-- Overlay Gembok -->
                <div id="gembok-2" class="gembok-overlay d-none"
                    style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,0.72);border-radius:28px;display:flex;align-items:center;justify-content:center;z-index:3;">
                    <svg width="38" height="38" fill="none" stroke="#c92d34" stroke-width="2" viewBox="0 0 24 24">
                        <rect width="18" height="11" x="3" y="11" rx="2" stroke-width="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke-width="2"></path>
                    </svg>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
window.initKunciSidebar = function(statusLulus) {
    // DEBUG: cek data
    console.log('statusLulus:', statusLulus);

    const menus = [
        {menu: 'menu-subbab-2', gembok: 'gembok-2', prasyarat: 'ayo-berlatih-2'},
    ];
    menus.forEach(item => {
        const menuEl = document.getElementById(item.menu);
        const gembokEl = document.getElementById(item.gembok);
        const linkEl = menuEl ? menuEl.querySelector('.card-btn') : null;

        // Hati-hati: perbandingan HARUS strict, cek isi objek
        if (!statusLulus[item.prasyarat] || statusLulus[item.prasyarat] !== 'lulus') {
            // Terkunci
            if (menuEl) {
                menuEl.classList.add('disabled');
                menuEl.style.pointerEvents = 'none';
            }
            if (gembokEl) gembokEl.classList.remove('d-none');
            if (linkEl) {
                linkEl.removeAttribute('href');
                linkEl.classList.add('disabled-btn');
                linkEl.style.cursor = 'not-allowed';
                linkEl.innerHTML = `<svg width="19" height="19" fill="none" stroke="#c92d34" stroke-width="2" style="margin-right:7px;vertical-align:-4px;" viewBox="0 0 24 24">
                <rect width="18" height="11" x="3" y="11" rx="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg> Terkunci`;
            }
        } else {
            // Sudah lulus, buka kunci
            if (menuEl) {
                menuEl.classList.remove('disabled');
                menuEl.style.pointerEvents = '';
            }
            if (gembokEl) gembokEl.classList.add('d-none');
            if (linkEl) {
                linkEl.setAttribute('href', "{{ route('admin.materi.halaman11') }}");
                linkEl.classList.remove('disabled-btn');
                linkEl.style.cursor = '';
                linkEl.innerHTML = "Buka Materi";
            }
        }
    });
};

window.onload = function() {
    // Gunakan window.onload agar pasti setelah render
    window.initKunciSidebar(@json($statusLulus ?? []));
};
</script>
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

