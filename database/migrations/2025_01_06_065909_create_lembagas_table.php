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
        Schema::create('lembagas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prov');//foreign key
            $table->unsignedBigInteger('id_kab_kota');//foreign key
            $table->unsignedBigInteger('id_kec');//foreign key
            $table->unsignedBigInteger('id_kel_desa');//foreign key
            $table->integer('id_jenis');
            $table->integer('id_sub_jenis');
            $table->string('npsn_kodePT');
            $table->string('status_PTN_PTS');
            $table->string('nama_lembaga');
            $table->string('nama_perpus');
            $table->string('NPP');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kode_pos');
            $table->string('email_lembaga');
            $table->string('email_perpus');
            $table->string('kode_negara');
            $table->string('kode_daerah');
            $table->string('nomor_telepon');
            $table->boolean('keaktifan');
            $table->timestamps();
            // `created_by` varchar(300),
            // `updated_by` varchar(300)
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembagas');
    }
};
