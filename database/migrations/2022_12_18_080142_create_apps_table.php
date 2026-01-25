<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_app', function (Blueprint $table) {
            $table->id('app_id');
            $table->string('app_nama');
            $table->string('app_desc');
            $table->string('app_logo');
            $table->string('app_icon');
            $table->string('app_alamat');
            $table->string('app_email');
            $table->string('app_tlp');
            $table->integer('app_set_penawaran')->dafault(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conf_app');
    }
}
