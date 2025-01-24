<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kel_desas', function (Blueprint $table) {
            $table->string('id', 10);
            $table->string('kode_kel_desa', 10)->primary();
            $table->string('kode_kecamatan', 10);
            $table->string('kode_kab_kota', 10);
            $table->string('kode_prov', 10);
            $table->string('nama_kel_desa');
            $table->timestamps();

            $table->foreign('kode_prov')
                  ->references('kode_prov')
                  ->on('provinsis')
                  ->onDelete('cascade');
            
            $table->foreign('kode_kab_kota')
                  ->references('kode_kab_kota')
                  ->on('kab_kotas')
                  ->onDelete('cascade');
                  
            $table->foreign('kode_kecamatan')
                  ->references('kode_kec')
                  ->on('kecamatans')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kel_desas');
    }
};
