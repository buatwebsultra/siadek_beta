<?php

namespace App\Http\Controllers;

use App\Helpers\Adr;
use App\Models\{Mahasiswa, TahunAjar};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Image;

class MahasiswaController extends Controller
{
    public function cariMhs($jur_id = 'all', Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $guard = Auth::getDefaultDriver();
            $user = Auth::user();
            if ($guard == 'admin') {
                if ($jur_id == 'all') {
                    $data = Mahasiswa::where('mhs_nim', 'LIKE', "%$cari%")
                        ->orWhere('mhs_nama', 'LIKE', "%$cari%")
                        ->orderBy('mhs_angkatan', 'ASC')
                        ->orderBy('mhs_nama', 'ASC')
                        ->get();
                } else {
                    $data = Mahasiswa::where('mhs_jur_id', $jur_id)
                        ->where(function ($query) use ($cari) {
                            $query
                                ->where('mhs_nim', 'LIKE', "%$cari%")
                                ->orWhere('mhs_nama', 'LIKE', "%$cari%");
                        })
                        ->orderBy('mhs_angkatan', 'ASC')
                        ->orderBy('mhs_nama', 'ASC')
                        ->get();
                }
            } else {
                $data = Mahasiswa::where('mhs_jur_id', $user->ds_jur_id)
                    ->where(function ($query) use ($cari) {
                        $query
                            ->where('mhs_nim', 'LIKE', "%$cari%")
                            ->orWhere('mhs_nama', 'LIKE', "%$cari%");
                    })
                    ->orderBy('mhs_angkatan', 'ASC')
                    ->orderBy('mhs_nama', 'ASC')
                    ->get();
            }

            return response()->json($data);
        } else {
            return response()->json(['pesan' => 'Input Kosong']);
        }
    }

    public function data($id = 'all')
    {
        $guard = Auth::getDefaultDriver();
        $user = Auth::user();
        $level = 0;
        $link = route('lead.mahasiswa.detail');

        if ($guard == 'admin') {
            $link = route('admin.mahasiswa.detail');
            if ($id == 'all') {
                $data = Mahasiswa::select('*');
            } else {
                $data = Mahasiswa::where('mhs_jur_id', $id);
            }
        } else {
            $data = Mahasiswa::where('mhs_jur_id', $user->ds_jur_id);
            $level = $user->ds_level;
        }

        $data
            ->orderBy('mhs_jur_id', 'ASC')
            ->orderBy('mhs_angkatan', 'DESC')
            ->orderBy('mhs_nama', 'ASC')
            ->with(['jurusan'])
            ->get();

        $stsMahasiswa = Adr::$stsMahasiswa;
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('namakunci', function ($row) {
                $statusKunci = '';
                if ($row->mhs_kunci_data == 1) {
                    $statusKunci =
                        ' <label class="label label-primary" onclick="initBuka(' .
                        $row->mhs_id .
                        ')"><i class="icofont icofont-ui-lock"></i></label>';
                }
                $raw = $row->mhs_nama . $statusKunci;
                return $raw;
            })
            ->addColumn('status1', function ($row) use ($stsMahasiswa) {
                return $stsMahasiswa[$row->mhs_status];
            })
            ->addColumn('menu', function ($row) use ($guard, $level, $link) {
                $raw = '';
                if ($guard == 'admin' || $level == 1) {
                    $raw =
                        '<a class="dropdown-toggle addon-btn" data-toggle="dropdown" aria-expanded="true">
                                <i class="icofont icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item pointer" onclick="initEdit(' .
                        $row->mhs_id .
                        ')"><i class="icofont icofont-ui-edit"></i>Edit</a>
                                <a class="dropdown-item pointer" onclick="initReset(' .
                        $row->mhs_id .
                        ')"><i class="icofont icofont-ui-unlock"></i>Reset Password</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item pointer" onclick="resetNilai(' .
                        $row->mhs_id .
                        ', `' .
                        $row->mhs_nama .
                        '`)"><i class="icofont icofont-refresh text-warning"></i>Reset Nilai Mahasiswa</a>
                                <a class="dropdown-item pointer" href="' .
                        $link .
                        '/' .
                        $row->mhs_id .
                        '"><i class="icofont icofont-id-card text-primary"></i>Detail</a>
                                <a class="dropdown-item pointer" onclick="initDelete(`deleteMhs`, ' .
                        $row->mhs_id .
                        ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>
                            </div>';
                }
                return $raw;
            })
            ->rawColumns(['namakunci', 'menu'])
            ->make(true);
    }

    public function get($id)
    {
        $data = Mahasiswa::where('mhs_id', $id)
            ->with(['fakultas', 'jurusan', 'pembimbing'])
            ->first();
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {
        try {
            $mhs = Mahasiswa::create([
                'mhs_jur_id' => $request->mhs_jur_id,
                'mhs_dosen_id' => $request->mhs_dosen_id,
                'mhs_nim' => $request->mhs_nim,
                'mhs_nama' => $request->mhs_nama,
                'mhs_angkatan' => $request->mhs_angkatan,
                'mhs_tlp' => $request->mhs_tlp,
                'mhs_email' => $request->mhs_email,
                'mhs_jk' => $request->mhs_jk,
                'mhs_agama' => $request->mhs_agama,
                'mhs_tgl_lahir' => $request->mhs_tgl_lahir,
                'mhs_tmpt_lahir' => $request->mhs_tmpt_lahir,
                'password' => Hash::make($request->mhs_nim),
                'mhs_status' => $request->mhs_status
            ]);
            $mhs->_updateSemesterData();
            return response()->json([
                'status' => true,
                'msg' => 'Mahasiswa berhasil ditambahkan',
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
            $guard = Auth::getDefaultDriver();
            $id_mhs = Auth::id();
            $user = Auth::user();
            if ($guard == 'admin' || @$user->ds_level == 1) {
                $id_mhs = $request->id_mhs;
            }

            if (@$request->isBiodata) {
                $id_mhs = Auth::id();
            }

            $data = [];
            switch (@$request->update_tipe) {
                case '1':
                    $data = $request->only([
                        'mhs_nama',
                        'mhs_jk',
                        'mhs_agama',
                        'mhs_tgl_lahir',
                        'mhs_tmpt_lahir',
                        'mhs_tlp',
                        'mhs_email',
                        'mhs_jalur_daftar',
                        'mhs_jenis_daftar',
                        'mhs_jenis_biaya',
                        'mhs_tgl_masuk'
                    ]);
                    if (@$request->isBiodata) {
                        session()->put('nama', $request->mhs_nama);
                    }
                    break;
                case '2':
                    $data = $request->only([
                        'mhs_wn',
                        'mhs_nik',
                        'mhs_nisn',
                        'mhs_npwp',
                        'mhs_alamat',
                        'mhs_dusun',
                        'mhs_rt',
                        'mhs_rw',
                        'mhs_kelurahan',
                        'mhs_kecamatan',
                        'mhs_kode_pos',
                        'mhs_kps',
                        'mhs_jenis_tinggal',
                        'mhs_transportasi',
                        'mhs_kps_no'
                    ]);
                    break;
                case '3':
                    $data = $request->only([
                        'mhs_ayah_nik',
                        'mhs_ayah_nama',
                        'mhs_ayah_tgl_lahir',
                        'mhs_ayah_pendidikan',
                        'mhs_ayah_pekerjaan',
                        'mhs_ayah_penghasilan',
                        'mhs_ibu_nik',
                        'mhs_ibu_nama',
                        'mhs_ibu_tgl_lahir',
                        'mhs_ibu_pendidikan',
                        'mhs_ibu_pekerjaan',
                        'mhs_ibu_penghasilan',
                    ]);
                    break;
                default:
                    Mahasiswa::where('mhs_id', $request->mhs_id)->update([
                        'mhs_jur_id' => $request->mhs_jur_id,
                        'mhs_dosen_id' => $request->mhs_dosen_id,
                        'mhs_nim' => $request->mhs_nim,
                        'mhs_nama' => $request->mhs_nama,
                        'mhs_angkatan' => $request->mhs_angkatan,
                        'mhs_tlp' => $request->mhs_tlp,
                        'mhs_email' => $request->mhs_email,
                        'mhs_jk' => $request->mhs_jk,
                        'mhs_agama' => $request->mhs_agama,
                        'mhs_tgl_lahir' => $request->mhs_tgl_lahir,
                        'mhs_tmpt_lahir' => $request->mhs_tmpt_lahir,
                        'mhs_status' => $request->mhs_status
                    ]);
                    $mhs = Mahasiswa::find($request->mhs_id);
                    $mhs->_updateSemesterData();
                    return response()->json([
                        'status' => true,
                        'msg' => 'Perubahan tersimpan',
                    ]);
                    break;
            }
            Mahasiswa::where('mhs_id', $id_mhs)->update($data);
            return redirect()
                ->back()
                ->with('success', 'Perubahan tersimpan');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Terjadi kesalahan. Mohon periksa data anda',
                'detail' => $th->getMessage(),
            ]);
        }
    }

    public function _updateSemesterData($mhs_id)
    {
        $mhs = Mahasiswa::find($mhs_id);
        $tas = TahunAjar::where('ta_kode', '>=', $mhs->mhs_angkatan . '0')
            ->orderBy('ta_kode', 'ASC')
            ->get();
        $mhs_semester_data = [];
        $index = 1;
        foreach ($tas as $ta) {
            $mhs_semester_data[$ta->ta_kode] = $index;
            $index++;
        }
        $mhs->mhs_semester_data = json_encode($mhs_semester_data);
        $mhs->save();
    }

    public function delete(Request $request)
    {
        try {
            Mahasiswa::where('mhs_id', $request->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Mahasiswa berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Data tidak diijinkan untuk dihapus!',
            ]);
        }
    }

    public function reset(Request $request)
    {
        try {
            $mhs = Mahasiswa::where('mhs_id', $request->id)->first();
            $mhs->password = Hash::make($mhs->mhs_nim . '+Mahasisw@');
            $mhs->save();
            return response()->json([
                'status' => true,
                'msg' => 'Password Mahasiswa berhasil direset menjadi : ' . $mhs->mhs_nim . '+Mahasisw@',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Terjadi kesalahan. Mohon periksa data anda',
            ]);
        }
    }

    public function updatePass(Request $request)
    {
        if ($request->pass_b != $request->pass_b2) {
            return response()->json([
                'status' => false,
                'msg' => 'Password baru tidak cocok',
            ]);
        }
        $user = Mahasiswa::find(Auth::id());
        if (Hash::check($request->pass_l, $user->password)) {
            $user->password = Hash::make($request->pass_b);
            $user->save();
            return response()->json([
                'status' => true,
                'msg' => 'Password berhasil diubah',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Password lama anda salah',
            ]);
        }
    }

    public function setFoto(Request $request)
    {
        $rules = [
            'foto' => 'mimes:jpeg,jpg,png|max:2000', // max 10000kb
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'Gambar tidak valid');
        } else {
            $guard = Auth::getDefaultDriver();
            $id_mhs = Auth::id();
            $user = Auth::user();

            if ($guard == 'admin' || @$user->ds_level == 1) {
                $id_mhs = $request->id_mhs;
            }

            if (@$request->isBiodata) {
                $id_mhs = Auth::id();
            }

            $lokasi = 'komponen/assets/images/user/';
            $newName = 'foto_' . time() . '-' . rand(100, 10000) . '.jpg';
            Image::make($request->foto)
                ->encode('jpg', 100)
                ->orientate()
                ->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($lokasi . $newName);
            Mahasiswa::where('mhs_id', $id_mhs)->update([
                'mhs_foto' => $lokasi . $newName,
            ]);
            return redirect()
                ->back()
                ->with('success', 'Foto tersimpan');
        }
    }

    public function cekMenu(Request $request)
    {
        $kode = implode('-', ['x', $request->mhs_id, $request->ta_id]);
        if ($request->tipe == 'krs') {
            return redirect()->route('print.krs', $kode);
        }

        if ($request->tipe == 'khs') {
            return redirect()->route('print.khs', $kode);
        }

        if ($request->tipe == 'trans') {
            return redirect()->route('print.transkrip', $kode);
        }
    }

    public function KunciBiodata(Request $request)
    {
        Mahasiswa::where('mhs_id', $request->mhs_id)->update([
            'mhs_kunci_data' => 1,
        ]);
        return redirect()
            ->back()
            ->with('success', 'Data terkunci');
    }

    public function bukaBiodata(Request $request)
    {
        Mahasiswa::where('mhs_id', $request->mhs_id)->update([
            'mhs_kunci_data' => 0,
        ]);
        return response()->json([
            'status' => true,
            'msg' => 'Kunci dibuka',
        ]);
    }
}
