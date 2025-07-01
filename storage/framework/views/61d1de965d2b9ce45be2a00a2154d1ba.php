

<?php $__env->startSection('content'); ?>
<div class="mb-3 fs-5" style="font-family: 'Montserrat', Arial, sans-serif;">
    <strong>Sisa Waktu :</strong> <span id="timer">30:00</span>
</div>

<div class="kuis-flexbox-container">
    <div class="soal-section shadow materi-card" id="soal-section">
        <div id="soal-container"></div>
    </div>
    <div class="navigasi-section shadow materi-card2">
        <h5 class="warna-label yellow-card mb-2" style="font-size:1.17em; font-family: 'Montserrat', Arial, sans-serif; width:100%; text-align:center;">Nomor Soal</h5>
        <div id="navigasi-nomor" class="d-flex flex-wrap gap-2 justify-content-center mb-2" style="margin-bottom:12px; width:100%;"></div>
        <div class="d-flex align-items-center mb-3" style="gap: 10px; font-size:1em;">
            <span class="badge bg-success" style="width:16px; height:16px; border-radius:5px; margin-right:4px;">&nbsp;</span> <span style="font-size:0.99em;">Aktif</span>
            <span class="badge bg-warning" style="width:16px; height:16px; border-radius:5px; margin-left:11px; margin-right:4px;">&nbsp;</span> <span style="font-size:0.99em;">Sudah</span>
            <span class="badge bg-light border" style="width:16px; height:16px; border-radius:5px; margin-left:11px; margin-right:4px;">&nbsp;</span> <span style="font-size:0.99em;">Belum</span>
        </div>
        <div class="mt-2 text-center" style="width:100%;">
            <div class="kuis-btn-grid mb-2">
                <button class="btn btn-warning btn-nav fs-5" onclick="navigasiSoal('prev')" id="btnPrev" style="font-family: 'Montserrat', Arial, sans-serif;">Sebelumnya</button>
                <button class="btn btn-warning btn-nav fs-5" onclick="navigasiSoal('next')" id="btnNext" style="font-family: 'Montserrat', Arial, sans-serif;">Selanjutnya</button>
                <button class="btn btn-success btn-nav fs-5" onclick="submitJawaban()" style="grid-column:span 2; font-family: 'Montserrat', Arial, sans-serif;">Selesai</button>
                <a href="<?php echo e(route('admin.materi.index')); ?>" class="btn btn-danger btn-nav fs-5" style="grid-column:span 2; font-family: 'Montserrat', Arial, sans-serif;">Kembali ke Materi</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade fs-5" id="hasilModal" tabindex="-1" aria-labelledby="hasilModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-coklap text-black">
      <div class="modal-header">
        <h5 class="modal-title" id="hasilModalLabel">Hasil Evaluasi</h5>
        <button type="button" class="btn-close btn-close-black" id="btnCloseModal" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center" id="hasilModalBody"></div>
      <div class="modal-footer justify-content-center" id="hasilModalFooter"></div>
      <!-- AUDIO FEEDBACK LULUS/TIDAK LULUS -->
      <audio id="audio-feedback-eval"></audio>
    </div>
  </div>
</div>   

<style>
/* Tombol audio style sama seperti petunjuk evaluasi */
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
/* Pilihan jawaban font hitam */
.pilihan-jawaban-opsi, .question-title {
    color: #222 !important;
}
</style>

<script>
const soalList = [
    {
        id: 1,
        soal: "Jenis pisang yang banyak tumbuh di daerah kalimantan memiliki ukuran paling pendek adalah ....",
        pilihan: ["Pisang mahuli", "Pisang kepok", "Pisang talas"],
        audio: "/audio/soal1.mp3"
    },
    {
        id: 2,
        soal: "Wadai khas kalimantan yang sering hadir disaat ramadhan memiliki ukuran lebih panjang adalah ....",
        pilihan: ["Talas pandan", "Putri selat", "Amparan Tatak"],
        audio: "/audio/soal2.mp3"
    },
    {
        id: 3,
        soal: "Utuh ingin membangun jembatan di belakang halaman rumahnya. Ia memiliki tiga batang kayu ulin seperti pada gambar. Di antara ketiga ukuran kayu ulin tersebut, kayu yang paling pendek adalah ....",
        pilihan: ["a", "b", "c"],
        audio: "/audio/soal3.mp3"
    },
    {
        id: 4,
        soal: "Di atas meja belajar Anang ada tiga buku dengan ukuran berbeda seperti pada gambar berikut. Urutan buku-buku tersebut berdasarkan bentuk yang paling panjang adalah ....",
        pilihan: ["a - b - c", "b - c - a", "c - a - b"],
        audio: "/audio/soal4.mp3"
    },
    {
        id: 5,
        soal: "Tanaman khas Kalimantan memiliki bentuk yang unik dan menarik. Berdasarkan gambar yang ditampilkan, urutan wadah tanaman dari yang memiliki bentuk paling rendah adalah … ",
        pilihan: ["Akar kuning-Bamban-Bangkal", "Bamban-Akar kuning-Bangkal", "Bangkal-Akar kuning-Bamban"],
        audio: "/audio/soal5.mp3"
    },
    {
        id: 6,
        soal: "Museum daerah menampilkan banyak ragam jenis kain yang ada di Kalimantan selama periode tertentu. Berdasarkan gambar, panjang kain tenun adalah .... ",
        pilihan: ["3 stik eskrim", "4 stik eskrim", "5 stik eskrim"],
        audio: "/audio/soal6.mp3"
    },
    {
        id: 7,
        soal: "Ikan diperairan kalimantan memiliki banyak jenis dan rupanya masing-masing. Panjang ikan haruan adalah ....",
        pilihan: ["4 pensil", "3 pensil", "2 pensil"],
        audio: "/audio/soal7.mp3"
    },
    {
        id: 8,
        soal: "Mangga kasturi adalah mangga spesifik yang berasal dari Kalimantan Selatan. Panjang buah mangga kasturi adalah ... penghapus.",
        pilihan: ["2", "3", "4"],
        audio: "/audio/soal8.mp3"
    },
    {
        id: 9,
        soal: "Mengkudu adalah tanaman yang banyak tumbuh di hutan Kalimantan. Panjang buah mengkudu tersebut adalah ... korek api.",
        pilihan: ["3", "4", "5"],
        audio: "/audio/soal9.mp3"
    },
    {
        id: 10,
        soal: "Buku ini merupakan buku yang mengisahkan sejarah Kalimantan dan diterbitkan pada tahun 1922. Lebar buku tersebut adalah …",
        pilihan: ["1 hasta", "1 depa", "1 jengkal"],
        audio: "/audio/soal10.mp3"
    },
];
const soalDenganAudioPilihan = [1,2,4,5,6,7,10];

let indexSoal = 0;
const jawabanUser = {};

function tampilkanSoal() {
    const data = soalList[indexSoal];
    let html = `
        <div style="font-weight:600; font-size:1.09em; color:#222; margin-bottom:8px;">
            Amati gambar berikut dengan saksama!
            <button onclick="toggleAudio(this)" 
                    class="btn-audio-2 ms-2"
                    title="Dengarkan soal"
                    data-id="kuis${data.id}" 
                    data-playing="false">🔊</button>
            <audio id="audio-kuis${data.id}" src="/sounds/evaluasi/index/${data.id}.mp3"></audio>
        </div>
        <img src="/images/evaluasi/gambarEval${data.id}.png" 
             id="soal-gambar"
             alt="Gambar Evaluasi 1 Soal ${data.id}" 
             class="rounded shadow">
        <div class="question-title mt-3 mb-2">${data.id}. ${data.soal}</div>
        <div class="pilihan-jawaban-wrap">`;

    data.pilihan.slice(0, 3).forEach((opsi, idx) => {
        const huruf = String.fromCharCode(65 + idx); // A, B, C
        const isSelected = jawabanUser[data.id] === huruf;
        html += `
            <div class="pilihan-jawaban-opsi${isSelected ? ' selected' : ''}" 
                 data-value="${huruf}" tabindex="0"
                 onclick="pilihJawaban('${data.id}','${huruf}')" 
                 onkeydown="if(event.key==='Enter'){pilihJawaban('${data.id}','${huruf}')}"
                 aria-label="Jawaban ${huruf}">
                <span class="pilihan-jawaban-huruf">${huruf}</span>
                <span style="flex:1;">${opsi}</span>
                <input type="radio" name="jawaban${data.id}" value="${huruf}" ${isSelected ? 'checked' : ''} style="display:none;">
                ${
                    soalDenganAudioPilihan.includes(data.id)
                        ? `<button type="button" class="play-pilihan-audio btn-audio-2" data-id="audio-${data.id}-${huruf}" data-audio="/sounds/evaluasi/index/pilihan/${data.id}-${huruf}.mp3">🔊</button>
                           <audio id="audio-${data.id}-${huruf}"></audio>`
                        : ''
                }
            </div>`;
    });
    html += `</div>`;
    document.getElementById('soal-container').innerHTML = html;
    inisialisasiAudioPilihan();
    updateNavState();
    renderNavigasi();
}

function inisialisasiAudioPilihan() {
    document.querySelectorAll('.play-pilihan-audio').forEach(function(btn) {
        btn.onclick = function(e) {
            e.stopPropagation();
            const audioId = btn.getAttribute('data-id');
            const src = btn.getAttribute('data-audio');
            const audioEl = document.getElementById(audioId);
            document.querySelectorAll('.play-pilihan-audio').forEach(b => { b.innerText = '🔊'; });
            document.querySelectorAll('.pilihan-jawaban-opsi audio').forEach(a => {
                if (a !== audioEl) { a.pause(); a.currentTime = 0; }
            });
            if (!audioEl.src || !audioEl.src.includes(src)) {
                audioEl.src = src;
                audioEl.load();
            }
            if (audioEl.paused) {
                audioEl.play();
                btn.innerText = '⏸️';
            } else {
                audioEl.pause();
                btn.innerText = '🔊';
            }
            audioEl.onended = function() {
                btn.innerText = '🔊';
            }
        }
    });
}

function pilihJawaban(soalId, huruf) {
    jawabanUser[soalId] = huruf;
    tampilkanSoal();
    renderNavigasi();
}

function navigasiSoal(mode) {
    if (mode === 'next' && indexSoal < soalList.length - 1) indexSoal++;
    if (mode === 'prev' && indexSoal > 0) indexSoal--;
    tampilkanSoal();
}

function renderNavigasi() {
    const container = document.getElementById('navigasi-nomor');
    if (!container) return;
    container.innerHTML = '';
    soalList.forEach((soal, i) => {
        let kelas = 'btn btn-light border';
        if (i === indexSoal) {
            kelas = 'btn btn-success';
        } else if (jawabanUser[soal.id]) {
            kelas = 'btn btn-warning';
        }
        container.innerHTML += `
            <button class="${kelas}" onclick="pindahKeSoal(${i})" style="font-weight:700;" aria-label="Soal ${soal.id}">${soal.id}</button>
        `;
    });
    updateNavState();
}

function pindahKeSoal(i) {
    indexSoal = i;
    tampilkanSoal();
}

function updateNavState() {
    document.getElementById('btnPrev').disabled = indexSoal === 0;
    document.getElementById('btnNext').disabled = indexSoal === soalList.length - 1;
}

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
        audio.play(); button.innerText = '⏸️'; button.setAttribute('data-playing', 'true');
    } else {
        audio.pause(); button.innerText = '🔊'; button.setAttribute('data-playing', 'false');
    }
    audio.onended = function () {
        button.innerText = '🔊'; button.setAttribute('data-playing', 'false');
    };
}

function submitJawaban() {
    let adaYangBelumDijawab = false;
    soalList.forEach(soal => {
        if (!jawabanUser[soal.id]) adaYangBelumDijawab = true;
    });
    if (adaYangBelumDijawab) {
        alert("Anda belum menjawab semua soal!");
        return;
    }
    fetch('<?php echo e(route("admin.evaluasi.simpan")); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({jawaban: jawabanUser})
    })
    .then(response => {
        if (!response.ok) return response.json().then(err => { throw err; });
        return response.json();
    })
    .then(data => {
        const hasilBody = document.getElementById('hasilModalBody');
        const hasilFooter = document.getElementById('hasilModalFooter');
        hasilBody.innerHTML = `
            <p><strong>Nama:</strong> <?php echo e(Auth::user()->name); ?></p>
            <p><strong>Kelas:</strong> 1</p>
            <p><strong>Sekolah:</strong> SD Banjarmasin</p>
            <p><strong>Email:</strong> <?php echo e(Auth::user()->email); ?></p>
            <p><strong>Nilai Evaluasi:</strong> ${data.skor}</p>
            <p class="text-${data.skor_persen >= 70 ? 'success' : 'danger'} fw-bold">
                ${data.skor_persen >= 70 
                    ? 'Selamat, anda lulus Evaluasi!'
                    : 'Maaf, anda belum lulus. Silahkan ulangi kuis.'}
            </p>
        `;
        if (data.skor_persen >= 70) {
            hasilFooter.innerHTML = `<button class="btn btn-secondary" id="selesaiEvaluasi">Selesai</button>`;
        } else {
            hasilFooter.innerHTML = `<button class="btn btn-warning" id="ulangiKuis">Ulangi Kuis</button>`;
        }

        // Play audio feedback KKM
        const audioFeedback = document.getElementById('audio-feedback-eval');
        if(data.skor_persen >= 70){
            audioFeedback.src = "/sounds/evaluasi/index/benar.mp3";
        } else {
            audioFeedback.src = "/sounds/evaluasi/index/salah.mp3";
        }
        audioFeedback.currentTime = 0;
        setTimeout(()=>audioFeedback.play(), 80);

        // Show modal
        const modalEl = document.getElementById('hasilModal');
        const modal = new bootstrap.Modal(modalEl, {keyboard: true, backdrop: true});
        modal.show();

        // Tombol ulangi kuis
        document.getElementById('ulangiKuis')?.addEventListener('click', () => {
            window.location.href = "<?php echo e(route('admin.evaluasi.index')); ?>";
        });
        // Tombol selesai
        document.getElementById('selesaiEvaluasi')?.addEventListener('click', () =>{
            window.location.href = "<?php echo e(route('admin.evaluasi.petunjuk')); ?>";
        });
        // Tombol X
        document.getElementById('btnCloseModal').addEventListener('click', function(){
            window.location.href = "<?php echo e(route('admin.evaluasi.petunjuk')); ?>";
        });
        // Klik backdrop/luar modal
        modalEl.addEventListener('hidden.bs.modal', function(){
            window.location.href = "<?php echo e(route('admin.evaluasi.petunjuk')); ?>";
        }, {once:true});
    })
    .catch(error => {
        console.error('Error details:', error);
        let errorMsg = "Gagal menyimpan jawaban";
        if (error.message) errorMsg += ": " + error.message;
        else if (error.errors) errorMsg += ": " + JSON.stringify(error.errors);
        alert(errorMsg);
    });
}

// Timer
let waktu = 30 * 60;
const timerElement = document.getElementById('timer');
setInterval(() => {
    const menit = Math.floor(waktu / 60);
    const detik = waktu % 60;
    timerElement.innerText = `${menit}:${detik.toString().padStart(2, '0')}`;
    if (waktu > 0) waktu--;
}, 1000);

tampilkanSoal();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-kuis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/evaluasi/index.blade.php ENDPATH**/ ?>