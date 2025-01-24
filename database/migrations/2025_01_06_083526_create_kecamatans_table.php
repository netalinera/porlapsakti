<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->string('id', 10);
            $table->string('kode_kec', 10)->primary();
            $table->string('kode_kab_kota', 10);
            $table->string('kode_prov', 10);
            $table->string('nama_kecamatan');
            $table->timestamps();

            $table->foreign('kode_prov')
                  ->references('kode_prov')
                  ->on('provinsis')
                  ->onDelete('cascade');
            
            $table->foreign('kode_kab_kota')
                  ->references('kode_kab_kota')
                  ->on('kab_kotas')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kecamatans');
    }
};
