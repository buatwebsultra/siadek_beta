<?php

namespace App\Http\Controllers;

use App\Models\{Bayar, Dosen, Jurusan, Krs, Mahasiswa, Matkul, TahunAjar};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    public function index()
    {
    }

    public function getMahasiswaDetail(Request $request)
    {
        $cekUkt = Bayar::where('byr_mhs_id', $request->krs_mhs_id)
            ->where('byr_semester', $request->krs_semester)
            ->count();

        if ($cekUkt <= 0) {
            return response()->json([
                'status' => false,
                'msg' =>
                'Pembayaran UKT semester ' .
                    $request->krs_semester .
                    ' belum ada.',
            ]);
        }

        $ukt = Bayar::where('byr_mhs_id', $request->krs_mhs_id)
            ->where('byr_semester', $request->krs_semester)
            ->first();

        if ($ukt->byr_status == 2) {
            return response()->json([
                'status' => false,
                'msg' =>
                'Pembayaran UKT semester ' .
                    $request->krs_semester .
                    ' Tidak Valid.',
            ]);
        }

        if ($ukt->byr_status != 1) {
            return response()->json([
                'status' => false,
                'msg' =>
                'Pembayaran UKT semester ' .
                    $request->krs_semester .
                    ' belum divalidasi.',
            ]);
        }

        $data['totSks'] = Krs::where('krs_semester', $request->krs_semester)
            ->where('krs_mhs_id', $request->krs_mhs_id)
            ->with('matkul')
            ->get()
            ->sum('matkul.matkul_sks');

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function data($kode = null)
    {
        $guard = Auth::getDefaultDriver();
        $data = [];
        if ($guard == 'admin') {
            # code...
        } elseif ($guard == 'student') {
            $param = explode('-', $kode); // semester - mhs_id - ta_id
            if (Auth::id() == $param[1]) {
                $data = Krs::where('krs_mhs_id', $param[1])
                    ->where('krs_ta_id', $param[2])
                    ->orderBy('krs_id', 'DESC')
                    ->with(['matkul', 'matkul.ruang'])
                    ->get()
                    ->sortBy([
                        'matkul.matkul_hari_order',
                        'matkul.matkul_jadwal',
                    ]);
            }
        }

        $ta_status = TahunAjar::find($param[2])->ta_status;

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('dosens', function ($row) {
                $id_ds = json_decode($row->matkul->matkul_dosen);
                $dosen = Dosen::select(['ds_nama', 'ds_gelar'])
                    ->whereIn('ds_id', $id_ds)
                    ->get();
                return collect($dosen);
            })
            ->addColumn('menu', function ($row) use ($guard, $ta_status) {
                $raw = '';
                if ($guard == 'admin') {
                    $raw =
                        '<a class="dropdown-toggle addon-btn" data-toggle="dropdown" aria-expanded="true">
                                <i class="icofont icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item pointer" onclick=""><i class="icofont icofont-ui-edit"></i>Edit</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item pointer" onclick="initDelete(`deleteKrs`, ' .
                        $row->krs_id .
                        ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>
                            </div>';
                } else {
                    if ($ta_status == 1 || $ta_status == '1') {
                        $raw =
                            '<a class="pointer" onclick="initDelete(`deleteKrs`, ' .
                            $row->krs_id .
                            ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>';
                    }
                }
                return $raw;
            })
            ->rawColumns(['menu'])
            ->make(true);
    }

    public function get($id)
    {
    }

    public function create(Request $request)
    {
        $ta = TahunAjar::find($request->krs_ta_id);
        if ($ta->ta_status != 1) {
            return response()->json([
                'status' => false,
                'msg' =>
                'Tahun ajaran (' .
                    $ta->ta_kode .
                    ') terkunci. Pengambilan mata kuliah tidak dapat diproses!',
            ]);
        }
        try {
            $user = Auth::id();
            $cek = Krs::where('krs_mhs_id', $user)
                ->where('krs_matkul_id', $request->krs_matkul_id)
                ->where('krs_ta_id', $request->krs_ta_id)
                // ->where('krs_semester', $request->krs_semester)
                ->count();
            if ($cek >= 1) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Mata kuliah sudah diambil!',
                ]);
            }

            $totSks = Krs::where('krs_mhs_id', $user)
                ->where('krs_ta_id', $request->krs_ta_id)
                ->with('matkul')
                ->get()
                ->sum('matkul.matkul_sks');
            $matkul = Matkul::find($request->krs_matkul_id);
            if ($totSks + $matkul->matkul_sks > 24) {
                return response()->json([
                    'status' => false,
                    'msg' =>
                    'Total SKS tidak boleh melebihi 24. Pengambilan mata kuliah tidak dapat diproses!',
                    'data' => [
                        $totSks,
                        $matkul->matkul_sks,
                        $totSks + $matkul->matkul_sks,
                    ],
                ]);
            }

            $sudah = Krs::where('krs_mhs_id', $user)
                ->where('krs_matkul_id', $request->krs_matkul_id)
                ->count();
            if ($sudah >= 1) {
                Krs::where('krs_mhs_id', $user)
                    ->where('krs_matkul_id', $request->krs_matkul_id)
                    ->update(['krs_is_pernah' => 1]);
            }

            Krs::create([
                'krs_mhs_id' => $user,
                'krs_matkul_id' => $request->krs_matkul_id,
                'krs_ta_id' => $request->krs_ta_id,
                'krs_semester' => $request->krs_semester,
            ]);
            return response()->json([
                'status' => true,
                'msg' => 'Mata kuliah diambil.',
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
    }

    public function delete(Request $request)
    {
        try {
            $krs = Krs::find($request->id);
            if ($krs->krs_nilai_avg > 0) {
                return response()->json([
                    'status' => false,
                    'msg' =>
                    'Penilaian sudah ada. Data tidak diijinkan untuk dihapus!',
                ]);
            }
            $krs->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Mata kuliah dibatalkan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Data tidak diijinkan untuk dihapus!',
            ]);
        }
    }

    public function print($kode = null)
    {
        try {
            $param = explode('-', $kode); // semester - mhs_id - ta_id
            $data = [];

            $ijin = true;
            $guard = Auth::getDefaultDriver();
            if ($guard == 'student' && Auth::id() != $param[1]) {
                $ijin = false;
            }

            if ($ijin) {
                $data['mhs'] = Mahasiswa::where('mhs_id', $param[1])
                    ->with(['jurusan', 'pembimbing'])
                    ->first();
                $krss = Krs::where('krs_mhs_id', $param[1])
                    ->where('krs_ta_id', $param[2])
                    ->orderBy('krs_id', 'DESC')
                    ->with(['matkul', 'matkul.ruang'])
                    ->get()
                    ->sortBy('matkul.matkul_hari_order');

                $krsKirim = [];
                foreach ($krss as $krs) {
                    $id_ds = json_decode($krs->matkul->matkul_dosen);
                    $arrDsn = [];
                    foreach ($id_ds as $dns) {
                        $xx = Dosen::select(['ds_nama', 'ds_gelar'])
                            ->where('ds_id', $dns)
                            ->first();
                        array_push($arrDsn, $xx);
                    }
                    $krs->dosens = $arrDsn;
                    array_push($krsKirim, $krs);
                }

                $data['krss'] = $krsKirim;

                $data['ta'] = TahunAjar::find($param[2]);
                $data['jurusan'] = Jurusan::where(
                    'jur_id',
                    $data['mhs']->mhs_jur_id
                )
                    ->with('pimpinan')
                    ->first();

                if (@count($data['krss']) <= 0) {
                    return redirect()
                        ->back()
                        ->with('error', 'Tidak ada data');
                }
            }
            return view('pages.print_krs', $data);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan. Mohon periksa data anda');
        }
    }
}
