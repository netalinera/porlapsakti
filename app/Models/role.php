<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    // untuk memproteksi field id
    protected $guarded = ['id'];

    // untuk relasi one To Many ke tabel users
    public function users() {
        return $this->hasMany(User::class);
    }
}
