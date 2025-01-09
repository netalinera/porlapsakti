<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_provinsi',
    ];

    // untuk relasi one To Many ke tabel lembaga
    public function lembaga() {
        return $this->hasMany(lembaga::class);
    }
}
