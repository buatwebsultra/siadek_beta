<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RuangController extends Controller
{
    public function data()
    {
        $data = Ruang::orderBy('ruang_nama', 'ASC')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('menu', function ($row) {
                $raw =
                    '<a class="dropdown-toggle addon-btn" data-toggle="dropdown" aria-expanded="true">
                                <i class="icofont icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item pointer" onclick="initEdit(' .
                    $row->ruang_id .
                    ', 1)"><i class="icofont icofont-ui-edit"></i>Edit</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item pointer" onclick="initDelete(`deleteRuang`, ' .
                    $row->ruang_id .
                    ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>
                            </div>';
                return $raw;
            })
            ->rawColumns(['menu'])
            ->make(true);
    }

    public function get($id)
    {
        $data = Ruang::where('ruang_id', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {
        try {
            Ruang::create(
                $request->only([
                    'ruang_nama',
                    'ruang_lokasi',
                    'ruang_kapasitas',
                    'ruang_ket',
                ])
            );
            return response()->json([
                'status' => true,
                'msg' => 'Ruangan berhasil ditambahkan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Terjadi kesalahan. Mohon periksa data anda',
            ]);
        }
        return 0;
    }

    public function update(Request $request)
    {
        try {
            Ruang::where('ruang_id', $request->ruang_id)->update(
                $request->only([
                    'ruang_nama',
                    'ruang_lokasi',
                    'ruang_kapasitas',
                    'ruang_ket',
                ])
            );
            return response()->json([
                'status' => true,
                'msg' => 'Perubahan tersimpan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Terjadi kesalahan. Mohon periksa data anda',
            ]);
        }
        return 0;
    }

    public function delete(Request $request)
    {
        try {
            Ruang::where('ruang_id', $request->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Ruangan berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Ruangan tidak diijinkan untuk dihapus!',
            ]);
        }
    }
}
