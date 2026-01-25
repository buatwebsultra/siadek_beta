<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeldesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_keldes', function (Blueprint $table) {
            $table->id('kel_id');
            $table->string('kel_kode', 50)->nullable();
            $table->string('kel_nama');
            $table->unsignedBigInteger('kel_kec_id');
            $table->timestamps();

            $table->foreign('kel_kec_id')->references('kec_id')->on('ref_kecamatan')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('tb_dosen', function (Blueprint $table) {
            $table->foreign('ds_kelurahan')->references('kel_id')->on('ref_keldes')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('tb_mahasiswa', function (Blueprint $table) {
            $table->foreign('mhs_kelurahan')->references('kel_id')->on('ref_keldes')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keldes');
    }
}
