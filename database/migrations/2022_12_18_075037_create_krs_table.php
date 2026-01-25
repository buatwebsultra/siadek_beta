<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_krs', function (Blueprint $table) {
            $table->id('krs_id');
            $table->unsignedBigInteger('krs_mhs_id');
            $table->unsignedBigInteger('krs_matkul_id');
            $table->unsignedBigInteger('krs_ta_id');
            $table->integer('krs_semester');
            $table->float('krs_nilai', 2, 2)->default(0);
            $table->string('krs_grade', 5)->nullable();
            $table->timestamps();

            $table->foreign('krs_mhs_id')->references('mhs_id')->on('tb_mahasiswa')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('krs_matkul_id')->references('matkul_id')->on('ref_mata_kuliah')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('krs_ta_id')->references('ta_id')->on('ref_tahun_ajar')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_krs');
    }
}
