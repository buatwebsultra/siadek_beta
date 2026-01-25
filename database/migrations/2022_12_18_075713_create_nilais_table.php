<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_nilai', function (Blueprint $table) {
            $table->id('nilai_id');
            $table->unsignedBigInteger('nilai_mhs_id');
            $table->unsignedBigInteger('nilai_ta_id');
            $table->float('nilai_total', 2, 2)->default(0);
            $table->string('nilai_grade', 5)->nullable();
            $table->integer('nilai_status')->default(0);
            $table->timestamps();

            $table->foreign('nilai_mhs_id')->references('mhs_id')->on('tb_mahasiswa')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('nilai_ta_id')->references('ta_id')->on('ref_tahun_ajar')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_nilai');
    }
}
