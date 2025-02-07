<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    
    protected $table = 'kecamatans';
    protected $fillable = ['kode_kec', 'kode_prov', 'kode_kab_kota', 'nama_kecamatan'];
    protected $primaryKey = 'id'; 
    public $incrementing = true; 
    protected $keyType = 'int';

    public function kabKota()
    {
        return $this->belongsTo(KabKota::class, 'kode_kab_kota', 'kode_kab_kota');
    }

    public function provinsi()
    {
        return $this->belongsTo(provinsi::class, 'kode_prov', 'kode_prov');
    }

    public function kelDesas()
    {
        return $this->hasMany(KelDesa::class, 'kode_kec', 'kode_kec');
    }

    public function getKecamatanByKabupaten($kode_kab_kota)
{
    $kecamatan = Kecamatan::where('kode_kab_kota', $kode_kab_kota)->get();
    return response()->json($kecamatan);
}

}
