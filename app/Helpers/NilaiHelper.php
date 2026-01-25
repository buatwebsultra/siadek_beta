<?php

namespace App\Helpers;

use App\Models\{Krs, Mahasiswa, Nilai, SetNilai, User};
use Illuminate\Support\Facades\Auth;

class NilaiHelper
{
    private static $setNilai;

    private function __construct()
    {
    }

    public static function updateNilaiKrs($request)
    {
        // $ds = Auth::user();
        $mhs = Mahasiswa::where('mhs_id', $request->mhs_id[0])->first();
        $cekSet = SetNilai::where('sn_jur_id', $mhs->mhs_jur_id)->first();
        // dd($cekSet);
        if (!$cekSet) {
            return 0;
        }
        self::$setNilai = $cekSet;

        for ($i = 0; $i < @count($request->mhs_id); $i++) {
            self::updateOneRowKrs(
                $request->krs_kehadiran[$i],
                $request->krs_nilai_tugas[$i],
                $request->krs_nilai_kuis[$i],
                $request->krs_nilai_mid[$i],
                $request->krs_nilai_final[$i],
                $request->mhs_id[$i],
                $request->ta_id,
                $request->matkul_id
            );
        }
        return 1;
    }

    public static function updateOneRowKrs(
        $krs_kehadiran,
        $krs_nilai_tugas,
        $krs_nilai_kuis,
        $krs_nilai_mid,
        $krs_nilai_final,
        $mhs_id,
        $ta_id,
        $matkul_id,
        $setNilai = 'manual'
    ) {
        if ($setNilai == 'manual') {
            $setNilai = self::$setNilai;
        }

        $kehadiran = $krs_kehadiran * ($setNilai->sn_hadir / 100);
        $tugas = $krs_nilai_tugas * ($setNilai->sn_tugas / 100);
        $kuis = $krs_nilai_kuis * ($setNilai->sn_kuis / 100);
        $mid = $krs_nilai_mid * ($setNilai->sn_mid / 100);
        $final = $krs_nilai_final * ($setNilai->sn_final / 100);

        $nilai_avg = round($kehadiran + $tugas + $kuis + $mid + $final);

        $grade = 'E';
        $bobot = 0;

        if ($nilai_avg >= $setNilai->sn_gd_a) {
            $grade = 'A';
            $bobot = 4;
        } elseif (
            $nilai_avg <= $setNilai->sn_gd_a_min_end &&
            $nilai_avg >= $setNilai->sn_gd_a_min
        ) {
            $grade = 'A-';
            $bobot = 3.5;
        } elseif (
            $nilai_avg <= $setNilai->sn_gd_b_end &&
            $nilai_avg >= $setNilai->sn_gd_b
        ) {
            $grade = 'B';
            $bobot = 3;
        } elseif (
            $nilai_avg <= $setNilai->sn_gd_b_min_end &&
            $nilai_avg >= $setNilai->sn_gd_b_min
        ) {
            $grade = 'B-';
            $bobot = 2.5;
        } elseif (
            $nilai_avg <= $setNilai->sn_gd_c_end &&
            $nilai_avg >= $setNilai->sn_gd_c
        ) {
            $grade = 'C';
            $bobot = 2;
        } elseif (
            $nilai_avg <= $setNilai->sn_gd_d_end &&
            $nilai_avg >= $setNilai->sn_gd_d
        ) {
            $grade = 'D';
            $bobot = 1;
        }

        Krs::where('krs_ta_id', $ta_id)
            ->where('krs_matkul_id', $matkul_id)
            ->where('krs_mhs_id', $mhs_id)
            ->update([
                'krs_kehadiran' => $krs_kehadiran,
                'krs_nilai_tugas' => $krs_nilai_tugas,
                'krs_nilai_kuis' => $krs_nilai_kuis,
                'krs_nilai_mid' => $krs_nilai_mid,
                'krs_nilai_final' => $krs_nilai_final,
                'krs_nilai_avg' => $nilai_avg,
                'krs_bobot' => $bobot,
                'krs_grade' => $grade,
            ]);

        self::updateNilai($mhs_id, $ta_id);
    }

    public static function updateNilai($mhs_id, $ta_id)
    {
        $nilaiMahasiswa = Nilai::firstOrCreate([
            'nilai_ta_id' => $ta_id,
            'nilai_mhs_id' => $mhs_id,
        ]);

        $krs_nilai = Krs::where('krs_ta_id', $ta_id)
            ->where('krs_mhs_id', $mhs_id)
            ->with(['matkul'])
            ->get();

        $nilai_total = 0;
        $nilai_bobot = 0;
        $nilai_sks = 0;
        $nilai_ip = 0;

        foreach ($krs_nilai as $krs) {
            $nilai_total += $krs->krs_nilai_avg;
            $nilai_bobot += $krs->krs_bobot * $krs->matkul->matkul_sks;
            $nilai_sks += $krs->matkul->matkul_sks;
        }

        $nilai_ip = round($nilai_bobot / $nilai_sks, 2);

        $nilaiMahasiswa->nilai_total = $nilai_total;
        $nilaiMahasiswa->nilai_bobot = $nilai_bobot;
        $nilaiMahasiswa->nilai_sks = $nilai_sks;
        $nilaiMahasiswa->nilai_ip = $nilai_ip;
        $nilaiMahasiswa->nilai_history = json_encode($krs_nilai);
        $nilaiMahasiswa->save();
    }

    public static function cekValid()
    {
        
    }
}
