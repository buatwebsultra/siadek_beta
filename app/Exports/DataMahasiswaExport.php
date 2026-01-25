<?php

namespace App\Exports;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DataMahasiswaExport implements FromView, ShouldAutoSize
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
            ->with(['kecamatan', 'ukt' => function ($query) {
                $query->orderBy('byr_id', 'ASC');
            }])
            ->orderBy('mhs_nama', 'ASC')
            ->get();

        return view('_excel.data_mhs', $data);
    }
}
