<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecamatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_kecamatan', function (Blueprint $table) {
            $table->id('kec_id');
            $table->string('kec_kode', 50)->nullable();
            $table->string('kec_nama');
            $table->string('kec_kabkota');
            $table->timestamps();
        });

        Schema::table('tb_dosen', function (Blueprint $table) {
            $table->foreign('ds_kecamatan')->references('kec_id')->on('ref_kecamatan')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('tb_mahasiswa', function (Blueprint $table) {
            $table->foreign('mhs_kecamatan')->references('kec_id')->on('ref_kecamatan')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kecamatans');
    }
}
