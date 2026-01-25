<?php

namespace App\Exports;

use App\Models\{Krs, TahunAjar};
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanMahasiswaExport implements FromView
{
    public $ta_id, $jur_id;

    public function __construct($request)
    {
        $this->ta_id = $request->ta_pilih;
        $this->jur_id = $request->jur_pilih;
    }

    public function view(): View
    {
        $ta = TahunAjar::find($this->ta_id);

        $krss = Krs::select('*')->where('krs_ta_id', $this->ta_id);

        if ($this->jur_id != 'all') {
            $krss = $krss->whereHas('mahasiswa', function ($qr) {
                $qr->where('mhs_jur_id', $this->jur_id);
            });
        }

        $data = $krss->with(['mahasiswa', 'mahasiswa.jurusan', 'matkul', 'matkul.ruang'])->get();

        // dd($data);

        return view('_excel.laporan_mahasiswa', compact(['data', 'ta']));
    }
}
