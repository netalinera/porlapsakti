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
        Schema::create('kel_desas', function (Blueprint $table) {
            $table->id();
            $table->string('id_prov');//foreign key
            $table->string('id_kab_kota');//foreign key
            $table->string('id_kec');//foreign key
            $table->string('nama_kel_desa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kel_desas');
    }
};
