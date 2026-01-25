<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Image;

class DosenController extends Controller
{
    public function index() {}

    public function cariDosen($jur_id = 'all', Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $guard = Auth::getDefaultDriver();
            $user = Auth::user();
            if ($guard == 'admin') {
                if ($jur_id == 'all') {
                    $data = Dosen::where('ds_nip', 'LIKE', "%$cari%")
                        ->orWhere('ds_nama', 'LIKE', "%$cari%")
                        ->get();
                } else {
                    $data = Dosen::where('ds_jur_id', $jur_id)
                        ->where(function ($query) use ($cari) {
                            $query->where('ds_nip', 'LIKE', "%$cari%");
                            $query->orWhere('ds_nama', 'LIKE', "%$cari%");
                        })
                        ->orderBy('ds_nama', 'ASC')
                        ->get();
                }
            } else {
                $data = Dosen::where('ds_jur_id', $user->ds_jur_id)
                    ->where(function ($query) use ($cari) {
                        $query->where('ds_nip', 'LIKE', "%$cari%");
                        $query->orWhere('ds_nama', 'LIKE', "%$cari%");
                    })
                    ->orderBy('ds_nama', 'ASC')
                    ->get();
            }

            return response()->json($data);
        } else {
            return response()->json(['pesan' => 'Input Kosong']);
        }
    }

    public function getJadwal($ta_kode = null)
    {
        $tipe = 'ganjil';
        if ($ta_kode % 2 == 0) {
            $tipe = 'genap';
        }
        $dosen = Auth::id();

        $data = Matkul::whereJsonContains('matkul_dosen', json_encode($dosen))
            ->where('matkul_tipe', $tipe)
            ->with('ruang', 'jurusan')
            ->orderBy('matkul_hari_order', 'ASC')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jadwal', function ($row) {
                return $row->matkul_jadwal . ' - ' . $row->matkul_end;
            })
            ->addColumn('menu', function ($row) {
                $raw =
                    '<button type="buttom" onclick="infoJadwal(' .
                    $row->matkul_id .
                    ')" class="btn btn-sm btn-info btn-outline-info"><i class="icofont icofont-info-square"></i>Info</button>';
                return $raw;
            })
            ->rawColumns(['namanip', 'menu'])
            ->make(true);
    }

    public function data($id = 'all')
    {
        $guard = Auth::getDefaultDriver();
        $user = Auth::user();
        $level = 0;
        $link = route('lead.dosen.detail');
        if ($guard == 'admin') {
            $link = route('admin.pengajar.detail');
            if ($id == 'all') {
                $data = Dosen::select('*');
            } else {
                $data = Dosen::where('ds_jur_id', $id);
            }
        } else {
            $data = Dosen::where('ds_jur_id', $user->ds_jur_id);
            $level = $user->ds_level;
        }

        $data
            ->orderBy('ds_jur_id', 'ASC')
            ->orderBy('ds_level', 'DESC')
            ->orderBy('ds_nama', 'ASC')
            ->with(['jurusan'])
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('namanip', function ($row) {
                $class = 'text-primary';
                $jbt = '';
                if ($row->ds_level == 1 && $row->ds_kajur_id != 0) {
                    $class = 'text-warning';
                    $jbt = '(Kaprodi)';
                }
                return '<span class="' .
                    $class .
                    '">' .
                    $row->ds_nip .
                    '</span> ' .
                    $jbt .
                    '<br>' .
                    $row->ds_nama .
                    ', ' .
                    $row->ds_gelar;
            })
            ->addColumn('jurprodi', function ($row) {
                return $row->jurusan->jur_nama .
                    ' (' .
                    $row->jurusan->jur_jenjang .
                    ')';
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
                        $row->ds_id .
                        ')"><i class="icofont icofont-ui-edit"></i>Edit</a>
                                <a class="dropdown-item pointer" onclick="initReset(' .
                        $row->ds_id .
                        ')"><i class="icofont icofont-ui-unlock"></i>Reset Password</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item pointer" onclick="initBimbingan(' . $row->ds_id .
                        ')"><i class="icofont icofont-users text-warning"></i>Mahasiswa Bimbingan</a>
                                <a class="dropdown-item pointer" href="' . $link . '/' . $row->ds_id .
                        '"><i class="icofont icofont-id-card text-primary"></i>Detail</a>
                        <a class="dropdown-item pointer" onclick="initDelete(`deleteDosen`, ' .
                        $row->ds_id .
                        ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>
                            </div>';
                }
                return $raw;
            })
            ->rawColumns(['namanip', 'menu'])
            ->make(true);
    }

    public function get($id)
    {
        $data = Dosen::where('ds_id', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {
        try {
            Dosen::create([
                'ds_jur_id' => $request->ds_jur_id,
                'ds_nip' => $request->ds_nip,
                'ds_nama' => $request->ds_nama,
                'ds_alamat' => $request->ds_alamat,
                'ds_tlp' => $request->ds_tlp,
                'ds_jabatan' => $request->ds_jabatan,
                'ds_gelar' => $request->ds_gelar,
                'ds_pendidikan' => $request->ds_pendidikan,
                'password' => Hash::make($request->ds_nip),
            ]);
            return response()->json([
                'status' => true,
                'msg' => 'Dosen/Pengajar berhasil ditambahkan',
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
            $id_ds = Auth::id();
            $user = Auth::user();
            if ($guard == 'admin' || @$user->ds_level == 1) {
                $id_ds = $request->ds_id;
            }

            if (@$request->isBiodata) {
                $id_ds = Auth::id();
                session()->put('nama', $request->ds_nama);
            }

            $data = [];
            switch (@$request->update_tipe) {
                case '1':
                    $data = $request->only([
                        'ds_jur_id',
                        'ds_nip',
                        'ds_nama',
                        'ds_jabatan',
                        'ds_gelar',
                        'ds_pendidikan',
                        'ds_jk',
                        'ds_agama',
                        'ds_tempat_lahir',
                        'ds_tgl_lahir',
                    ]);
                    break;
                case '2':
                    $data = $request->only([
                        'ds_nik',
                        'ds_npwp',
                        'ds_no_regis',
                        'ds_ikatan_kerja',
                        'ds_status_pegawai',
                        'ds_jenis_pegawai',
                        'ds_no_sk_cpns',
                        'ds_tgl_sk_cpns',
                        'ds_no_sk_peng',
                        'ds_tgl_sk_peng',
                        'ds_lembaga_peng',
                        'ds_pangkat',
                        'ds_gol',
                        'ds_sumber_gaji',
                        'ds_alamat',
                        'ds_rt',
                        'ds_rw',
                        'ds_dusun',
                        'ds_kode_pos',
                        'ds_kelurahan',
                        'ds_kecamatan',
                        'ds_tlp',
                        'ds_email',
                    ]);
                    break;
                case '3':
                    $data = $request->only([
                        'ds_status_nikah',
                        'ds_pasangan_nama',
                        'ds_pasangan_nip',
                        'ds_pasangan_tmt',
                        'ds_pasangan_pekerjaan',
                    ]);
                    break;
                default:
                    Dosen::where('ds_id', $request->ds_id)->update(
                        $request->only([
                            'ds_jur_id',
                            'ds_nip',
                            'ds_nama',
                            'ds_jabatan',
                            'ds_gelar',
                            'ds_pendidikan',
                            'ds_tlp',
                            'ds_alamat',
                        ])
                    );
                    return response()->json([
                        'status' => true,
                        'msg' => 'Perubahan tersimpan',
                    ]);
                    break;
            }
            Dosen::where('ds_id', $id_ds)->update($data);
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

    public function delete(Request $request)
    {
        try {
            Dosen::where('ds_id', $request->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Dosen/Pengajar berhasil dihapus',
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
            $ds = Dosen::where('ds_id', $request->id)->first();
            $ds->password = Hash::make($ds->ds_nip . '+D0s3n');
            $ds->save();
            return response()->json([
                'status' => true,
                'msg' =>
                'Password Dosen/Pengajar berhasil direset menjadi : ' . $ds->ds_nip . '+D0s3n',
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
        $user = Dosen::find(Auth::id());
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
            $id_ds = Auth::id();
            $user = Auth::user();

            if ($guard == 'admin' || @$user->ds_level == 1) {
                $id_ds = $request->ds_id;
            }

            if (@$request->isBiodata) {
                $id_ds = Auth::id();
            }

            $lokasi = 'komponen/assets/images/user/';
            $newName = 'ds_foto_' . time() . '-' . rand(100, 10000) . '.jpg';
            $img = Image::make($request->foto)
                ->encode('jpg', 100)
                ->orientate();
            $img
                ->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($lokasi . $newName);
            Dosen::where('ds_id', $id_ds)->update([
                'ds_foto' => $lokasi . $newName,
            ]);
            return redirect()
                ->back()
                ->with('success', 'Foto tersimpan');
        }
    }
}
