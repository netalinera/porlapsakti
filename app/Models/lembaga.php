<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lembaga extends Model
{
    use HasFactory;

    // one to Many dari tabel provinsi
     public function provinsi() {
        return $this->belongsTo(provinsi::class, 'id_prov');
    }

    // one to Many dari tabel provinsi
    public function kab_kota() {
        return $this->belongsTo(kab_kota::class, 'id_kab_kota');
    }

    // one to Many dari tabel provinsi
    public function kecamatan() {
        return $this->belongsTo(kecamatan::class, 'id_kec');
    }

    // one to Many dari tabel provinsi
    public function kel_desa() {
        return $this->belongsTo(kel_desa::class, 'id_kel_desa');
    }

}
