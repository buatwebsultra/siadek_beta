<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaktusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waktus', function (Blueprint $table) {
            $table->id('wk_id');
            $table->unsignedBigInteger('wk_ta_id');
            $table->unsignedBigInteger('wk_jur_id');
            $table->integer('wk_status');
            $table->date('wk_tgl_end');
            $table->time('wk_jam_end');
            $table->timestamps();

            $table->foreign('wk_ta_id')->references('ta_id')->on('ref_tahun_ajar')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('wk_jur_id')->references('jur_id')->on('tb_jurusan')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waktus');
    }
}
