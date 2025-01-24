<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lembaga extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'lembagas';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'kode_prov',
        'kode_kab_kota',
        'kode_kec',
        'kode_kel_desa',
        'nama_lembaga',
        'nama_perpus',
        'NPP',
        'alamat',
        'rt',
        'rw',
        'email_lembaga',
        'email_perpus',
        'status_aktif',
        'created_by',
        'updated_by',
    ];

    // one to Many dari tabel provinsi
     public function provinsi() {
        return $this->belongsTo(Provinsi::class, 'kode_prov');
    }

    // one to Many dari tabel provinsi
    public function kab_kota() {
        return $this->belongsTo(KabKota::class, 'kode_kab_kota');
    }

    // one to Many dari tabel provinsi
    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, 'kode_kec');
    }

    // one to Many dari tabel provinsi
    public function kel_desa() {
        return $this->belongsTo(KelDesa::class, 'kode_kel_desa');
    }

}
