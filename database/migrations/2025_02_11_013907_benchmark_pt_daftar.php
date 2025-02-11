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
        Schema::create('benchmark_pt_daftar', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_nama_kegiatan');
            $table->string('nama_narahubung');
            $table->string('no_wa_narahubung');
            $table->string('email_narahubung');
            $table->string('kode_pt');
            $table->string('status_pt');
            $table->string('akreditasi');
            $table->unsignedBigInteger('id_lembaga');
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
        Schema::dropIfExists('benchmark_pt_daftar');
    }
};
