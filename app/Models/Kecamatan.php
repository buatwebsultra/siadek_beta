<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'ref_kecamatan';
    protected $primaryKey = 'kec_id';
    protected $guarded = [];

    public function keldes()
    {
        return $this->hasMany(Keldes::class, 'kel_kec_id', 'kec_id');
    }
}
