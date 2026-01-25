<?php

namespace App\Http\Controllers\Tools;

use App\Exports\{LaporanMahasiswaExport, LaporanPengajarExport, LaporanUktExport};
use App\Http\Controllers\Controller;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function pengajar(Request $request)
    {
        $ta = TahunAjar::find($request->ta_pilih);
        return Excel::download(
            new LaporanPengajarExport($request),
            'laporan_pengajar_' . $ta->ta_kode . '_' . time() . '.xlsx'
        );
    }

    public function mahasiswa(Request $request)
    {
        $ta = TahunAjar::find($request->ta_pilih);
        return Excel::download(
            new LaporanMahasiswaExport($request),
            'laporan_mahasiswa_' . $ta->ta_kode . '_' . time() . '.xlsx'
        );
    }

    public function laporanUkt(Request $request) {
        return Excel::download(
            new LaporanUktExport($request->lap_jur_id, $request->lap_angkatan),
            'laporan_keuangan_' . $request->lap_jur_id . '_' . $request->lap_angkatan . '.xlsx'
        );
    }
}
