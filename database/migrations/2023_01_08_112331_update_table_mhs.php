<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableMhs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_mahasiswa', function (Blueprint $table) {
            $table->string('mhs_wn', 100)->nullable();
            $table->string('mhs_nik', 100)->nullable();
            $table->string('mhs_nisn', 100)->nullable();
            $table->string('mhs_npwp', 100)->nullable();
            $table->string('mhs_alamat')->nullable();
            $table->string('mhs_dusun', 100)->nullable();
            $table->string('mhs_rt', 10)->nullable();
            $table->string('mhs_rw', 10)->nullable();
            $table->unsignedBigInteger('mhs_kelurahan')->nullable();
            $table->unsignedBigInteger('mhs_kecamatan')->nullable();
            $table->string('mhs_kode_pos', 100)->nullable();
            $table->string('mhs_kps')->nullable();
            $table->string('mhs_jenis_tinggal', 100)->nullable();
            $table->string('mhs_transportasi', 100)->nullable();
            $table->string('mhs_ayah_nik', 100)->nullable();
            $table->string('mhs_ayah_nama')->nullable();
            $table->date('mhs_ayah_tgl_lahir')->nullable();
            $table->string('mhs_ayah_pendidikan', 100)->nullable();
            $table->string('mhs_ayah_pekerjaan', 100)->nullable();
            $table->string('mhs_ayah_penghasilan', 100)->nullable();
            $table->string('mhs_ibu_nik', 100)->nullable();
            $table->string('mhs_ibu_nama')->nullable();
            $table->date('mhs_ibu_tgl_lahir')->nullable();
            $table->string('mhs_ibu_pendidikan', 100)->nullable();
            $table->string('mhs_ibu_pekerjaan', 100)->nullable();
            $table->string('mhs_ibu_penghasilan', 100)->nullable();
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
