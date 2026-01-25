<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdrProController extends Controller
{
    public function syncStatusMhs(Request $request)
    {
        try {
            $ta = $request->sync_ta;

            // Ambil ID mahasiswa yang memiliki pembayaran di tahun akademik tertentu
            $mhsWithPayment = Bayar::where('byr_ta', $ta)
                ->pluck('byr_mhs_id')
                ->toArray();

            // Update mahasiswa yang tidak ada di daftar pembayaran dan masih aktif
            Mahasiswa::whereNotIn('mhs_id', $mhsWithPayment)
                ->where('mhs_status', 1)
                ->update(['mhs_status' => 2]);

            return redirect()->back()->with('success', 'Update status mahasiswa berhasil');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan mohon perhatikan data anda');
        }
    }
}
