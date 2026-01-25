<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'tb_krs';
    protected $primaryKey = 'krs_id';
    protected $guarded = [];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'krs_matkul_id', 'matkul_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'krs_mhs_id', 'mhs_id');
    }

    public function ta()
    {
        return $this->belongsTo(TahunAjar::class, 'krs_ta_id', 'ta_id');
    }
}
