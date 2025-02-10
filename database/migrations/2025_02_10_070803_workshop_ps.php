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
        Schema::create('workshop_ps', function(Blueprint $table){
            $table->id();
            $table->string('id_nama_kegiatan');
            $table->string('nama_peserta');
            $table->string('no_telpon_peserta');
            $table->string('email_peserta');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('video_profil');
            $table->string('hasil_2');
            $table->string('instagram');
            $table->string('tiktok');
            $table->string('youtube');
            $table->string('website');
            $table->string('inovasi_1');
            $table->string('inovasi_2');
            $table->string('inovasi_3');
            $table->string('inovasi_4');
            $table->string('inovasi_5');
            $table->timestamp('timestamp');
            
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
        Schema::dropIfExists('workshop_ps');
    }
};
