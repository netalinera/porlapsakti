<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimtekDaftar extends Model
{
    use HasFactory;
    protected $table = 'bimtek_ps_daftar';
    protected $fillable = [
        'id_nama_kegiatan',
        'lokus_kode_prov',
        'nama_peserta',
        'no_telpon_peserta',
        'email_peserta',
        'Jenis_kelamin',
        'id_lembaga',
        'timestamp'
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'lokus_kode_prov', 'kode_prov');
    }
}
