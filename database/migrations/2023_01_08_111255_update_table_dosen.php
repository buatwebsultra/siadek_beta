<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_dosen', function (Blueprint $table) {
            $table->string('ds_jk')->nullable();
            $table->date('ds_tgl_lahir')->nullable();
            $table->string('ds_tempat_lahir', 100)->nullable();
            $table->string('ds_no_regis', 100)->nullable();
            $table->string('ds_nik', 100)->nullable();
            $table->string('ds_npwp', 100)->nullable();
            $table->string('ds_ikatan_kerja')->nullable();
            $table->string('ds_status_pegawai', 100)->nullable();
            $table->string('ds_jenis_pegawai', 100)->nullable();
            $table->string('ds_no_sk_cpns', 100)->nullable();
            $table->date('ds_tgl_sk_cpns')->nullable();
            $table->string('ds_pangkat', 50)->nullable();
            $table->string('ds_gol', 50)->nullable();
            $table->string('ds_sumber_gaji', 100)->nullable();
            $table->string('ds_rt', 20)->nullable();
            $table->string('ds_rw', 20)->nullable();
            $table->string('ds_dusun', 100)->nullable();
            $table->string('ds_kode_pos', 30)->nullable();
            $table->unsignedBigInteger('ds_kelurahan')->nullable();
            $table->unsignedBigInteger('ds_kecamatan')->nullable();
            $table->string('ds_email', 120)->nullable();
            $table->string('ds_status_nikah', 120)->nullable();
            $table->string('ds_pasangan_nama', 120)->nullable();
            $table->string('ds_pasangan_tlp', 50)->nullable();
            $table->string('ds_pasangan_tmt', 100)->nullable();
            $table->string('ds_pekerjaan', 120)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
