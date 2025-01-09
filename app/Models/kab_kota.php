<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kab_kota extends Model
{
    use HasFactory;

    // untuk relasi one To Many ke tabel lembaga
    public function lembaga() {
        return $this->hasMany(lembaga::class);
    }
}
