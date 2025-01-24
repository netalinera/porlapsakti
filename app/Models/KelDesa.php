<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelDesa extends Model
{
    use HasFactory;
    
    protected $table = 'kel_desas';
    protected $primaryKey = 'kode_kel_desa'; // Primary key baru
    protected $fillable = ['kode_kel_desa', 'kode_prov', 'kode_kab_kota', 'kode_kecamatan', 'nama_kel_desa'];
    public $incrementing = false;
    protected $keyType = 'string'; // Karena kode_kel_desa bertipe string

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kode_kecamatan', 'kode_kec');
    }

    public function kabKota()
    {
        return $this->belongsTo(KabKota::class, 'kode_kab_kota', 'kode_kab_kota');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kode_prov', 'kode_prov');
    }
}
