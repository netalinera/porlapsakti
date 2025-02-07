<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('provinsis', function (Blueprint $table) {
            $table->id(); 
            $table->string('kode_prov', 10)->unique();
            $table->string('nama_provinsi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('provinsis');
    }
};
