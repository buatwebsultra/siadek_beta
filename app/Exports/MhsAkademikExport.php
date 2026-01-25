<?php

namespace App\Exports;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MhsAkademikExport implements FromView
{
    public $idds;

    public function __construct($idds)
    {
        $this->idds = $idds;
    }

    public function view(): View
    {
        $data['dosen'] = Dosen::find($this->idds);
        $data['mahasiswa'] = Mahasiswa::where('mhs_dosen_id', $this->idds)->with('jurusan')
            ->orderBy('mhs_angkatan', 'DESC')->orderBy('mhs_nama', 'ASC')->get();

        return view('_excel.mhs_akademik', $data);
    }
}
