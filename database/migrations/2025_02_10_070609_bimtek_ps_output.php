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
        Schema::create('bimtek_ps_output', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_nama_kegiatan');
            $table->string('lokus_kode_prov');
            $table->string('nama_peserta');
            $table->string('no_telpon_peserta');
            $table->string('email_peserta');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('hasil_proviling')->nullable();
            $table->string('profiling_koleksi')->nullable();
            $table->string('profiling_sarpras')->nullable();
            $table->string('profiling_layanan')->nullable();
            $table->string('profiling_tenaga')->nullable();
            $table->string('profiling_penyelenggaraan')->nullable();
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
        Schema::dropIfExists('bimtek_ps_output');
    }
};
