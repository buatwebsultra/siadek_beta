<?php

namespace App\Exports;

use App\Models\Krs;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NilaiMatkulExport implements FromView
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
        // $krs = Krs::where('krs_ta_id', $this->ta_id)
        //     ->where('krs_matkul_id', $this->matkul_id)
        //     ->get('krs_mhs_id')
        //     ->pluck('krs_mhs_id');

        // $data['mahasiswa'] = Mahasiswa::whereIn('mhs_id', $krs)
        //     ->orderBy('mhs_nama', 'ASC')
        //     ->get();

        $data['krs'] = Krs::where('krs_ta_id', $this->ta_id)
            ->where('krs_matkul_id', $this->matkul_id)
            ->with('mahasiswa')
            ->get()->sortBy('mahasiswa.mhs_nama');

        // dd($krs);

        return view('_excel.hasil_nilai', $data);
    }
}
