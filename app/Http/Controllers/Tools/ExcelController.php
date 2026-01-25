<?php

namespace App\Http\Controllers\Tools;

use App\Exports\DataMahasiswaExport;
use App\Exports\MhsAkademikExport;
use App\Exports\NilaiMatkulExport;
use App\Exports\TemPenilaianExport;
use App\Http\Controllers\Controller;
use App\Imports\TemPenilaianImport;
use App\Models\Jurusan;
use App\Models\Matkul;
use App\Models\SetNilai;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function unduhTemPenilaian($kode)
    {
        return Excel::download(
            new TemPenilaianExport($kode),
            'template_penilaian_' . $kode . '_' . time() . '.xlsx'
        );
    }

    public function unduhHasilPenilaian($kode)
    {
        $param = explode('-', $kode); // ta_id, matkul_id

        $ta = TahunAjar::find($param[0]);
        $mk = Matkul::find($param[1]);

        if (!$ta || !$mk) {
            return redirect()
                ->back()
                ->with('error', 'Data tidak tersedia');
        }

        return Excel::download(
            new NilaiMatkulExport($kode),
            'hasil-penilaian_' . Str::slug($mk->matkul_nama) . '-' . $ta->ta_kode . '.xlsx'
        );
    }

    public function importPenilaian(Request $request)
    {
        $rules = [
            'file_nilai' => 'mimes:xlsx,xls|max:1200', // max 10000kb
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'File excel tidak valid');
        }

        $ds = Auth::user();
        $cekSet = SetNilai::where('sn_jur_id', $ds->ds_jur_id)->count();
        if ($cekSet <= 0) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Setting penilaian belum dilakukan. Harap menghubungi Ketua Jurusan / Program Studi'
                );
        }
        Excel::import(
            new TemPenilaianImport($request->ta_id, $request->matkul_id),
            $request->file('file_nilai')
        );

        $sukses = session()->get('sukses_import', 0);
        session()->forget('sukses_import');
        return redirect()
            ->back()
            ->with(
                'success',
                'Import nilai sukses. ' .
                    $sukses .
                    ' Data nilai mahasiswa diimport'
            );
    }

    public function mhsAkademik(Request $request)
    {
        return Excel::download(
            new MhsAkademikExport($request->idds),
            'mhs_bimbingan_' . $request->idds . '_' . time() . '.xlsx'
        );
    }

    public function dataMahasiswa(Request $request)
    {
        $jurusan = Jurusan::find($request->export_jur_id);
        $new = $request->export_angkatan.'_'.$jurusan->jur_nama.'_'.$jurusan->jur_jenjang;
        return Excel::download(
            new DataMahasiswaExport($request->export_jur_id, $request->export_angkatan),
            Str::slug($new) . '_' . time() . '.xlsx'
        );
    }
}
