<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    
    protected $table = 'provinsis';
    protected $primaryKey = 'kode_prov'; // Primary key baru
    protected $fillable = ['kode_prov', 'nama_provinsi'];
    public $incrementing = false; 
    protected $keyType = 'string'; // Karena kode_prov bertipe string
    
    public function kabKotas()
    {
        return $this->hasMany(KabKota::class, 'kode_prov', 'kode_prov');
    }
}
