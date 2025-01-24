<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kab_kotas', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('id_prov', 10);
            $table->string('nama_kab_kota');
            $table->timestamps();

            $table->foreign('id_prov')
                  ->references('id')
                  ->on('provinsis')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kab_kotas');
    }
};
