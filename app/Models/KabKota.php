<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabKota extends Model
{
    use HasFactory;
    
    protected $table = 'kab_kotas';
    protected $primaryKey = 'id'; 
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = ['kode_kab_kota', 'kode_prov', 'nama_kab_kota'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kode_prov', 'kode_prov');
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'kode_kab_kota', 'kode_kab_kota');
    }
}