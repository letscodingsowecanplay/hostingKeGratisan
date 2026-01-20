<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KKMTableSeeder extends Seeder
{
    public function run(): void
    {
        $kkm = [
            ['id' => 7, 'kuis_id' => 'ayo-mencoba-1', 'kkm' => 75],
            ['id' => 8, 'kuis_id' => 'ayo-berlatih-1', 'kkm' => 75],
            ['id' => 9, 'kuis_id' => 'ayo-mencoba-2', 'kkm' => 75],
            ['id' => 10, 'kuis_id' => 'ayo-berlatih-2', 'kkm' => 60],
            ['id' => 11, 'kuis_id' => 'ayo-mencoba-3', 'kkm' => 75],
            ['id' => 12, 'kuis_id' => 'ayo-berlatih-3', 'kkm' => 60],
            ['id' => 13, 'kuis_id' => 'evaluasi-1', 'kkm' => 70],
        ];

        DB::table('kkm')->insert($kkm);
    }
}
