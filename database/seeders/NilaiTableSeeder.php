<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiTableSeeder extends Seeder
{
    public function run(): void
    {
        $nilai = [
            [
                'id' => 54,
                'user_id' => 5,
                'kuis_id' => 'ayo-berlatih-1',
                'skor' => 4,
                'total_soal' => 4,
                'status' => 'tidak_lulus',
                'jawaban' => '{"soal1":"pendek","soal2":"panjang","soal3":"tinggi","soal4":"rendah"}',
                'created_at' => '2025-05-21 07:37:22',
                'updated_at' => '2025-07-01 23:06:13'
            ],
            [
                'id' => 57,
                'user_id' => 5,
                'kuis_id' => 'ayo-mencoba-2',
                'skor' => 4,
                'total_soal' => 4,
                'status' => 'tidak_lulus',
                'jawaban' => '{"soal1":"b","soal2":"a","soal3":"a","soal4":"a"}',
                'created_at' => '2025-05-21 07:53:27',
                'updated_at' => '2025-06-11 07:28:41'
            ],
            // Tambahkan data lainnya sesuai dengan dump SQL
            // Saya akan mengambil beberapa contoh saja, Anda bisa menambahkan sisanya
        ];

        DB::table('nilai')->insert($nilai);
    }
}
