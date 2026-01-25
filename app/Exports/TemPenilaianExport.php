<?php

namespace App\Exports;

// use App\Invoice;
use App\Models\{Krs, Mahasiswa};
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TemPenilaianExport implements FromView
{
    public $ta_id, $matkul_id;

    public function __construct($kode)
    {
        $param = explode('-', $kode); // ta_id, matkul_id
        $this->ta_id = $param[0];
        $this->matkul_id = $param[1];
    }

    public function view(): View
    {
        $krs = Krs::where('krs_ta_id', $this->ta_id)
            ->where('krs_matkul_id', $this->matkul_id)
            ->get('krs_mhs_id')
            ->pluck('krs_mhs_id');

        $data['mahasiswa'] = Mahasiswa::whereIn('mhs_id', $krs)
            ->orderBy('mhs_nama', 'ASC')
            ->get();

        return view('_excel.tem_penilaian', $data);
    }
}
