<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mahasiswa', function (Blueprint $table) {
            $table->id('mhs_id');
            $table->unsignedBigInteger('mhs_fk_id');
            $table->unsignedBigInteger('mhs_jur_id');
            $table->unsignedBigInteger('mhs_dosen_id');
            $table->string('mhs_nim');
            $table->string('mhs_nama');
            $table->string('mhs_angkatan');
            $table->string('mhs_tlp');
            $table->string('mhs_email');
            $table->string('mhs_jk');
            $table->string('mhs_agama');
            $table->string('mhs_tgl_lahir');
            $table->string('mhs_tmpt_lahir');
            $table->string('mhs_password');
            $table->timestamps();

            $table->foreign('mhs_fk_id')->references('fk_id')->on('tb_fakultas')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('mhs_jur_id')->references('jur_id')->on('tb_jurusan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('mhs_dosen_id')->references('ds_id')->on('tb_dosen')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_mahasiswa');
    }
}
