<?php

namespace App\Http\Controllers;

use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaktuController extends Controller
{
    public function get($id = '-')
    {
        $data = Waktu::find($id);
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function insert(Request $request)
    {
        // $ds = Auth::user();
        $cek = Waktu::count();
        if ($cek >= 1) {
            return redirect()->back()->with('error', 'Jadwal penilaian sudah ada.');
        }
        Waktu::create([
            'wk_ta_id' => $request->wk_ta_id,
            'wk_jur_id' => 1,
            'wk_status' => 1,
            'wk_tgl_end' => $request->wk_tgl_end,
            'wk_jam_end' => $request->wk_jam_end,
        ]);
        return redirect()->back()->with('success', 'Waktu penilaian ditambahkan');
    }

    // public function insert(Request $request)
    // {
    //     $ds = Auth::user();
    //     $cek = Waktu::where('wk_jur_id', $ds->ds_jur_id)->where('wk_ta_id', $request->wk_ta_id)->count();
    //     if ($cek >= 1) {
    //         return redirect()->back()->with('error', 'Penilaian untuk Tahun Ajaran terpilih sudah ada.');
    //     }
    //     Waktu::create([
    //         'wk_ta_id' => $request->wk_ta_id,
    //         'wk_jur_id' => $ds->ds_jur_id,
    //         'wk_status' => 1,
    //         'wk_tgl_end' => $request->wk_tgl_end,
    //         'wk_jam_end' => $request->wk_jam_end,
    //     ]);
    //     return redirect()->back()->with('success', 'Waktu penilaian ditambahkan');
    // }

    public function update(Request $request)
    {
        $wk = Waktu::find($request->wk_id);

        $status = 0;
        if ($request->wk_tgl_end > date('Y-m-d')) {
            $status = 1;
        }

        if ($request->wk_tgl_end == date('Y-m-d') && $request->wk_jam_end > date('H:i')) {
            $status = 1;
        }

        $wk->wk_tgl_end = $request->wk_tgl_end;
        $wk->wk_jam_end = $request->wk_jam_end;
        $wk->wk_status = $status;
        $wk->save();

        return redirect()->back()->with('success', 'Perubahan tersimpan');
    }

    public function delete(Request $request)
    {
       Waktu::find($request->id)->delete();
       session()->flash('success', 'Jadwal berhasil dihapus');
       return response()->json([
            'status' => true,
            'msg' => 'Jadwal berhasil dihapus',
        ]);
    }
}
