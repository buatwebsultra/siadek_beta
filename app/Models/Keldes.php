<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keldes extends Model
{
    protected $table = 'ref_keldes';
    protected $primaryKey = 'kel_id';
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class, 'kel_kec_id', 'kec_id');
    }
}
