<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabKota extends Model
{
    use HasFactory;
    
    protected $table = 'kab_kotas';
    protected $fillable = ['id', 'id_prov', 'nama_kab_kota'];
    public $incrementing = false;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_prov', 'id');
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'id_kab_kota', 'id');
    }
}