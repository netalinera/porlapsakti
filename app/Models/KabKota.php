<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabKota extends Model
{
    use HasFactory;
    
    protected $table = 'kab_kotas';
    protected $primaryKey = 'kode_kab_kota'; // Primary key baru
    protected $fillable = ['kode_kab_kota', 'kode_prov', 'nama_kab_kota'];
    public $incrementing = false;
    protected $keyType = 'string'; // Karena kode_kab_kota bertipe string

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kode_prov', 'kode_prov');
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'kode_kab_kota', 'kode_kab_kota');
    }
}
