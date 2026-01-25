<?php

namespace App\Http\Controllers;

use App\Models\SetNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetNilaiController extends Controller
{
    public function update(Request $request)
    {
        $jur = Auth::user()->ds_jur_id;
        SetNilai::where('sn_jur_id', $jur)->update(
            $request->only([
                'sn_hadir',
                'sn_tugas',
                'sn_kuis',
                'sn_mid',
                'sn_final',
                'sn_gd_a',
                'sn_gd_a_min',
                'sn_gd_b',
                'sn_gd_b_min',
                'sn_gd_c',
                'sn_gd_d',
                'sn_gd_e',
                'sn_gd_a_end',
                'sn_gd_a_min_end',
                'sn_gd_b_end',
                'sn_gd_b_min_end',
                'sn_gd_c_end',
                'sn_gd_d_end',
                'sn_gd_e_end',
            ])
        );
        return redirect()->back()->with('success', 'Pengaturan tersimpan.');
    }
}
