<?php

namespace App\Http\Controllers;

use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TaController extends Controller
{
    public function index()
    {
    }

    public function data()
    {
        $guard = Auth::getDefaultDriver();
        $data = TahunAjar::orderBy('ta_kode', 'DESC')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tahunx', function ($row) {
                $rw = $row->ta_kode % 2 == 0 ? 'genap' : 'ganjil';
                return $row->ta_kode . ' (' . $rw . ')';
            })
            ->addColumn('status', function ($row) {
                $rw =
                    '<label class="label label-lg label-primary"><i class="icofont icofont-ui-unlock"></i> Aktiv</label>';
                if ($row->ta_status == 0) {
                    $rw =
                        '<label class="label label-lg label-default"><i class="icofont icofont-lock"></i> Kunci</label>';
                }
                return $rw;
            })
            ->addColumn('menu', function ($row) use ($guard) {
                $raw = '';
                if ($guard == 'admin') {
                    $raw =
                        '<a class="dropdown-toggle addon-btn" data-toggle="dropdown" aria-expanded="true">
                                <i class="icofont icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item pointer" onclick="initKunci(' .
                        $row->ta_id .
                        ', 1)"><i class="icofont icofont-ui-unlock"></i>Buka</a>
                                <a class="dropdown-item pointer" onclick="initKunci(' .
                        $row->ta_id .
                        ', 0)"><i class="icofont icofont-lock"></i>Kunci</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item pointer" onclick="initDelete(`deleteTa`, ' .
                        $row->ta_id .
                        ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>
                            </div>';
                }
                return $raw;
            })
            ->rawColumns(['status', 'menu'])
            ->make(true);
    }

    public function get($id)
    {
    }

    public function create(Request $request)
    {
        try {
            $cek = TahunAjar::where('ta_kode', $request->ta_kode)->count();
            if ($cek >= 1) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Tahun Ajaran sudah ada',
                ]);
            }
            TahunAjar::create($request->only(['ta_kode']));
            return response()->json([
                'status' => true,
                'msg' => 'Tahun ajaran berhasil ditambahkan',
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
    }

    public function delete(Request $request)
    {
        try {
            TahunAjar::where('ta_id', $request->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Tahun ajaran berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Data nilai sudah ada. Tahun ajaran tidak diijinkan untuk dihapus!',
            ]);
        }
    }

    public function kunci(Request $request)
    {
        TahunAjar::where('ta_status', 1)->update(['ta_status' => 0]);
        TahunAjar::where('ta_id', $request->id)->update(
            $request->only(['ta_status'])
        );
        return response()->json([
            'status' => true,
            'msg' => 'Perubahan tersimpan',
        ]);
    }
}
