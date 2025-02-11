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
        Schema::create('workshop_pt_output', function (Blueprint $table){
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('nama_peserta');
            $table->string('no_wa_peserta');
            $table->string('email_peserta');
            $table->string('kode_pt');
            $table->string('status_pt');
            $table->string('akreditasi');
            $table->unsignedBigInteger('id_lembaga');

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
        Schema::dropIfExists('workshop_pt_output');
    }
};
