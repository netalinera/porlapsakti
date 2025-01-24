<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kab_kotas', function (Blueprint $table) {
            $table->string('id', 10);
            $table->string('kode_kab_kota', 10)->primary();
            $table->string('kode_prov', 10);
            $table->string('nama_kab_kota');
            $table->timestamps();

            $table->foreign('kode_prov')
                  ->references('kode_prov')
                  ->on('provinsis')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kab_kotas');
    }
};
