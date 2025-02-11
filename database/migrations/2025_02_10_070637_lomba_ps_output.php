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
        Schema::create('lomba_ps_output', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_nama_kegiatan');
            $table->string('lokus_kode_prov');
            $table->string('nama_peserta');
            $table->string('no_telpon_peserta');
            $table->string('email_peserta');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('video_profil')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('website')->nullable();
            $table->string('form_profil')->nullable();
            $table->string('komponen_1')->nullable();
            $table->string('komponen_2')->nullable();
            $table->string('komponen_3')->nullable();
            $table->string('komponen_4')->nullable();
            $table->string('komponen_5')->nullable();
            $table->timestamp('timestamp');
        
            $table->foreign('lokus_kode_prov')
                  ->references('kode_prov')
                  ->on('provinsis')
                  ->onDelete('cascade');
            
            $table->foreign('id_lembaga')
                  ->references('id')
                  ->on('lembagas')
                  ->onDelete('cascade');
            
            $table->foreign('id_nama_kegiatan')
                  ->references('id')
                  ->on('m_kegiatan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('lomba_ps_output');
    }
};
