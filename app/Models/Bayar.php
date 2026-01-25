<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $table = 'tb_bayar';
    protected $primaryKey = 'byr_id';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'byr_mhs_id', 'mhs_id');
    }

    public function getStatusAttribute()
    {
        $arrayStatus = [
            0 => 'Diproses',
            1 => 'Valid',
            2 => 'Pembayaran tidak valid',
        ];

        return $arrayStatus[$this->byr_status] ?? 'Unknown';
    }

    public function getStatusHtml()
    {
        $arrayStatus = [
            0 => '<label class="label label-lg label-warning"><i class="icofont icofont-ui-text-loading"></i> Diproses</label>',
            1 => '<label class="label label-lg label-success"><i class="icofont icofont-checked"></i> Valid</label>',
            2 => '<label class="label label-lg label-danger"><i class="icofont icofont-warning-alt"></i> Pembayaran tidak valid</label>',
        ];

        return $arrayStatus[$this->byr_status] ?? '<label class="label label-lg label-default">Unknown</label>';
    }
}
