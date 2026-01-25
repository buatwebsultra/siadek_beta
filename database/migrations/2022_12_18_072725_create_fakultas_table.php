<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_fakultas', function (Blueprint $table) {
            $table->id('fk_id');
            $table->unsignedBigInteger('fk_pimpinan_id');
            $table->string('fk_nama');
            $table->string('fk_alamat')->nullable();
            $table->timestamps();

            // $table->foreign('fk_pimpinan_id')->references('ds_id')->on('tb_dosen')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_fakultas');
    }
}
