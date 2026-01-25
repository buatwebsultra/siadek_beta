<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MatkulController extends Controller
{
    public function index()
    {
    }

    public function getMatkulPenilaian($kode = null)
    {
        $param = explode('-', $kode); // krs_ta_id
        $ta = $param[0];
        $data = Matkul::whereJsonContains('matkul_dosen', json_encode(Auth::id()))
            ->whereHas('krs', function ($query) use ($ta) {
                $query->where('krs_ta_id', $ta);
            })
            ->with(['jurusan', 'ruang'])
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jadwal', function ($row) {
                return $row->matkul_jadwal . ' - ' . $row->matkul_end;
            })
            ->addColumn('jurnama', function ($row) {
                return $row->jurusan->jur_nama .
                    ' (' .
                    $row->jurusan->jur_jenjang .
                    ')';
            })
            ->addColumn('menu', function ($row) use ($ta) {
                $kode = $ta . '-' . $row->matkul_id;
                $raw =
                    '<a href="' .
                    route('lecturer.penilaian.detail', $kode) .
                    '" class="btn btn-sm btn-round hor-grd btn-grd-info "><i class="icofont icofont-safety"></i> Detail Nilai</a>';
                return $raw;
            })
            ->rawColumns(['menu'])
            ->make(true);
    }

    public function getDetailJadwal(Request $request)
    {
        $data['matkul'] = Matkul::where('matkul_id', $request->matkul_id)
            ->with(['jurusan', 'ruang'])
            ->first();
        $data['msiswa'] = $data['matkul']
            ->krs()
            ->where('krs_ta_id', $request->krs_ta_id)
            ->get();
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function data($kode = 'all')
    {
        $guard = Auth::getDefaultDriver();
        $level = 0;
        if ($guard == 'admin') {
            if ($kode == 'all') {
                $data = Matkul::select('*');
            } else {
                $data = Matkul::where('matkul_jur_id', $kode);
            }
            $data
                ->orderBy('matkul_jur_id', 'ASC')
                ->orderBy('matkul_semester', 'ASC')
                ->orderBy('matkul_hari_order', 'ASC')
                ->with(['ruang', 'jurusan'])
                ->get();
        } else {
            $user = Auth::user();
            if (@$user->ds_level == 1) {
                $level = 1;
                $data = Matkul::where('matkul_jur_id', $user->ds_jur_id)
                    ->orderBy('matkul_semester', 'ASC')
                    ->orderBy('matkul_hari_order', 'ASC')
                    ->with(['ruang', 'jurusan'])
                    ->get();
            } else {
                $param = explode('-', $kode); // tipe , jurusan
                $data = Matkul::where('matkul_tipe', $param[0])
                    ->where('matkul_jur_id', $param[1])
                    ->orderBy('matkul_hari_order', 'ASC')
                    ->with(['ruang', 'jurusan'])
                    ->get();
            }
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jadwal', function ($row) {
                $raw =
                    $row->matkul_hari .
                    '<br>' .
                    $row->matkul_jadwal .
                    ' - ' .
                    $row->matkul_end;
                return $raw;
            })
            ->addColumn('dosens', function ($row) {
                $id_ds = json_decode($row->matkul_dosen) ?? [];
                $arrDsn = [];
                foreach ($id_ds as $dns) {
                    $xx = Dosen::select(['ds_nama', 'ds_gelar'])
                        ->where('ds_id', $dns)
                        ->first();
                    array_push($arrDsn, $xx);
                }
                return $arrDsn;
            })
            ->addColumn('periode', function ($row) {
                return $row->matkul_semester . ' (' . $row->matkul_tipe . ')';
            })
            ->addColumn('menu', function ($row) use ($guard, $level) {
                $raw = '';
                if ($guard == 'admin' || $level == 1) {
                    $raw =
                        '<a class="dropdown-toggle addon-btn" data-toggle="dropdown" aria-expanded="true">
                                <i class="icofont icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item pointer" onclick="initEdit(' .
                        $row->matkul_id .
                        ')"><i class="icofont icofont-ui-edit"></i>Edit</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item pointer" onclick="initDelete(`deleteMatkul`, ' .
                        $row->matkul_id .
                        ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>
                            </div>';
                } else {
                    $raw =
                        '<button type="button" onclick="ambilKuliah(' .
                        $row->matkul_id .
                        ')" class="btn btn-sm btn-mat btn-success">Ambil</button>';
                }
                return $raw;
            })
            ->rawColumns(['jadwal', 'menu'])
            ->make(true);
    }

    public function get($id)
    {
        $data = Matkul::where('matkul_id', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function _cekKode($kode)
    {
        $cek = Matkul::where('matkul_kode', $kode)->count();
        if ($cek > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function create(Request $request)
    {
        try {
            if ($this->_cekKode(@$request->matkul_kode)) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Kode mata kuliah sudah ada, harap menggunakan kode yang lain',
                ]);
            }
            $dsn = [@$request->matkul_dosen1, @$request->matkul_dosen2];
            $matkul = Matkul::create([
                'matkul_jur_id' => $request->matkul_jur_id,
                'matkul_dosen' => json_encode($dsn),
                'matkul_ruang_id' => $request->matkul_ruang_id,
                'matkul_kode' => $request->matkul_kode,
                'matkul_nama' => $request->matkul_nama,
                'matkul_semester' => $request->matkul_semester,
                'matkul_sks' => $request->matkul_sks,
                'matkul_hari_order' => $request->matkul_hari_order,
                'matkul_jadwal' => $request->matkul_jadwal,
                'matkul_end' => $request->matkul_end,
                'matkul_tipe' => $request->matkul_tipe,
            ]);
            $matkul->setNamaHari();
            $matkul->save();
            return response()->json([
                'status' => true,
                'msg' => 'Mata Kuliah berhasil ditambahkan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Terjadi kesalahan. Mohon periksa data anda',
                'detail' => $th->getMessage(),
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $matkul = Matkul::find($request->matkul_id);
            if ($matkul->matkul_kode != $request->matkul_kode) {
                if ($this->_cekKode(@$request->matkul_kode)) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Kode mata kuliah sudah ada, harap menggunakan kode yang lain',
                    ]);
                }
            }

            $dsn = [@$request->matkul_dosen1, @$request->matkul_dosen2];
            Matkul::where('matkul_id', $request->matkul_id)->update([
                'matkul_jur_id' => $request->matkul_jur_id,
                'matkul_dosen' => $dsn,
                'matkul_ruang_id' => $request->matkul_ruang_id,
                'matkul_kode' => $request->matkul_kode,
                'matkul_nama' => $request->matkul_nama,
                'matkul_semester' => $request->matkul_semester,
                'matkul_sks' => $request->matkul_sks,
                'matkul_hari_order' => $request->matkul_hari_order,
                'matkul_jadwal' => $request->matkul_jadwal,
                'matkul_end' => $request->matkul_end,
                'matkul_tipe' => $request->matkul_tipe,
            ]);

            $matkul = Matkul::find($request->matkul_id);
            $matkul->setNamaHari();
            $matkul->save();
            return response()->json([
                'status' => true,
                'msg' => 'Perubahan tersimpan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Terjadi kesalahan. Mohon periksa data anda',
                'detail' => $th->getMessage(),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            Matkul::where('matkul_id', $request->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Mata Kuliah berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Data tidak diijinkan untuk dihapus!',
            ]);
        }
    }
}
