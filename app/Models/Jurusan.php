<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'tb_jurusan';
    protected $primaryKey = 'jur_id';
    protected $guarded = [];

    public function matkuls()
    {
        return $this->hasMany(Matkul::class, 'matkul_jur_id', 'jur_id');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'mhs_jur_id', 'jur_id');
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class, 'ds_jur_id', 'jur_id');
    }

    public function nilai()
    {
        return $this->hasOne(SetNilai::class, 'sn_jur_id', 'jur_id');
    }

    // Belongs

    public function pimpinan()
    {
        return $this->belongsTo(Dosen::class, 'jur_pimpinan_id', 'ds_id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'jur_fk_id', 'fk_id');
    }
}
