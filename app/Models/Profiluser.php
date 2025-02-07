<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiluser extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pj',
        'alamat',
        'no_wa',
        'photo',
    ];

    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
}
