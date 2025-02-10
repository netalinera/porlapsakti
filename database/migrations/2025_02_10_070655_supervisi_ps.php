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
        Schema::create('supervisi_ps', function(Blueprint $table){
            $table->id();
            $table->string('id_nama_kegiatan');
            $table->string('lokus_kode_prov');
            $table->string('hasil_1');
            $table->string('hasil_2');
            $table->string('hasil_3');
            $table->string('hasil_4');
            $table->string('hasil_5');
            $table->string('hasil_6');
            $table->string('hasil_7');
            $table->string('hasil_8');
            $table->string('hasil_9');
            $table->string('hasil_10');
            $table->timestamp('timestamp');

            $table->foreign('lokus_kode_prov')
                  ->references('kode_prov')
                  ->on('provinsis')
                  ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('supervisi_ps');
    }
};
