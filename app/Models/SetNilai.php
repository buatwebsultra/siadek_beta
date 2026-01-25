<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetNilai extends Model
{
    protected $table = 'set_nilai';
    protected $primaryKey = 'sn_id';
    protected $guarded = [];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'sn_jur_id', 'jur_id');
    }
}
