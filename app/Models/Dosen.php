<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dosen extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_dosen';
    protected $primaryKey = 'ds_id';
    protected $guarded = [];
    protected $hidden = ['password'];

    public function pimpinanFakultas()
    {
        return $this->hasOne(Fakultas::class, 'fk_pimpinan_id', 'ds_id');
    }

    public function pimpinanJurusan()
    {
        return $this->hasOne(Jurusan::class, 'jur_pimpinan_id', 'ds_id');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'mhs_dosen_id', 'ds_id');
    }

    // public function matkuls()
    // {
    //     return $this->hasMany(Matkul::class, 'matkul_dosen_id', 'ds_id');
    // }

    // Belongs

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'ds_fk_id', 'fk_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'ds_jur_id', 'jur_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'ds_kecamatan', 'kec_id');
    }

    public function keldes()
    {
        return $this->belongsTo(Keldes::class, 'ds_kelurahan', 'kel_id');
    }
}
