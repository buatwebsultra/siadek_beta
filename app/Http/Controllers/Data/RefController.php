<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\{Kecamatan};
use Illuminate\Http\Request;

class RefController extends Controller
{
    public function cariKec(Request $request)
    {
        if ($request->has('q')) {
    		$cari = $request->q;
            $data = Kecamatan::where('kec_nama', 'LIKE', "%$cari%")->orderBy('kec_nama', 'ASC')->get();
    		return response()->json($data);
        }
        else {
            return response()->json(['pesan' => 'Input Kosong']);
        }
    }
}
