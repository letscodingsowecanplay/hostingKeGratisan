<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    public function jawaban()
    {
        return $this->hasMany(JawabanSoal::class);
    }

}
