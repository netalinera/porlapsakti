<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    
    protected $table = 'provinsis';
    protected $fillable = ['id', 'nama_provinsi'];
    public $incrementing = false; 
    
    public function kab_kotas()
    {
        return $this->hasMany(KabKota::class, 'id_prov', 'id');
    }
}