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
        Schema::create('lomba_pt_nilai_output', function (Blueprint $table) {
            $table->string('UniqueID')->primary();
            $table->string('nomor_pendaftaran');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('kode_provinsi', 10);
            $table->string('karya_inovasi_tertulis');
            $table->string('link_unggah_video');
            $table->decimal('nilai_tahap_onsite');
            $table->decimal('nilai_tahap_akhir');
            $table->decimal('nilai_tahap_finalis');
            $table->string('keterangan_finalis');
            $table->timestamp('timestamp');

            $table->foreign('kode_provinsi')
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
        Schema::dropIfExists('lomba_pt_nilai_output');
    }
};
