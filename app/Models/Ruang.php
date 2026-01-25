<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'tb_ruang';
    protected $primaryKey = 'ruang_id';
    protected $guarded = [];

    public function matkuls()
    {
        return $this->hasMany(Matkul::class, 'matkul_ruang_id', 'ruang_id');
    }
}
