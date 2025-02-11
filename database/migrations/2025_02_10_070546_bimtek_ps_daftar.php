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
        Schema::create('bimtek_ps_daftar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nama_kegiatan');
            $table->string('lokus_kode_prov', 10);
            $table->string('nama_peserta');
            $table->string('no_telpon_peserta');
            $table->string('email_peserta');
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('id_lembaga');
            $table->timestamp('timestamp')->nullable();
        
            $table->foreign('id_lembaga')
                  ->references('id')
                  ->on('lembagas')
                  ->onDelete('cascade');
        
            $table->foreign('lokus_kode_prov')
                  ->references('kode_prov')
                  ->on('provinsis')
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
        Schema::dropIfExists('bimtek_ps_daftar');
    }
};
