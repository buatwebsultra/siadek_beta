<?php

namespace App\Exports;

use App\Models\Dosen;
use App\Models\Krs;
use App\Models\Ruang;
use App\Models\TahunAjar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanPengajarExport implements FromView
{
    public $ta_id, $jur_id;

    public function __construct($request)
    {
        $this->ta_id = $request->ta_pilih;
        $this->jur_id = $request->jur_pilih;
    }

    public function view(): View
    {
        $krss = Krs::select(['krs_id', 'krs_matkul_id'])->where(
            'krs_ta_id',
            $this->ta_id
        );

        if ($this->jur_id != 'all') {
            $krss = $krss->whereHas('matkul', function ($qr) {
                $qr->where('matkul_jur_id', $this->jur_id);
            });
        }

        $krss = $krss->with('matkul')->orderBy('krs_mhs_id', 'ASC')->get();

        $filter = $krss->unique('krs_matkul_id')->toArray();

        // dd($filter);

        $data = [];
        foreach ($filter as $krs) {
            $id_ds = json_decode($krs['matkul']['matkul_dosen']);
            $dosens = Dosen::select('*')
                ->whereIn('ds_id', $id_ds)
                ->with('jurusan')
                ->get();
            $krs['ruang'] = Ruang::where('ruang_id', $krs['matkul']['matkul_ruang_id'])->first();
            // dd($krs['ruang']);
            foreach ($dosens as $ds) {
                $krs['dosen'] = $ds;
                array_push($data, $krs);
            }
        }

        $ta = TahunAjar::find($this->ta_id);

        return view('_excel.laporan_pengajar', compact(['data', 'ta']));
    }
}
