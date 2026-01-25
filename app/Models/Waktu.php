<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    protected $table = 'waktus';
    protected $primaryKey = 'wk_id';
    protected $guarded = [];

    public function ta()
    {
        return $this->belongsTo(TahunAjar::class, 'wk_ta_id', 'ta_id');
    }

    public function getLabelAttribute()
    {
        $labels = [
            0 => 'Kunci',
            1 => 'Aktiv',
        ];

        return $labels[$this->wk_status] ?? 'Unknown';
    }

    public function getLabelHtml()
    {
        $labels = [
            0 => '<label class="label label-lg label-default"><i class="icofont icofont-lock"></i> Kunci</label>',
            1 => '<label class="label label-lg label-primary"><i class="icofont icofont-ui-unlock"></i> Aktiv</label>',
        ];

        return $labels[$this->wk_status] ?? '<label class="label label-lg label-default">Unknown</label>';
    }
}
