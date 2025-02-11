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
        Schema::create('lomba_pt_daftar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nama_kegiatan');
            $table->string('nomor_pendaftaran');
            $table->string('nama_ketua');
            $table->string('no_wa_ketua');
            $table->string('email_ketua');
            $table->string('nama_anggota');
            $table->string('nama_pimpinan_pt');
            $table->string('jabatan/posisi');
            $table->string('kode_pt');            
            $table->string('status_pt');            
            $table->string('Akreditasi');            
            $table->string('judul_karya_inovasi');            
            $table->string('link_unggah_video');
            $table->unsignedBigInteger('id_lembaga');
            $table->boolean('sertifikat_npp');            
            $table->boolean('surat_rekomendasi_dinas');            
            $table->boolean('karya_inovasi_tertulis');
            $table->string('unggah_video');
            $table->timestamp('timestamp');
            
            $table->foreign('id_nama_kegiatan')
                  ->references('id')
                  ->on('m_kegiatan')
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
        Schema::dropIfExists('lomba_pt_daftar');
    }
};
