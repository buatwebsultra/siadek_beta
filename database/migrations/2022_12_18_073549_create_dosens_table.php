<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dosen', function (Blueprint $table) {
            $table->id('ds_id');
            $table->unsignedBigInteger('ds_fk_id');
            $table->unsignedBigInteger('ds_jur_id');
            $table->string('ds_nip');
            $table->string('ds_nama');
            $table->string('ds_alamat')->nullable();
            $table->string('ds_tlp')->nullable();
            $table->string('ds_jabatan');
            $table->string('ds_password');
            $table->timestamps();

            $table->foreign('ds_fk_id')->references('fk_id')->on('tb_fakultas')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('ds_jur_id')->references('jur_id')->on('tb_jurusan')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_dosen');
    }
}
