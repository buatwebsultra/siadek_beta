<?php

namespace App\Http\Controllers;

use App\Helpers\NilaiHelper;
use App\Models\{Dosen, Jurusan, Krs, Mahasiswa, Nilai, SetNilai, TahunAjar};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function get($id)
    {
    }

    public function getNilaiMahasiswa(Request $request)
    {
        $status = false;
        $data['nilai'] = Nilai::where('nilai_ta_id', $request->ta_id)
            ->where('nilai_mhs_id', $request->mhs_id)
            ->with('ta')
            ->first();
        // $krs = Krs::where('krs_mhs_id', $request->mhs_id)
        //     ->where('krs_ta_id', $request->ta_id)
        //     ->with('matkul')
        //     ->get();
        // $data['sks'] = $krs->sum('matkul.matkul_sks');

        if ($data['nilai']) {
            $status = true;
        }

        return response()->json([
            'status' => $status,
            'data' => $data,
        ]);
    }

    public function updateNilaiKrs(Request $request)
    {
        $cek = NilaiHelper::updateNilaiKrs($request);

        if ($cek == 0) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Setting penilaian belum dilakukan Harap menghubungi Ketua Jurusan / Program Studi'
                );
        }
        return redirect()
            ->back()
            ->with('success', 'Penilaian disimpan');
    }

    public function print($kode = null)
    {
        try {
            $param = explode('-', $kode); // 0semester - 1mhs_id - 2ta_id
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
                    ->sortByDesc('matkul.matkul_sks');

                $krsKirim = [];
                foreach ($krss as $krs) {
                    $id_ds = json_decode($krs->matkul->matkul_dosen);
                    $arrDsn = [];
                    foreach ($id_ds as $dns) {
                        $xx = Dosen::select(['ds_nama', 'ds_gelar'])
                            ->where('ds_id', $dns)
                            ->first();
                        if ($xx) {
                            array_push($arrDsn, $xx);
                        }
                    }
                    $krs->dosens = $arrDsn;
                    array_push($krsKirim, $krs);
                }

                // dd($krsKirim);

                $data['krss'] = $krsKirim;

                $data['ta'] = TahunAjar::find($param[2]);
                $data['nilai'] = Nilai::where('nilai_ta_id', $param[2])
                    ->where('nilai_mhs_id', $param[1])
                    ->with('ta')
                    ->first();
                $data['jurusan'] = Jurusan::where(
                    'jur_id',
                    $data['mhs']->mhs_jur_id
                )
                    ->with('pimpinan')
                    ->first();

                if (!$data['nilai']) {
                    return redirect()
                        ->back()
                        ->with('error', 'Tidak ada data');
                }
            }
            return view('pages.print_khs', $data);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan. Mohon periksa data anda');
        }
    }

    public function transkrip($kode = null)
    {
        try {
            $param = explode('-', $kode); // 0semester - 1mhs_id - 2ta_id
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
                $data['krss'] = Krs::where('krs_mhs_id', $param[1])
                    ->where('krs_is_pernah', '0')
                    ->orderBy('krs_id', 'ASC')
                    ->with(['matkul', 'matkul.ruang'])
                    ->get()
                    ->sortBy('matkul.matkul_semester');
                // dd($data['krss']);
                $data['nilai'] = Nilai::where('nilai_mhs_id', $param[2])
                    ->orderBy('nilai_ta_id', 'ASC')
                    ->with('ta')
                    ->get();
                $data['jurusan'] = Jurusan::where(
                    'jur_id',
                    $data['mhs']->mhs_jur_id
                )
                    ->with('pimpinan')
                    ->first();
                if (!$data['nilai']) {
                    return redirect()
                        ->back()
                        ->with('error', 'Tidak ada data');
                }
            }
            return view('pages.print_transkrip', $data);
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan. Mohon periksa data anda');
        }
    }

    public function reset(Request $request)
    {
        try {
            Krs::where('krs_ta_id', $request->reset_ta_id)
                ->where('krs_mhs_id', $request->reset_mhs_id)
                ->update([
                    'krs_kehadiran' => 0,
                    'krs_nilai_tugas' => 0,
                    'krs_nilai_kuis' => 0,
                    'krs_nilai_mid' => 0,
                    'krs_nilai_final' => 0,
                    'krs_nilai_avg' => 0,
                    'krs_bobot' => 0,
                    'krs_grade' => null,
                ]);
            NilaiHelper::updateNilai(
                $request->reset_mhs_id,
                $request->reset_ta_id
            );
            return response()->json([
                'status' => true,
                'msg' => 'Penilaian berhasil direset',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Terjadi kesalahan. Mohon periksa data anda',
                'detail' => $th->getMessage(),
            ]);
        }
    }
}
