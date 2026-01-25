<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'tb_nilai';
    protected $primaryKey = 'nilai_id';
    protected $guarded = [];

    // Belongs

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nilai_mhs_id', 'mhs_id');
    }

    public function ta()
    {
        return $this->belongsTo(TahunAjar::class, 'nilai_ta_id', 'ta_id');
    }
}
