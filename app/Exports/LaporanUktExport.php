<?php

namespace App\Exports;

use App\Helpers\Adr;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanUktExport implements FromView
{
    public $jur_id;
    public $angkatan;

    public function __construct($jur_id, $angkatan)
    {
        $this->jur_id = $jur_id;
        $this->angkatan = $angkatan;
    }

    public function view(): View
    {
        $data['jurusan'] = Jurusan::find($this->jur_id);
        $data['mahasiswa'] = Mahasiswa::where('mhs_jur_id', $this->jur_id)
            ->where('mhs_angkatan', $this->angkatan)
            ->with(['ukt' => function ($query) {
                $query->orderBy('byr_tgl_bayar', 'ASC');
            }])
            ->orderBy('mhs_nama', 'ASC')
            ->get();

        $data['angkatan'] = $this->angkatan;
        $data['stsMahasiswa'] = Adr::$stsMahasiswa;

        $data['mhs_by_sts'] = Adr::dataMhsBySts($this->jur_id, $this->angkatan);


        return view('_excel.lap_keu', $data);
    }
}
