<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ruang', function (Blueprint $table) {
            $table->id('ruang_id');
            $table->string('ruang_nama');
            $table->string('ruang_lokasi')->default('-');
            $table->string('ruang_ket')->nullable();
            $table->timestamps();
        });

        // Skip foreign key creation to avoid conflicts during initial migration
        // Schema::table('ref_mata_kuliah', function (Blueprint $table) {
        //     $table->foreign('matkul_ruang_id')->references('ruang_id')->on('tb_ruang')->onUpdate('cascade')->onDelete('restrict');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_ruang');
    }
}
