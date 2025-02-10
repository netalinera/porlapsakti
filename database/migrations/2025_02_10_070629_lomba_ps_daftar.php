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
        //
        Schema::create('lomba_ps_daftar', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_nama_kegiatan');
            $table->string('lokus_kode_prov');
            $table->string('nama_peserta');
            $table->string('no_telpon_peserta');
            $table->string('email_peserta');
            $table->string('Jenis_kelamin');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('profiling_pengelolaan')->nullable();
            $table->string('profiling_inov_kreatif')->nullable();
            $table->string('profiling_iplm')->nullable();
            $table->string('unggah_profiling')->nullable();
            $table->timestamp('timestamp');
        
            $table->foreign('lokus_kode_prov')
                  ->references('kode_prov')
                  ->on('provinsis')
                  ->onDelete('cascade');
            
            $table->foreign('id_lembaga')
                  ->references('id')
                  ->on('lembagas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('lomba_ps_daftar');
    }
};
