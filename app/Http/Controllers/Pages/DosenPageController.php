<?php

namespace App\Http\Controllers\Pages;

use App\Helpers\Adr;
use App\Http\Controllers\Controller;
use App\Models\{
    Agama,
    Dosen,
    Jurusan,
    Keldes,
    Krs,
    Mahasiswa,
    Matkul,
    Ruang,
    SetNilai,
    TahunAjar,
    Waktu
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DosenPageController extends Controller
{
    public $jur_id;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // $taAktiv = TahunAjar::where('ta_status', 1)->first();

            // if(!$taAktiv){
            //     $taAktiv = TahunAjar::latest('ta_id')->first();
            // }
            $this->_cekWaktuNilai();
            $jadPen = Waktu::with('ta')->first();
            View::share('jadPen', $jadPen);
            return $next($request);
        });
    }

    public function _cekWaktuNilai()
    {
        $jad = Waktu::with('ta')->first();
        
        if ($jad) {
            $status = 0;
            if ($jad->wk_tgl_end > date('Y-m-d')) {
                $status = 1;
            }
    
            if ($jad->wk_tgl_end == date('Y-m-d') && $jad->wk_jam_end > date('H:i')) {
                $status = 1;
            }
    
            $jad->wk_status = $status;
            $jad->save();
        }
    }


    public function index()
    {
        $id_ds = Auth::id();
        $dosen = Auth::user();
        $data['dosen'] = Dosen::where('ds_id', $id_ds)
            ->with(['mahasiswas', 'jurusan'])
            ->first();
        $data['matkul'] = Matkul::whereJsonContains(
            'matkul_dosen',
            json_encode($data['dosen']->ds_id)
        )->count();

        $data['jml_dosen'] = Dosen::where('ds_jur_id', $dosen->ds_jur_id)->count();
        $data['jml_mhs'] = Mahasiswa::where('mhs_jur_id', $dosen->ds_jur_id)->count();
        $data['countMhs'] = Adr::getMahasiswaAng($dosen->ds_jur_id);
        $data['mhs_by_sts'] = Adr::dataMhsBySts($dosen->ds_jur_id);

        // dd($data['countMhs']);
        return view('dosen.index', $data);
    }

    public function jadwal()
    {
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        return view('dosen.jadwal', $data);
    }

    public function mahasiswa($angkatan = 'all')
    {
        $data['angkatan'] = $angkatan;
        $qr = Mahasiswa::where('mhs_dosen_id', Auth::id());
        if ($angkatan != 'all') {
            $qr->where('mhs_angkatan', $angkatan);
        }
        $data['msiswa'] = $qr->with('jurusan')
            ->orderBy('mhs_jur_id', 'ASC')
            ->orderBy('mhs_angkatan', 'DESC')
            ->get();
        return view('dosen.mahasiswa', $data);
    }

    public function penilaian()
    {
        $ds = Auth::user();
        $data['setNilai'] = SetNilai::where(
            'sn_jur_id',
            $ds->ds_jur_id
        )->count();
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        return view('dosen.penilaian', $data);
    }

    public function penilaianDetail($kode)
    {
        $param = explode('-', $kode); // ta_id, matkul_id
        $ds = Auth::user();
        $data['dosen'] = $ds;
        $data['ta'] = TahunAjar::find($param[0]);
        $data['matkul'] = Matkul::where('matkul_id', $param[1])
            ->with(['ruang', 'jurusan'])
            ->first();
        if (!in_array(Auth::id(), json_decode($data['matkul']->matkul_dosen))) {
            return redirect()
                ->back()
                ->with('error', 'Akses dibatasi!');
        }

        //cek jadwal input
        $jadPen = Waktu::where('wk_ta_id', $data['ta']->ta_id)->first();
        if (!$jadPen->wk_status == 1) {
            return redirect()
                ->route('lecturer.penilaian')
                ->with('error', 'Jadwal penilaian belum dibuka');
        }

        $krs = Krs::where('krs_ta_id', $param[0])
            ->where('krs_matkul_id', $param[1])
            ->get('krs_mhs_id')
            ->pluck('krs_mhs_id');

        $data['mahasiswa'] = Mahasiswa::whereIn('mhs_id', $krs)
            ->with([
                'krs' => function ($q) use ($param) {
                    $q->where('krs_ta_id', $param[0]);
                    $q->where('krs_matkul_id', $param[1]);
                },
            ])
            ->orderBy('mhs_nama', 'ASC')
            ->get();

        $data['setNilai'] = SetNilai::where(
            'sn_jur_id',
            $ds->ds_jur_id
        )->first();

        return view('dosen.penilaian_detail', $data);
    }

    public function dataDiri()
    {
        $data['dosen'] = Dosen::with(['jurusan'])->find(Auth::id());
        $data['agama'] = Agama::orderBy('agm_id', 'ASC')->get();
        // $data['kecs'] = Kecamatan::orderBy('kec_nama', 'ASC')->get();
        $data['kels'] = Keldes::orderBy('kel_nama', 'ASC')->get();
        $data['isBiodata'] = true;
        return view('pages.data_dosen', $data);
    }

    public function akun()
    {
        $data['akun'] = Dosen::find(Auth::id());
        return view('dosen.akun', $data);
    }

    public function dosen()
    {
        $data['dosen'] = Dosen::where('ds_id', Auth::id())
            ->with('jurusan')
            ->first();
        $data['jurusan'] = Jurusan::orderBy('jur_fk_id', 'ASC')
            ->orderBy('jur_nama', 'ASC')
            ->with(['pimpinan'])
            ->get();
        return view('admin.pengajar', $data);
    }

    public function leadMahasiswa()
    {
        $data['kaprodi'] = Dosen::where('ds_id', Auth::id())
            ->with('jurusan')
            ->first();
        $data['dosens'] = Dosen::where('ds_jur_id', $data['kaprodi']->ds_jur_id)
            ->orderBy('ds_level', 'DESC')
            ->orderBy('ds_nama', 'ASC')
            ->get();
        $data['jurusan'] = Jurusan::where('jur_id', $data['kaprodi']->ds_jur_id)
            ->orderBy('jur_nama', 'ASC')
            ->with(['pimpinan'])
            ->get();
        $data['agama'] = Agama::orderBy('agm_id', 'ASC')->get();
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        $data['stsMahasiswa'] = Adr::$stsMahasiswa;
        return view('admin.mahasiswa', $data);
    }

    public function detailPengajar($id)
    {
        $data['dosen'] = Dosen::with(['jurusan'])->find($id);
        $data['agama'] = Agama::orderBy('agm_id', 'ASC')->get();
        // $data['kecs'] = Kecamatan::orderBy('kec_nama', 'ASC')->get();
        $data['kels'] = Keldes::orderBy('kel_nama', 'ASC')->get();
        $data['isKaprodi'] = true;
        return view('pages.data_dosen', $data);
    }

    public function detailMahasiswa($id)
    {
        $data['mhs'] = Mahasiswa::where('mhs_id', $id)
            ->with(['jurusan', 'pembimbing', 'kecamatan'])
            ->first();
        // $data['kels'] = Keldes::orderBy('kel_nama', 'ASC')->get();
        $data['agama'] = Agama::orderBy('agm_id', 'ASC')->get();
        $data['jalurDaftar'] = Adr::$jalurDaftar;
        $data['jenisDaftar'] = Adr::$jenisDaftar;
        $data['jenisPembiayaan'] = Adr::$jenisPembiayaan;
        $data['isKaprodi'] = true;
        return view('pages.data_mhs', $data);
    }

    public function matkul()
    {
        $ds = Auth::user();
        $data['ruangs'] = Ruang::orderBy('ruang_nama', 'ASC')->get();
        $data['dosens'] = Dosen::orderBy('ds_nama', 'ASC')
            ->with('jurusan')
            ->get();
        $data['jurusan'] = Jurusan::where('jur_id', $ds->ds_jur_id)->get();
        $data['isKaprodi'] = true;
        return view('admin.matkul', $data);
    }

    public function kemahasiswaan()
    {
        $ds = Auth::user();
        $data['isKaprodi'] = true;
        $data['jurusan'] = Jurusan::where('jur_id', $ds->ds_jur_id)->get();
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        return view('pages.kemahasiswaan', $data);
    }

    public function setPenilaian()
    {
        $ds = Auth::user();
        $data['isKaprodi'] = true;
        $data['jurusan'] = Jurusan::where('jur_id', $ds->ds_jur_id)->first();

        $setNilai = SetNilai::where('sn_jur_id', $ds->ds_jur_id)->first();
        if (!$setNilai) {
            SetNilai::create(['sn_jur_id' => $ds->ds_jur_id]);
            $data['setNilai'] = SetNilai::where(
                'sn_jur_id',
                $ds->ds_jur_id
            )->first();
        } else {
            $data['setNilai'] = $setNilai;
        }

        return view('pages.set_penilaian', $data);
    }

    public function stsMhs()
    {
        $ds = Auth::user();
        $data['jurusans'] = Jurusan::where('jur_id', $ds->ds_jur_id)
            ->orderBy('jur_jenjang', 'ASC')
            ->with('mahasiswas')
            ->get();

        $st_tot_mhs = [];
        $tot_mhs = Mahasiswa::where('mhs_jur_id', $ds->ds_jur_id)->count();
        $tot_pria = Mahasiswa::where('mhs_jur_id', $ds->ds_jur_id)
            ->where('mhs_jk', 'Laki-laki')
            ->count();
        $tot_wanita = Mahasiswa::where('mhs_jur_id', $ds->ds_jur_id)
            ->where('mhs_jk', 'Perempuan')
            ->count();

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
        for ($i = date('Y') + 1; $i >= 2022; $i--) {
            $y['tahun'] = $i;
            $y['tot_mhs'] = Mahasiswa::where('mhs_jur_id', $ds->ds_jur_id)
                ->where('mhs_angkatan', $i)
                ->count();
            array_push($mhs_by_year, $y);
        }
        $data['mhs_by_year'] = collect($mhs_by_year);

        return view('pages.sts_mhs', $data);
    }

    // public function jadwalPen()
    // {
    //     $ds = Auth::user();
    //     $data['isKaprodi'] = true;
    //     $data['jurusan'] = Jurusan::where('jur_id', $ds->ds_jur_id)->first();
    //     $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
    //     $data['jadwals'] = Waktu::where('wk_jur_id', $ds->ds_jur_id)
    //         ->with('ta')
    //         ->get()
    //         ->sortByDesc('ta.ta_kode');
    //     return view('pages.jadwal_pen', $data);
    // }

    public function laporan()
    {
        $ds = Auth::user();
        $data['jurusans'] = Jurusan::where('jur_id', $ds->ds_jur_id)->get();
        $data['tas'] = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        return view('pages.laporan', $data);
    }
}
