<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelDesa extends Model
{
    use HasFactory;
    
    protected $table = 'kel_desas';
    protected $fillable = ['id', 'id_prov', 'id_kab_kota', 'id_kecamatan', 'nama_kel_desa'];
    public $incrementing = false;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id');
    }

    public function kabKota()
    {
        return $this->belongsTo(KabKota::class, 'id_kab_kota', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_prov', 'id');
    }
}
