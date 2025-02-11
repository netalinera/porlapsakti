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
        Schema::create('benchmark_ps', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_nama_kegiatan');
            $table->string('nama_peserta');
            $table->string('no_telpon_peserta');
            $table->string('email_peserta');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('hasil_1');
            $table->string('hasil_2');
            $table->string('hasil_3');
            $table->string('hasil_4');
            $table->string('hasil_5');
            
          
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
        Schema::dropIfExists('benchmark_ps');
    }
};
