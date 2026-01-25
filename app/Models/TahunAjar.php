<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    protected $table = 'ref_tahun_ajar';
    protected $primaryKey = 'ta_id';
    protected $guarded = [];

    public function krs()
    {
        return $this->hasMany(Krs::class, 'krs_ta_id', 'ta_id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'nilai_ta_id', 'ta_id');
    }

    public function waktus()
    {
        return $this->hasMany(Waktu::class, 'wk_ta_id', 'ta_id');
    }
}
