<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_jurusan', function (Blueprint $table) {
            $table->id('jur_id');
            $table->unsignedBigInteger('jur_fk_id');
            $table->unsignedBigInteger('jur_pimpinan_id');
            $table->string('jur_nama');
            $table->string('jur_alamat');
            $table->timestamps();

            $table->foreign('jur_fk_id')->references('fk_id')->on('tb_fakultas')->onUpdate('cascade')->onDelete('restrict');
            // $table->foreign('jur_pimpinan_id')->references('ds_id')->on('tb_dosen')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_jurusan');
    }
}
