<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;
use App\Models\Kkm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class MateriController extends Controller
{
    public function index()
    {
        return view('admin.materi.index', [
            'nomorHalaman' => 1,
        ]);
        
    }

    public function halamanDua()
    {
        return view('admin.materi.halaman2', [
            'nomorHalaman' => 2,
        ]);
    }

    public function halamanTiga()
    {
        return view('admin.materi.halaman3', [
            'nomorHalaman' => 3,
        ]);
    }

    public function halamanEmpat()
    {
        $nomorHalaman = 4;
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-1';

        // Ambil KKM dari tabel
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = $nilai !== null;
        $skor = $nilai->skor ?? 0;
        $status = $nilai->status ?? null;

        $kunci = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'b',
            'soal4' => 'a',
        ];

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        return view('admin.materi.halaman4', compact(
            'sudahMenjawab', 'skor', 'kkm', 'status', 'jawabanUser', 'kunci', 'nomorHalaman'
        ));
    }

    public function simpanHalamanEmpat(Request $request)
    {
        $request->validate([
            'jawaban.soal1' => 'required',
            'jawaban.soal2' => 'required',
            'jawaban.soal3' => 'required',
            'jawaban.soal4' => 'required',
        ]);

        $jawaban = $request->input('jawaban');
        if (!is_array($jawaban)) {
            return back()->with('error', 'Format jawaban tidak valid.');
        }

        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-1';

        $kunci = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'b',
            'soal4' => 'a',
        ];

        $jumlahSoal = count($kunci);
        $bobotPerSoal = 25;
        $jumlahBenar = 0;

        foreach ($kunci as $soal => $jawabanBenar) {
            if (isset($jawaban[$soal]) && $jawaban[$soal] === $jawabanBenar) {
                $jumlahBenar++;
            }
        }

        $skor = $jumlahBenar * $bobotPerSoal; // Nilai akhir untuk disimpan di DB

        // Ambil nilai KKM dari tabel kkm
        $kkmRecord = \App\Models\Kkm::where('kuis_id', $kuisId)->first();
        $kkm = $kkmRecord?->kkm ?? 75; // fallback ke 75 (misal 3 soal benar dari 4 = 75)

        $status = $skor >= $kkm ? 'lulus' : 'tidak_lulus';
        $now = now();

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        if ($nilai) {
            $nilai->update([
                'skor' => $skor,
                'total_soal' => $jumlahSoal,
                'jawaban' => $jawaban,
                'status' => $status,
                'updated_at' => $now,
            ]);
        } else {
            \App\Models\Nilai::create([
                'user_id' => $userId,
                'kuis_id' => $kuisId,
                'skor' => $skor,
                'total_soal' => $jumlahSoal,
                'jawaban' => $jawaban,
                'status' => $status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return redirect()->route('admin.materi.halaman4')
            ->with('success', "Nilai berhasil disimpan! Nilai Anda: $skor dari " . ($jumlahSoal * $bobotPerSoal) . ". KKM: $kkm");
    }

    public function jawabHal4(Request $request)
    {
        $no = intval($request->input('no'));
        $jawaban = $request->input('jawaban');
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-1';

        // Validasi sederhana
        if (!in_array($no, [1,2,3,4]) || !in_array($jawaban, ['a','b'])) {
            return response()->json(['success' => false, 'msg' => 'Data tidak valid!']);
        }

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        // Sudah pernah jawab?
        if (isset($jawabanUser['soal'.$no])) {
            return response()->json(['success' => false, 'msg' => 'Sudah menjawab!']);
        }

        // Simpan jawaban ke array
        $jawabanUser['soal'.$no] = $jawaban;
        $kunci = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'b',
            'soal4' => 'a',
        ];
        $jumlahBenar = 0;
        foreach ($kunci as $key => $val) {
            if (isset($jawabanUser[$key]) && $jawabanUser[$key] === $val) $jumlahBenar++;
        }
        $bobotPerSoal = 25;
        $skor = $jumlahBenar * $bobotPerSoal;
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;
        $status = $skor >= $kkm ? 'lulus' : 'tidak_lulus';
        $now = now();

        // Simpan/Update
        if ($nilai) {
            $nilai->update([
                'skor' => $skor,
                'total_soal' => 4,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'updated_at' => $now,
            ]);
        } else {
            \App\Models\Nilai::create([
                'user_id' => $userId,
                'kuis_id' => $kuisId,
                'skor' => $skor,
                'total_soal' => 4,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Feedback, custom audio & text per soal-jawaban
        $kunciJawaban = $kunci['soal'.$no];
        $benar = $jawaban === $kunciJawaban;

        // Pilih audio sesuai soal dan status benar/salah
        $audio = $benar
            ? asset("sounds/materi/hal4/benar_{$no}.mp3")
            : asset("sounds/materi/hal4/salah_{$no}.mp3");

        $feedbackText = [
            1 => [
                'benar' => 'Jawaban kamu benar. Pilihan B adalah ikan yang bentuknya panjang.',
                'salah' => 'Jawaban kamu salah. Yang benar adalah ikan pada pilihan B yang bentuknya panjang.',
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Pilihan A adalah olahan iwak wadi yang bentuknya pendek.',
                'salah' => 'Jawaban kamu salah. Yang benar adalah iwak wadi pada pilihan A yang bentuknya pendek.',
            ],
            3 => [
                'benar' => 'Jawaban kamu benar. Pilihan B adalah tempat biji-bijian yang tergantung tinggi.',
                'salah' => 'Jawaban kamu salah. Yang benar adalah tempat biji-bijian pada pilihan B yang tergantung paling tinggi.',
            ],
            4 => [
                'benar' => 'Jawaban kamu benar. Pilihan A adalah jam dinding rotan yang tergantung paling rendah.',
                'salah' => 'Jawaban kamu salah. Yang benar adalah jam dinding rotan pada pilihan A yang tergantung paling rendah.',
            ],
        ];

        $judul = $benar ? 'Jawaban Benar' : 'Jawaban Salah';

        $feedback = [
            'benar' => $benar,
            'judul' => $judul,
            'text' => $feedbackText[$no][$benar ? 'benar' : 'salah'],
            'audio' => $audio,
            'kunci' => strtoupper($kunciJawaban)
        ];

        $semuaSudah = count($jawabanUser) === 4;

        return response()->json([
            'success' => true,
            'feedback' => $feedback,
            'benar' => $benar,
            'penjelasan' => $feedback['text'],
            'kunci' => $feedback['kunci'],
            'skor' => $skor,
            'kkm' => $kkm,
            'status' => $status,
            'semua_sudah' => $semuaSudah,
            'soal_selanjutnya' => $no < 4 ? $no+1 : null,
        ]);
    }


    public function resetHalamanEmpat()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-mencoba-1')
            ->delete(); // observer akan jalan di sini

        return redirect()->route('admin.materi.halaman4')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }

    public function halamanLima()
    {
        $nomorHalaman = 5;
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-1';

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = $nilai !== null && is_array($nilai->jawaban) && count($nilai->jawaban) === 4;
        $skor = $nilai->skor ?? 0;

        $kunci = [
            'soal1' => 'pendek',
            'soal2' => 'panjang',
            'soal3' => 'tinggi',
            'soal4' => 'rendah'
        ];

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        return view('admin.materi.halaman5', compact('sudahMenjawab', 'skor', 'kkm', 'kunci', 'jawabanUser', 'nomorHalaman'));
    }

    public function jawabHal5(Request $request)
    {
        $no = intval($request->input('no'));
        $jawaban = strtolower($request->input('jawaban'));
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-1';

        if (!in_array($no, [1,2,3,4]) || !in_array($jawaban, ['panjang','pendek','tinggi','rendah'])) {
            return response()->json(['success' => false, 'msg' => 'Data tidak valid!']);
        }

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        // Sudah pernah jawab soal ini?
        if (isset($jawabanUser['soal'.$no])) {
            return response()->json(['success' => false, 'msg' => 'Sudah menjawab soal ini!']);
        }

        $jawabanUser['soal'.$no] = $jawaban;

        $kunci = [
            'soal1' => 'pendek',
            'soal2' => 'panjang',
            'soal3' => 'tinggi',
            'soal4' => 'rendah'
        ];

        $penjelasan = [
            1 => [
                'benar' => 'Jawaban kamu benar. Sendok nasi memang berukuran pendek daripada sutil.',
                'salah' => 'Jawaban kamu salah. Perhatikan ukuran sendok nasi dengan sutil pada gambar.'
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Kotak tisu memang berukuran panjang dari kotak pensil.',
                'salah' => 'Jawaban kamu salah. Perhatikan ukuran kotak tisu dengan kotak pensil pada gambar.'
            ],
            3 => [
                'benar' => 'Jawaban kamu benar. Tugu asli memang berukuran tinggi dari versi miniaturnya.',
                'salah' => 'Jawaban kamu salah. Perhatikan perbandingan tugu asli dengan miniatur pada gambar.'
            ],
            4 => [
                'benar' => 'Jawaban kamu benar. Miniatur perisai dayak memang berukuran rendah dari aslinya.',
                'salah' => 'Jawaban kamu salah. Perhatikan perbandingan miniatur perisai dayak dengan aslinya pada gambar.'
            ],
        ];

        $jumlahBenar = 0;
        foreach ($kunci as $key => $val) {
            if (isset($jawabanUser[$key]) && strtolower($jawabanUser[$key]) === $val) $jumlahBenar++;
        }
        $bobotPerSoal = 25;
        $skor = $jumlahBenar * $bobotPerSoal;

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;
        $status = $skor >= $kkm ? 'lulus' : 'tidak_lulus';
        $now = now();

        // Save ke DB (sekali submit, update)
        if ($nilai) {
            $nilai->update([
                'skor' => $skor,
                'total_soal' => 4,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'updated_at' => $now,
            ]);
        } else {
            \App\Models\Nilai::create([
                'user_id' => $userId,
                'kuis_id' => $kuisId,
                'skor' => $skor,
                'total_soal' => 4,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $kunciJawab = $kunci['soal'.$no];
        $isCorrect = $jawaban === $kunciJawab;
        $explainType = $isCorrect ? 'benar' : 'salah';
        $feedbackText = $penjelasan[$no][$explainType];

        // Feedback dengan audio berbeda untuk tiap soal dan benar/salah
        $feedback = [
            'img' => asset('images/feedback/' . ($isCorrect ? 'benar' : 'salah') . '.png'),
            'audio' => asset('sounds/materi/hal5/' . ($isCorrect ? 'benar_' : 'salah_') . $no . '.mp3'),
            'judul' => $isCorrect ? 'Jawaban Benar' : 'Jawaban Salah',
            'text' => $feedbackText,
            'kunci' => ucfirst($kunciJawab),
            'benar' => $isCorrect,
        ];

        // Cek first unanswered
        $soalSelanjutnya = null;
        foreach ([1,2,3,4] as $next) {
            if (!isset($jawabanUser['soal'.$next])) {
                $soalSelanjutnya = $next;
                break;
            }
        }
        $semuaSudah = count($jawabanUser) === 4;

        return response()->json([
            'success' => true,
            'feedback' => $feedback,
            'benar' => $isCorrect,
            'penjelasan' => $feedbackText,
            'kunci' => $kunciJawab,
            'user_answer' => $jawaban,
            'skor' => $skor,
            'kkm' => $kkm,
            'status' => $status,
            'soal_selanjutnya' => $soalSelanjutnya,
            'semua_sudah' => $semuaSudah,
        ]);
    }

    public function simpanHalamanLima(Request $request)
    {
        // Tidak perlu dipakai, AJAX per soal
        return redirect()->route('admin.materi.halaman5');
    }

    public function resetHalamanLima()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-berlatih-1')
            ->delete();

        return redirect()->route('admin.materi.halaman5')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }


    public function halamanEnam()
    {
        return view('admin.materi.halaman6', [
            'nomorHalaman' => 6,
        ]);
    }

    public function halaman7()
    {
        return view('admin.materi.halaman7', [
            'nomorHalaman' => 7,
        ]);
    }

    public function halaman8()
    {
        return view('admin.materi.halaman8', [
            'nomorHalaman' => 8,
        ]);
    }

    public function halaman9()
    {
        $nomorHalaman = 9;
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-2';

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;

        $nilaiRecord = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = is_array($nilaiRecord?->jawaban) && count($nilaiRecord->jawaban) === 4;
        $skor = $nilaiRecord->skor ?? 0;
        $status = $nilaiRecord->status ?? null;

        $kunciJawaban = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'a',
            'soal4' => 'a',
        ];

        $jawabanUser = is_array($nilaiRecord?->jawaban) ? $nilaiRecord->jawaban : [];

        return view('admin.materi.halaman9', compact(
            'sudahMenjawab', 'skor', 'kkm', 'jawabanUser', 'status', 'kunciJawaban', 'nomorHalaman'
        ));
    }

    // AJAX per soal
    public function jawabHalaman9(Request $request)
    {
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-2';
        $no = intval($request->input('no'));
        $jawaban = strtolower($request->input('jawaban'));

        if (!in_array($no, [1,2,3,4]) || !in_array($jawaban, ['a','b'])) {
            return response()->json(['success' => false, 'msg' => 'Data tidak valid!']);
        }

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        // Sudah pernah jawab?
        if (isset($jawabanUser['soal'.$no])) {
            return response()->json(['success' => false, 'msg' => 'Sudah menjawab soal ini!']);
        }
        $jawabanUser['soal'.$no] = $jawaban;

        $kunci = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'a',
            'soal4' => 'a'
        ];

        $penjelasan = [
            1 => [
                'a' => 'Jawaban kamu benar. Badik Ashu A memang lebih panjang di antara pilihan.',
                'b' => 'Jawaban kamu salah. Badik Ashu A lebih pendek daripada B.'
            ],
            2 => [
                'a' => 'Jawaban kamu benar. Guci A adalah yang lebih tinggi dibandingkan yang lain.',
                'b' => 'Jawaban kamu salah. Guci B tidak lebih tinggi dari A.'
            ],
            3 => [
                'a' => 'Jawaban kamu benar. Dayung kelotok A yang lebih panjang.',
                'b' => 'Jawaban kamu salah. Dayung kelotok B lebih pendek daripada A.'
            ],
            4 => [
                'a' => 'Jawaban kamu benar. Mandau A tergantung di posisi lebih rendah.',
                'b' => 'Jawaban kamu salah. Mandau B posisinya tidak lebih rendah dari A.'
            ],
        ];

        $jumlahBenar = 0;
        foreach ($kunci as $key => $kunciJawab) {
            if (isset($jawabanUser[$key]) && $jawabanUser[$key] === $kunciJawab) $jumlahBenar++;
        }
        $bobotPerSoal = 25;
        $skor = $jumlahBenar * $bobotPerSoal;

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;
        $status = $skor >= $kkm ? 'lulus' : 'tidak_lulus';
        $now = now();

        if ($nilai) {
            $nilai->update([
                'skor' => $skor,
                'total_soal' => 4,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'updated_at' => $now,
            ]);
        } else {
            \App\Models\Nilai::create([
                'user_id' => $userId,
                'kuis_id' => $kuisId,
                'skor' => $skor,
                'total_soal' => 4,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $kunciJawab = $kunci['soal'.$no];
        $isCorrect = $jawaban === $kunciJawab;
        $explain = $penjelasan[$no][$jawaban];

        // Feedback pop up (gambar, suara, judul, text, kunci)
        $feedback = [
            'benar' => [
                'img' => asset('images/feedback/benar.png'),
                'audio' => asset('sounds/materi/hal9/benar.mp3'),
            ],
            'salah' => [
                'img' => asset('images/feedback/salah.png'),
                'audio' => asset('sounds/materi/hal9/salah.mp3'),
            ]
        ];

        $soalSelanjutnya = null;
        foreach ([1,2,3,4] as $next) {
            if (!isset($jawabanUser['soal'.$next])) {
                $soalSelanjutnya = $next;
                break;
            }
        }
        $semuaSudah = count($jawabanUser) === 4;

        return response()->json([
            'success' => true,
            'benar' => $isCorrect,
            'feedback' => [
                'img' => $feedback[$isCorrect ? 'benar' : 'salah']['img'],
                'audio' => $feedback[$isCorrect ? 'benar' : 'salah']['audio'],
                'judul' => $isCorrect ? 'Jawaban Benar' : 'Jawaban Salah',
                'text' => $explain,
                'kunci' => strtoupper($kunciJawab),
            ],
            'user_answer' => $jawaban,
            'kunci' => $kunciJawab,
            'penjelasan' => $explain,
            'skor' => $skor,
            'kkm' => $kkm,
            'status' => $status,
            'soal_selanjutnya' => $soalSelanjutnya,
            'semua_sudah' => $semuaSudah,
        ]);
    }

    public function simpanHalaman9(Request $request)
    {
        // Dibiarkan, hanya untuk fallback
        return redirect()->route('admin.materi.halaman9');
    }

    public function resetHalaman9()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-mencoba-2')
            ->delete();
        return redirect()->route('admin.materi.halaman9')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }

    private function getSoalHalaman10()
    {
        return [
            [
                'pertanyaan' => 'Urutan miniatur Rumah Banjar berdasarkan bentuk dari yang paling tinggi adalah ....',
                'gambar' => 'soal1.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'a-b-c',
                    'b' => 'b-a-c',
                    'c' => 'c-b-a'
                ],
                'jawaban' => 'a',
            ],
            [
                'pertanyaan' => 'Urutan tas kerajinan khas Kalimantan berdasarkan ketinggiannya saat digantung, dari yang paling rendah adalah ....',
                'gambar' => 'soal2.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'a-b-c',
                    'b' => 'c-b-a',
                    'c' => 'b-c-a'
                ],
                'jawaban' => 'b',
            ],
            [
                'pertanyaan' => 'Urutan kerajinan patung Dayak berdasarkan bentuknya, dari yang paling tinggi adalah ....',
                'gambar' => 'soal3.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'b-c-a',
                    'b' => 'b-a-c',
                    'c' => 'c-a-b'
                ],
                'jawaban' => 'b',
            ],
            [
                'pertanyaan' => 'Urutan vas bunga akar keladi berdasarkan bentuknya, dari yang paling rendah adalah ....',
                'gambar' => 'soal4.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'a-c-b',
                    'b' => 'c-b-a',
                    'c' => 'a-b-c'
                ],
                'jawaban' => 'b',
            ],
            [
                'pertanyaan' => 'Urutan kain sasirangan berdasarkan bentuknya, dari yang paling panjang adalah ....',
                'gambar' => 'soal5.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'a-b-c',
                    'b' => 'c-b-a',
                    'c' => 'a-c-b'
                ],
                'jawaban' => 'c',
            ],
        ];
    }

    public function halaman10(Request $request)
    {
        $nomorHalaman = 10;
        $kuisId = 'ayo-berlatih-2';
        $soal = $this->getSoalHalaman10();

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;

        $userId = auth()->id();
        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $status = $nilai->status ?? null;
        $skor = $nilai->skor ?? null;
        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        $kunciJawaban = array_column($soal, 'jawaban');

        return view('admin.materi.halaman10', compact(
            'soal', 'kkm', 'skor', 'status',
            'kunciJawaban', 'jawabanUser', 'nomorHalaman',
        ));
    }


    public function submitHalaman10(Request $request)
    {
        $kuisId = 'ayo-berlatih-2';
        $soal = $this->getSoalHalaman10();

        $rules = [];
        foreach ($soal as $index => $item) {
            $rules["jawaban_$index"] = 'required|in:' . implode(',', array_keys($item['pilihan']));
        }
        $request->validate($rules);

        $totalSoal = count($soal);
        $jumlahBenar = 0;
        $jawaban = [];

        foreach ($soal as $index => $item) {
            $jawaban[$index] = $request->input("jawaban_$index");
            if ($jawaban[$index] === $item['jawaban']) {
                $jumlahBenar++;
            }
        }

        $bobotPerSoal = 20;
        $skor = $jumlahBenar * $bobotPerSoal;

        // Ambil nilai KKM dari DB, KKM diasumsikan skor minimal (misal 60, 80, dll)
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 60; // Default 60
        $status = $skor >= $kkm ? 'lulus' : 'tidak_lulus';

        \App\Models\Nilai::updateOrCreate(
            ['user_id' => auth()->id(), 'kuis_id' => $kuisId],
            [
                'skor' => $skor,
                'total_soal' => $totalSoal,
                'jawaban' => $jawaban,
                'status' => $status,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return redirect()->route('admin.materi.halaman10')
            ->with('success', "Jawaban berhasil disimpan! Nilai Anda: $skor dari " . ($totalSoal * $bobotPerSoal) . ". KKM: $kkm");
    }

    public function jawabHalaman10(Request $request)
    {
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-2';
        $soal = $this->getSoalHalaman10();

        $index = intval($request->input('index'));
        $jawaban = $request->input('jawaban');
        if (!isset($soal[$index])) {
            return response()->json(['success' => false, 'msg' => 'Soal tidak ditemukan.']);
        }
        $item = $soal[$index];
        $kunci = $item['jawaban'];
        $benar = $jawaban === $kunci;

        // Penjelasan dari blade
        $penjelasan = [
            0 => [
                'benar' => 'Jawaban kamu benar. Urutan miniatur rumah banjar dari yang paling tinggi adalah a-b-c.',
                'salah' => 'Jawaban kamu salah. Perhatikan kembali urutan tinggi rumah pada gambar.'
            ],
            1 => [
                'benar' => 'Jawaban kamu benar. Tas kerajinan khas Kalimantan yang digantung paling rendah adalah c-b-a.',
                'salah' => 'Jawaban kamu salah. Lihat kembali posisi tas pada gambar.'
            ],
            2 => [
                'benar' => 'Jawaban kamu benar. Urutan patung dayak fiber glass dari yang paling panjang adalah b, a, lalu c sesuai gambar.',
                'salah' => 'Jawaban kamu salah. Cermati kembali ukuran patung.'
            ],
            3 => [
                'benar' => 'Jawaban kamu benar. Urutan vas bunga akar keladi dari yang paling pendek adalah c, lalu b, dan paling tinggi a.',
                'salah' => 'Jawaban kamu salah. Perhatikan kembali ukuran vas pada gambar.'
            ],
            4 => [
                'benar' => 'Jawaban kamu benar. Urutan kain sasirangan dari yang paling panjang adalah a, lalu c, lalu b.',
                'salah' => 'Jawaban kamu salah. Lihat kembali panjang kain pada gambar.'
            ],
        ];

        // Ambil jawaban lama
        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];
        // Sudah pernah jawab? Tidak boleh ulangi
        if (isset($jawabanUser[$index])) {
            return response()->json(['success' => false, 'msg' => 'Soal ini sudah dijawab, tidak bisa diulang!']);
        }
        $jawabanUser[$index] = $jawaban;

        // Hitung skor sementara
        $jumlahBenar = 0;
        foreach ($soal as $i => $s) {
            if (isset($jawabanUser[$i]) && $jawabanUser[$i] === $s['jawaban']) {
                $jumlahBenar++;
            }
        }

        $totalSoal = count($soal);
        $bobotPerSoal = 20;
        $skor = $jumlahBenar * $bobotPerSoal;
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 60;
        $status = count($jawabanUser) == $totalSoal ? ($skor >= $kkm ? 'lulus' : 'tidak_lulus') : null;

        // Simpan ke DB
        if ($nilai) {
            $nilai->update([
                'skor' => $skor,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'updated_at' => now(),
            ]);
        } else {
            \App\Models\Nilai::create([
                'user_id' => $userId,
                'kuis_id' => $kuisId,
                'skor' => $skor,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'total_soal' => $totalSoal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Data feedback popup
        $benarSalah = $benar ? 'benar' : 'salah';
        $img = asset($benar ? 'images/icons/benar.png' : 'images/icons/salah.png');
        $audio = asset($benar ? 'sounds/benar.mp3' : 'sounds/salah.mp3');
        $feedback = [
            'judul' => $benar ? 'Jawaban Benar!' : 'Jawaban Salah',
            'text' => $penjelasan[$index][$benarSalah],
            'img' => $img,
            'kunci' => strtoupper($kunci),
            'audio' => $audio,
        ];

        // Hitung soal selanjutnya
        $soalSelanjutnya = false;
        for($i=$index+1; $i<$totalSoal; $i++) {
            if (!isset($jawabanUser[$i])) {
                $soalSelanjutnya = $i+1; // id="soal-{{$no}}"
                break;
            }
        }

        return response()->json([
            'success' => true,
            'benar' => $benar,
            'penjelasan' => $penjelasan[$index][$benarSalah],
            'kunci' => strtoupper($kunci),
            'feedback' => $feedback,
            'soal_selanjutnya' => $soalSelanjutnya,
            'semua_sudah' => count($jawabanUser) == $totalSoal,
            'skor' => $skor,
            'status' => $status,
        ]);
    }

    public function resetHalaman10(Request $request)
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-berlatih-2')
            ->delete();

        return redirect()->route('admin.materi.halaman10')->with('success', 'Kuis berhasil direset.');
    }


    public function halaman11()
    {
        return view('admin.materi.halaman11', [
            'nomorHalaman' => 11,
        ]);
    }

    public function halaman12()
    {
        return view('admin.materi.halaman12', [
            'nomorHalaman' => 12,
        ]);
    }

    public function halaman13()
    {
        return view('admin.materi.halaman13', [
            'nomorHalaman' => 13,
        ]);
    }

    public function halaman14()
    {
        return view('admin.materi.halaman14', [
            'nomorHalaman' => 14,
        ]);
    }

    // Tambahkan pada controller materi
    public function halaman15()
    {
        $nomorHalaman = 15;
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-3';
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];
        $skor = $nilai->skor ?? null;
        $status = $nilai->status ?? null;
        $sudahMenjawab = $nilai !== null;
        $kunci = [
            'soal1' => 'salah',
            'soal2' => 'benar',
            'soal3' => 'salah',
            'soal4' => 'benar'
        ];

        return view('admin.materi.halaman15', compact('sudahMenjawab', 'skor', 'kkm', 'kunci', 'jawabanUser', 'status', 'nomorHalaman'));
    }

    // AJAX: Jawab per soal
    public function jawabHalaman15(Request $request)
    {
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-3';
        $soalIdx = (int) $request->soal;
        $jawaban = strtolower($request->jawaban);

        $soalList = [
            1 => ['gambar' => 'soal1.png', 'teks' => 'Tinggi wadai cincin setara dengan 3 stik es krim.'],
            2 => ['gambar' => 'soal2.png', 'teks' => 'Panjang diameter buah asam payak setara dengan 1 koin.'],
            3 => ['gambar' => 'soal3.png', 'teks' => 'Panjang buah ulin setara dengan 9 kotak.'],
            4 => ['gambar' => 'soal4.png', 'teks' => 'Panjang tempat penyimpanan gaharu setara dengan 1 pensil.'],
        ];
        $kunci = [
            1 => 'salah', 2 => 'benar', 3 => 'salah', 4 => 'benar'
        ];
        $penjelasan = [
            1 => [
                'benar' => 'Jawaban benar. Tinggi wadai cincin memang tidak setara dengan 3 stik es krim.',
                'salah' => 'Jawaban kurang tepat. Tinggi wadai cincin pada gambar tidak sama dengan 3 stik es krim.'
            ],
            2 => [
                'benar' => 'Jawaban benar. Diameter buah asam payak pada gambar tepat sama dengan 1 koin.',
                'salah' => 'Jawaban kurang tepat. Diameter buah asam payak sebenarnya tepat sama dengan 1 koin.'
            ],
            3 => [
                'benar' => 'Jawaban benar. Panjang buah ulin di gambar tidak setara dengan 9 kotak.',
                'salah' => 'Jawaban kurang tepat. Panjang buah ulin pada gambar tidak setara dengan 9 kotak.'
            ],
            4 => [
                'benar' => 'Jawaban benar. Panjang tempat penyimpanan gaharu pada gambar sama dengan 1 pensil.',
                'salah' => 'Jawaban kurang tepat. Panjang tempat penyimpanan gaharu sebenarnya sama dengan 1 pensil.'
            ]
        ];

        // Cek sudah jawab
        $nilai = \App\Models\Nilai::where('user_id', $userId)->where('kuis_id', $kuisId)->first();
        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        if (isset($jawabanUser["soal$soalIdx"])) {
            return response()->json(['success'=>false, 'msg'=>'Soal ini sudah dijawab, tidak bisa diulang!']);
        }

        $jawabanUser["soal$soalIdx"] = $jawaban;

        // Hitung benar
        $jumlahBenar = 0;
        foreach ($kunci as $i => $kunciJawab) {
            if (isset($jawabanUser["soal$i"]) && $jawabanUser["soal$i"] === $kunciJawab) {
                $jumlahBenar++;
            }
        }
        $totalSoal = count($kunci);
        $bobotPerSoal = 25;
        $skor = $jumlahBenar * $bobotPerSoal;
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;
        $status = count($jawabanUser) == $totalSoal ? ($skor >= $kkm ? 'lulus' : 'tidak_lulus') : null;

        // Simpan
        if ($nilai) {
            $nilai->update([
                'skor' => $skor,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'updated_at' => now(),
            ]);
        } else {
            \App\Models\Nilai::create([
                'user_id' => $userId,
                'kuis_id' => $kuisId,
                'skor' => $skor,
                'jawaban' => $jawabanUser,
                'status' => $status,
                'total_soal' => $totalSoal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $benar = $jawaban === $kunci[$soalIdx];
        $img = asset($benar ? 'images/icons/benar.png' : 'images/icons/salah.png');
        $audio = asset($benar ? 'sounds/benar.mp3' : 'sounds/salah.mp3');
        $benarSalah = $benar ? 'benar' : 'salah';

        // Cari soal berikutnya
        $soalSelanjutnya = false;
        for($i=$soalIdx+1; $i<=$totalSoal; $i++) {
            if (!isset($jawabanUser["soal$i"])) {
                $soalSelanjutnya = $i;
                break;
            }
        }

        return response()->json([
            'success'=>true,
            'benar'=>$benar,
            'penjelasan'=>$penjelasan[$soalIdx][$benarSalah],
            'kunci'=>ucfirst($kunci[$soalIdx]),
            'feedback'=>[
                'judul'=>$benar ? 'Jawaban Benar!' : 'Jawaban Salah',
                'text'=>$penjelasan[$soalIdx][$benarSalah],
                'img'=>$img,
                'kunci'=>ucfirst($kunci[$soalIdx]),
                'audio'=>$audio,
            ],
            'soal_selanjutnya'=>$soalSelanjutnya,
            'semua_sudah'=>count($jawabanUser) == $totalSoal,
            'skor'=>$skor,
            'status'=>$status,
        ]);
    }

    // RESET KUIS
    public function resetHalaman15()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-mencoba-3')
            ->delete();

        return redirect()->route('admin.materi.halaman15')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }

    public function halaman16()
    {
        $nomorHalaman = 16;
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-3';

        // Ambil KKM dari tabel
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 60;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];
        $skor = $nilai->skor ?? null;
        $status = $nilai->status ?? null;
        $sudahMenjawab = $nilai !== null;

        return view('admin.materi.halaman16', compact('sudahMenjawab', 'skor', 'kkm', 'jawabanUser', 'status', 'nomorHalaman'));
    }

    public function simpanHalaman16(Request $request)
    {
        $request->validate([
            'jawaban.soal1' => 'required|numeric',
            'jawaban.soal2' => 'required|numeric',
            'jawaban.soal3' => 'required|numeric',
            'jawaban.soal4' => 'required|numeric',
            'jawaban.soal5' => 'required|numeric',
        ]);

        $jawaban = $request->input('jawaban');
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-3';

        $kunci = [
            'soal1' => 5,
            'soal2' => 5,
            'soal3' => 4,
            'soal4' => 7,
            'soal5' => 7,
        ];

        $jumlahBenar = 0;
        foreach ($kunci as $soal => $jawabanBenar) {
            if (isset($jawaban[$soal]) && (int)$jawaban[$soal] === $jawabanBenar) {
                $jumlahBenar++;
            }
        }

        $bobotPerSoal = 20;
        $skor = $jumlahBenar * $bobotPerSoal;

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 60;
        $status = $skor >= $kkm ? 'lulus' : 'tidak_lulus';

        \App\Models\Nilai::updateOrCreate(
            ['user_id' => $userId, 'kuis_id' => $kuisId],
            [
                'skor' => $skor,
                'total_soal' => count($kunci),
                'jawaban' => $jawaban,
                'status' => $status,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return response()->json([
            'skor' => $skor,
            'status' => $status,
            'kkm' => $kkm
        ]);
    }


    public function resetHalaman16()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-berlatih-3')
            ->delete();

        return redirect()->route('admin.materi.halaman16')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }

    public function halaman17()
    {
        return view('admin.materi.halaman17');
    }

}