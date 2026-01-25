<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\Adr;
use App\Helpers\NilaiHelper;
use App\Http\Controllers\Controller;
use App\Models\{
    Agama,
    Dosen,
    Fakultas,
    Jurusan,
    Kecamatan,
    Keldes,
    Mahasiswa,
    Matkul,
    Ruang,
    TahunAjar,
    User,
    Waktu
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminPageController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $jadPen = Waktu::where('wk_status', 1)
                ->with('ta')
                ->first();
            View::share('jadPen', $jadPen);
            return $next($request);
        });
    }

    public function index()
    {
        $data['mhs'] = Mahasiswa::count();
        $data['dosen'] = Dosen::count();
        $data['jurusan'] = Jurusan::count();
        $data['newTa'] = TahunAjar::max('ta_kode');

        $data['countMhs'] = Adr::getMahasiswaAng();
        $data['countDosen'] = Adr::getDosenProdi();

        $data['mhs_by_sts'] = Adr::dataMhsBySts();
        // dd($data['mhs_by_sts']);

        return view('admin.index', $data);
    }

    public function tahunAjar()
    {
        return view('admin.ta');
    }

    // public function fakultas()
    // {
    //     $data['dosens'] = Dosen::orderBy('ds_nama', 'ASC')->get();
    //     return view('admin.fakultas', $data);
    // }

    public function jurusan()
    {
        $data['dosens'] = Dosen::orderBy('ds_jur_id', 'DESC')
            ->orderBy('ds_nama', 'ASC')
            ->with('jurusan')
            ->get();
        return view('admin.jurusan', $data);
    }

    public function ruangan()
    {
        return view('admin.ruangan');
    }

    public function pengajar()
    {
        // $data['fakultas'] = Fakultas::orderBy('fk_nama', 'ASC')->with('pimpinan')->get();
        $data['jurusan'] = Jurusan::orderBy('jur_fk_id', 'ASC')
            ->orderBy('jur_nama', 'ASC')
            ->with(['pimpinan'])
            ->get();
        return view('admin.pengajar', $data);
    }

    public function detailPengajar($id)
    {
        $data['dosen'] = Dosen::with(['jurusan'])->find($id);
        $data['agama'] = Agama::orderBy('agm_id', 'ASC')->get();
        // $data['kecs'] = Kecamatan::orderBy('kec_nama', 'ASC')->get();
        $data['kels'] = Keldes::orderBy('kel_nama', 'ASC')->get();
        return view('pages.data_dosen', $data);
    }

    public function mahasiswa()
    {
        $data['jurusan'] = Jurusan::orderBy('jur_fk_id', 'ASC')
            ->orderBy('jur_nama', 'ASC')
            ->with(['pimpinan'])
            ->get();
        $data['agama'] = Agama::orderBy('agm_id', 'ASC')->get();
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        $data['stsMahasiswa'] = Adr::$stsMahasiswa;
        return view('admin.mahasiswa', $data);
    }

    public function detailMahasiswa($id)
    {
        $data['mhs'] = Mahasiswa::where('mhs_id', $id)
            ->with(['jurusan', 'pembimbing', 'kecamatan'])
            ->first();
        // $data['kecs'] = Kecamatan::orderBy('kec_nama', 'ASC')->get();
        // $data['kels'] = Keldes::orderBy('kel_nama', 'ASC')->get();
        $data['agama'] = Agama::orderBy('agm_id', 'ASC')->get();
        $data['jalurDaftar'] = Adr::$jalurDaftar;
        $data['jenisDaftar'] = Adr::$jenisDaftar;
        $data['jenisPembiayaan'] = Adr::$jenisPembiayaan;
        return view('pages.data_mhs', $data);
    }

    public function mataKuliah()
    {
        $data['dosens'] = Dosen::orderBy('ds_nama', 'ASC')
            ->with('jurusan')
            ->get();
        $data['ruangs'] = Ruang::orderBy('ruang_nama', 'ASC')->get();
        $data['jurusan'] = Jurusan::orderBy('jur_fk_id', 'ASC')
            ->orderBy('jur_nama', 'ASC')
            ->get();
        return view('admin.matkul', $data);
    }

    public function pengaturan()
    {
        return view('admin.pengaturan');
    }

    public function akun()
    {
        $data['akun'] = User::find(Auth::id());
        return view('admin.akun', $data);
    }

    public function ukt()
    {
        NilaiHelper::cekValid();
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        $data['jurusan'] = Jurusan::orderBy('jur_fk_id', 'ASC')
            ->orderBy('jur_nama', 'ASC')
            ->get();
        return view('admin.ukt_data', $data);
    }

    public function stsMhs()
    {
        $data['jurusans'] = Jurusan::orderBy('jur_jenjang', 'ASC')
            ->orderBy('jur_nama', 'ASC')
            ->with('mahasiswas')
            ->get();

        $st_tot_mhs = [];
        $tot_mhs = Mahasiswa::count();
        $tot_pria = Mahasiswa::where('mhs_jk', 'Laki-laki')->count();
        $tot_wanita = Mahasiswa::where('mhs_jk', 'Perempuan')->count();

        foreach ($data['jurusans'] as $jur) {
            $x['jur_nama'] = $jur->jur_nama . ' (' . $jur->jur_jenjang . ')';
            $x['tot_mhs'] = $jur->mahasiswas()->count();
            array_push($st_tot_mhs, $x);
        }

        $data['st_tot_mhs'] = collect($st_tot_mhs);
        $data['tot_mhs'] = $tot_mhs;
        $data['tot_pria'] = $tot_pria;
        $data['tot_wanita'] = $tot_wanita;

        $mhs_by_year = [];
        for ($i = date('Y') + 1; $i >= 2019; $i--) {
            $y['tahun'] = $i;
            $y['tot_mhs'] = Mahasiswa::where('mhs_angkatan', $i)->count();
            array_push($mhs_by_year, $y);
        }
        $data['mhs_by_year'] = collect($mhs_by_year);

        return view('pages.sts_mhs', $data);
    }

    public function laporan()
    {
        $data['jurusans'] = Jurusan::orderBy('jur_jenjang', 'ASC')
            ->orderBy('jur_nama', 'ASC')
            ->get();
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        return view('pages.laporan', $data);
    }

    public function jadwalPen()
    {
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        $data['jadwals'] = Waktu::select('*')
            ->with('ta')
            ->get()
            ->sortByDesc('ta.ta_kode');
        return view('admin.jadwal_pen', $data);
    }

    // public function tess()
    // {
    //     $data = [];
    //     if (Storage::disk('local')->exists('kecamatan.json')) {
    //         $data = Storage::disk('local')->get('kecamatan.json');
    //     }
    //     foreach (json_decode($data) as $key) {
    //         Kecamatan::create([
    //             'kec_kode' => $key->kode,
    //             'kec_nama' => $key->Kecamatan,
    //             'kec_kabkota' => $key->Kabupaten,
    //             'kec_prov' => $key->Provinsi,
    //         ]);
    //     }
    //     echo "OK";
    // }
}
