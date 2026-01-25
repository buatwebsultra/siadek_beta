<?php

namespace App\Helpers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;

class Adr
{
    public static function getMahasiswaAng($jur_id = 0)
    {
        $arrAngkatan = Mahasiswa::distinct('mhs_angkatan')->orderBy('mhs_angkatan', 'ASC')->pluck('mhs_angkatan');
        $data = [];


        foreach ($arrAngkatan as $ang) {
            if ($jur_id == 0) {
                $qr = Mahasiswa::select('*');
            } else {
                $qr = Mahasiswa::where('mhs_jur_id', $jur_id);
            }
            $xx['mhs_angg'] = $ang;
            $xx['mhs_jml'] = $qr->where('mhs_angkatan', $ang)->count();
            array_push($data, $xx);
        }
        return $data;
    }

    public static function getDosenProdi()
    {
        $jurs = Jurusan::select(['jur_id', 'jur_nama', 'jur_jenjang'])->get();
        $data = [];
        foreach ($jurs as $jur) {
            $xx['jur_nama'] = $jur->jur_nama . ' (' . $jur->jur_jenjang . ')';
            $xx['jur_dosen'] = Dosen::where('ds_jur_id', $jur->jur_id)->count();
            array_push($data, $xx);
        }
        return $data;
    }

    public static function dataMhsBySts($jur_id  = 0, $angkatan  = 0)
    {
        $data = [];
        foreach (self::$stsMahasiswa as $key1 => $sts) {
            $temp = [];
            $temp['status'] = $sts;
            $qr = Mahasiswa::query();
            if ($jur_id != 0) {
                $qr->where('mhs_jur_id', $jur_id);
            }
            if ($angkatan != 0) {
                $qr->where('mhs_angkatan', $angkatan);
            }
            $temp['jml'] = $qr->where('mhs_status', $key1)->count();
            array_push($data, $temp);
        }
        return $data;
    }

    public static $jalurDaftar = [
        '3' => "Penelusuran Minat dan Kemampuan (PMDK)",
        '4' => "Prestasi",
        '9' => "Program Internasional",
        '11' => "Program Kerjasama Perusahaan/Institusi/Pemerintah",
        '12' => "Seleksi Mandiri",
        '13' => "Ujian Masuk Bersama Lainnya",
        '14' => "Seleksi Nasional Berdasarkan Tes (SNBT)",
        '15' => "Seleksi Nasional Berdasarkan Prestasi (SNBP)",
    ];

    public static $jenisDaftar = [
        '1' => "Peserta didik baru",
        '2' => "Pindahan",
        '13' => "RPL Perolehan SKS",
        '14' => "Pendidikan Non Gelar (Course)",
        '15' => "Fast Track",
        '16' => "RPL Transfer SKS",
    ];

    public static $jenisPembiayaan = [
        '1' => "Mandiri",
        '2' => "Beasiswa Tidak Penuh",
        '3' => "Beasiswa Penuh",
    ];

    public static $stsMahasiswa = [
        '1' => "Aktif",
        '2' => "Non Aktif",
        '3' => "Lulus",
        '4' => "Cuti",
        '5' => "Keluar/Mengundurkan diri",
        '6' => "Tanpa Keterangan",
    ];


}
