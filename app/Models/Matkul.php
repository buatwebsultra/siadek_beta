<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'ref_mata_kuliah';
    protected $primaryKey = 'matkul_id';
    protected $guarded = [];

    public $namaHari = [
        '-',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
    ];

    public function getNamaHari()
    {
        return $this->namaHari[$this->matkul_hari_order];
    }

    public function setNamaHari()
    {
        return $this->matkul_hari = $this->getNamaHari();
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'krs_matkul_id', 'matkul_id');
    }

    // Belongs

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'matkul_jur_id', 'jur_id');
    }

    // public function dosen()
    // {
    //     return $this->belongsTo(Dosen::class, 'matkul_dosen_id', 'ds_id');
    // }

    // public function dosen()
    // {
    //     return $this->belongsToMany(
    //         Dosen::class
    //     )->whereIn('ds_id', json_decode($this->matkul_dosen, true));
    // }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'matkul_ruang_id', 'ruang_id');
    }
}
