<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lembagas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prov', 10);
            $table->string('kode_kab_kota', 10);
            $table->string('kode_kec', 10);
            $table->string('kode_kel_desa', 10);
            $table->string('nama_lembaga');
            $table->string('nama_perpus');
            $table->string('NPP');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('email_lembaga');
            $table->string('email_perpus');
            $table->timestamps();
            $table->string('created_by', 300);
            $table->string('updated_by', 300);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembagas');
    }
};
