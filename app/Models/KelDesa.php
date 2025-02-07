<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelDesa extends Model
{
    use HasFactory;
    
    protected $table = 'kel_desas';
    protected $fillable = ['kode_kel_desa', 'kode_prov', 'kode_kab_kota', 'kode_kec', 'nama_kel_desa'];
    protected $primaryKey = 'id'; 
    public $incrementing = true; 
    protected $keyType = 'int';

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kode_kec', 'kode_kec');
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
