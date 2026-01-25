<?php

namespace App\Http\Controllers;

use App\Models\{Dosen, Jurusan};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JurusanController extends Controller
{
    public function index()
    {
    }

    public function data()
    {
        $guard = Auth::getDefaultDriver();
        $data = Jurusan::orderBy('jur_fk_id', 'ASC')
            ->orderBy('jur_nama', 'ASC')
            ->with(['pimpinan', 'fakultas'])
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('menu', function ($row) use ($guard) {
                $raw = '';
                if ($guard == 'admin') {
                    $raw =
                        '<a class="dropdown-toggle addon-btn" data-toggle="dropdown" aria-expanded="true">
                                <i class="icofont icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item pointer" onclick="initEdit(' .
                        $row->jur_id .
                        ')"><i class="icofont icofont-ui-edit"></i>Edit</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item pointer" onclick="initDelete(`deleteJurusan`, ' .
                        $row->jur_id .
                        ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>
                            </div>';
                }
                return $raw;
            })
            ->rawColumns(['menu'])
            ->make(true);
    }

    public function get($id)
    {
        $data = Jurusan::where('jur_id', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function _updatePimpinan($ds_id, $jur_id)
    {
        Dosen::where('ds_jur_id', $jur_id)->update(['ds_level' => 0, 'ds_kajur_id' => '0']);

        $dosen = Dosen::find($ds_id);
        $dosen->ds_level = 1;
        $dosen->ds_kajur_id = $jur_id;
        $dosen->save();
    }

    public function create(Request $request)
    {
        try {
            $newJur = Jurusan::create(
                $request->only([
                    'jur_pimpinan_id',
                    'jur_nama',
                    'jur_jenjang',
                    'jur_alamat',
                    'jur_kode',
                ])
            );

            if (@$request->jur_pimpinan_id) {
                $this->_updatePimpinan($request->jur_pimpinan_id, $newJur->jur_id);
            }

            return response()->json([
                'status' => true,
                'msg' => 'Jurusan berhasil ditambahkan',
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
            Jurusan::where('jur_id', $request->jur_id)->update(
                $request->only([
                    'jur_pimpinan_id',
                    'jur_nama',
                    'jur_jenjang',
                    'jur_alamat',
                    'jur_kode',
                ])
            );

            if (@$request->jur_pimpinan_id) {
                $this->_updatePimpinan($request->jur_pimpinan_id, $request->jur_id);
            }

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
            Jurusan::where('jur_id', $request->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Jurusan berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Data tidak diijinkan untuk dihapus!',
            ]);
        }
    }
}
