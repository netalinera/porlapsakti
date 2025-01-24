<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    
    protected $table = 'kecamatans';
    protected $fillable = ['id', 'id_prov', 'id_kab_kota', 'nama_kecamatan'];
    public $incrementing = false;

    public function kabKota()
    {
        return $this->belongsTo(KabKota::class, 'id_kab_kota', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo(provinsi::class, 'id_prov', 'id');
    }

    public function kelDesas()
    {
        return $this->hasMany(KelDesa::class, 'id_kecamatan', 'id');
    }

    public function getKecamatanByKabupaten($id_kab_kota)
{
    $kecamatan = Kecamatan::where('id_kab_kota', $id_kab_kota)->get();
    return response()->json($kecamatan);
}

}
