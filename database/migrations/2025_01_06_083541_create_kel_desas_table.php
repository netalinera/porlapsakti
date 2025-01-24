<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kel_desas', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('id_prov', 10);
            $table->string('id_kab_kota', 10);
            $table->string('id_kecamatan', 10);
            $table->string('nama_kel_desa');
            $table->timestamps();

            $table->foreign('id_prov')
                  ->references('id')
                  ->on('provinsis')
                  ->onDelete('cascade');
            
            $table->foreign('id_kab_kota')
                  ->references('id')
                  ->on('kab_kotas')
                  ->onDelete('cascade');
                  
            $table->foreign('id_kecamatan')
                  ->references('id')
                  ->on('kecamatans')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kel_desas');
    }
};
