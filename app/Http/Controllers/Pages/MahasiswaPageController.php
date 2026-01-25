<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\Adr;
use App\Http\Controllers\Controller;
use App\Models\{
    Agama,
    Bayar,
    Kecamatan,
    Keldes,
    Krs,
    Mahasiswa,
    Nilai,
    TahunAjar
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index()
    {
        $id_mhs = Auth::id();
        $data['mhs'] = Mahasiswa::where('mhs_id', $id_mhs)
            ->with(['jurusan', 'pembimbing'])
            ->first();
        $data['mhs']->_updateSemesterData();
        $data['ta'] = TahunAjar::orderBy('ta_kode', 'DESC')
            ->limit(1)
            ->first();
        $data['nilai'] = Nilai::where('nilai_ta_id', $data['ta']->ta_id)
            ->where('nilai_mhs_id', $id_mhs)
            ->first();
        $data['jadwal'] = Krs::where('krs_mhs_id', $id_mhs)
            ->where('krs_ta_id', $data['ta']->ta_id)
            ->whereHas('matkul', function ($query) {
                $query->where('matkul_hari_order', date('N'));
            })
            ->with(['matkul', 'matkul.ruang'])
            ->get()
            ->sortBy(['matkul.matkul_jadwal']);
        $data['totSks'] = Krs::where('krs_ta_id', $data['ta']->ta_id)
            ->where('krs_mhs_id', $id_mhs)
            ->with('matkul')
            ->get()
            ->sum('matkul.matkul_sks');
        $data['ukts'] = Bayar::where('byr_type', 'ukt')
            ->where('byr_mhs_id', $id_mhs)
            ->orderBy('byr_id', 'DESC')
            ->with(['mahasiswa', 'mahasiswa.jurusan'])
            ->get();
        //new
        $data['cekUkt'] = Bayar::where('byr_type', 'ukt')
            ->where('byr_mhs_id', $id_mhs)
            ->where('byr_ta', $data['ta']->ta_kode)
            ->first() ?? null;
        return view('mahasiswa.index', $data);
    }

    public function indexKrs()
    {
        $mhs = Auth::user();
        $data['mhs'] = Mahasiswa::where('mhs_id', Auth::id())
            ->with('jurusan')
            ->first();
        $data['tas'] = TahunAjar::where(
            'ta_kode',
            '>=',
            $mhs->mhs_angkatan . '0'
        )
            ->orderBy('ta_kode', 'DESC')
            ->get();
        return view('mahasiswa.krs', $data);
    }

    public function indexKhs()
    {
        $mhs = Auth::user();
        $data['mhs'] = Mahasiswa::where('mhs_id', $mhs->mhs_id)
            ->with('jurusan')
            ->first();
        $data['tas'] = TahunAjar::where(
            'ta_kode',
            '>=',
            $mhs->mhs_angkatan . '0'
        )
            ->orderBy('ta_kode', 'DESC')
            ->get();
        return view('mahasiswa.khs', $data);
    }

    public function akun()
    {
        $data['mhs'] = Mahasiswa::where('mhs_id', Auth::id())
            ->with(['jurusan', 'pembimbing'])
            ->first();
        return view('mahasiswa.akun', $data);
    }

    public function dataDiri()
    {
        $data['mhs'] = Mahasiswa::where('mhs_id', Auth::id())
            ->with(['jurusan', 'pembimbing'])
            ->first();
        // $data['kecs'] = Kecamatan::orderBy('kec_nama', 'ASC')->get();
        $data['kels'] = Keldes::orderBy('kel_nama', 'ASC')->get();
        $data['agama'] = Agama::orderBy('agm_id', 'ASC')->get();
        $data['jalurDaftar'] = Adr::$jalurDaftar;
        $data['jenisDaftar'] = Adr::$jenisDaftar;
        $data['jenisPembiayaan'] = Adr::$jenisPembiayaan;
        $data['isBiodata'] = true;
        return view('pages.data_mhs', $data);
    }

    public function ukt()
    {
        $data['tas'] = TahunAjar::where(
            'ta_kode',
            '>=',
            Auth::user()->mhs_angkatan . '0'
        )
            ->orderBy('ta_kode', 'ASC')
            ->get();
        $data['mhs'] = Auth::user();
        return view('mahasiswa.ukt', $data);
    }
}
