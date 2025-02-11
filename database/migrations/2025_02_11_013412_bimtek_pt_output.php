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
        Schema::create('bimtek_pt_output', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nama_kegiatan');
            $table->string('nama_peserta');
            $table->string('no_telpon_peserta');
            $table->string('email_peserta');
            $table->string('kode_pt');
            $table->string('status_pt(PTN/PTS)');
            $table->string('Akreditasi');
            $table->unsignedBigInteger('id_lembaga');
            $table->boolean('surat_tugas');
            $table->decimal('nilai_koleksi_perpus');
            $table->decimal('nilai_sarpras_perpus');
            $table->decimal('nilai_pelayanan_perpus');
            $table->decimal('nilai_tenaga_perpus');
            $table->decimal('nilai_penyelenggaraan_perpus');
            $table->decimal('nilai_pengelolaan_perpus');
            $table->decimal('nilai_inovasi_kreatifitas');
            $table->decimal('nilai_tingkat_kegemaran_membaca');
            $table->decimal('nilai_indeks_pembangunan_literasi_masyarakat');
            $table->string('predikat_snp');
            $table->decimal('nilai_akhir_snp');
            $table->boolean('file_snp');
            $table->boolean('ipusnas');
            $table->boolean('bintang_pusnasEdu');
            $table->boolean('khastara');
            $table->boolean('e_resources');
            $table->boolean('lainnya');
            $table->integer('f_ipusnas');
            $table->integer('f_bintang_pusnasEdu');
            $table->integer('f_khastara');
            $table->integer('f_resources');
            $table->integer('f_lainnya');
            $table->string('rekomendasi_koleksi_digital');
            $table->string('sarana_memadai');
            $table->string('materi_bermanfaat');
            $table->string('materi_diterima_diterapkan');
            $table->string('urutan_penyampaian');
            $table->string('kegiatan_yg_diharapkan');
            $table->string('tema_bimtek');
            $table->string('saran');
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
        Schema::dropIfExists('bimtek_pt_output');
    }
};
