<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class FakultasController extends Controller
{
    public function index()
    {

    }

    public function data()
    {
        $guard = Auth::getDefaultDriver();
        $data = Fakultas::orderBy('fk_nama', 'ASC')->with('pimpinan')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('menu', function ($row) use ($guard) {
                $raw = '';
                if ($guard == 'admin') {
                    $raw = '<a class="dropdown-toggle addon-btn" data-toggle="dropdown" aria-expanded="true">
                                <i class="icofont icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item pointer" onclick="initEdit('.$row->fk_id.')"><i class="icofont icofont-ui-edit"></i>Edit</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item pointer" onclick="initDelete(`deleteFakultas`, '.$row->fk_id.')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>
                            </div>';
                }
                return $raw;
            })
            ->rawColumns(['menu'])
            ->make(true);
    }

    public function get($id)
    {
        $data = Fakultas::where('fk_id', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function create(Request $request)
    {
        try {
            Fakultas::create($request->only(['fk_pimpinan_id', 'fk_nama', 'fk_alamat']));
            return response()->json([
                'status' => true,
                'msg' => "Fakultas berhasil ditambahkan"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => "Terjadi kesalahan. Mohon periksa data anda",
                'detail' => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            Fakultas::where('fk_id', $request->fk_id)->update($request->only(['fk_pimpinan_id', 'fk_nama', 'fk_alamat']));
            return response()->json([
                'status' => true,
                'msg' => "Perubahan tersimpan"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => "Terjadi kesalahan. Mohon periksa data anda",
                'detail' => $th->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            Fakultas::where('fk_id', $request->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => "Fakultas berhasil dihapus"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => "Data tidak diijinkan untuk dihapus!"
            ]);
        }
    }
}
