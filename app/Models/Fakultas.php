<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'tb_fakultas';
    protected $primaryKey = 'fk_id';
    protected $guarded = [];

    public function jurusans()
    {
        return $this->hasMany(Jurusan::class, 'jur_fk_id', 'fk_id');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'mhs_fk_id', 'fk_id');
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class, 'ds_fk_id', 'fk_id');
    }

    // Belongs

    public function pimpinan()
    {
        return $this->belongsTo(Dosen::class, 'fk_pimpinan_id', 'ds_id');
    }
}
