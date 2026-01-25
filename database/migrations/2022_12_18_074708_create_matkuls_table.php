<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatkulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_mata_kuliah', function (Blueprint $table) {
            $table->id('matkul_id');
            $table->unsignedBigInteger('matkul_jur_id');
            $table->unsignedBigInteger('matkul_dosen_id');
            $table->string('matkul_nama');
            $table->integer('matkul_semester');
            $table->integer('matkul_sks');
            $table->string('matkul_tipe', 20);
            $table->timestamps();

            $table->foreign('matkul_jur_id')->references('jur_id')->on('tb_jurusan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('matkul_dosen_id')->references('ds_id')->on('tb_dosen')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_mata_kuliah');
    }
}
