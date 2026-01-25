<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Image;

class BayarController extends Controller
{
    public $arrayStatus = [
        '<label class="label label-lg label-warning"><i class="icofont icofont-ui-text-loading"></i> Diproses</label>',
        '<label class="label label-lg label-success"><i class="icofont icofont-checked"></i> Diverifikasi</label>',
        '<label class="label label-lg label-danger"><i class="icofont icofont-warning-alt"></i> Pembayaran tidak vallid</label>',
    ];

    public function get($id = null)
    {
        $data = Bayar::with('mahasiswa')->find($id);
        $data->upload_at = $data->created_at->format('Y-M-d H:i:s');
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function data($id = 'all')
    {
        $guard = Auth::getDefaultDriver();
        $user = Auth::user();
        $level = 0;

        if ($guard == 'admin') {
            if ($id == 'all') {
                $data = Bayar::where('byr_type', 'ukt')
                    ->orderBy('byr_id', 'DESC')
                    ->with(['mahasiswa', 'mahasiswa.jurusan'])
                    ->get();
            } else {
                $data = Bayar::where('byr_type', 'ukt')
                    ->whereHas('mahasiswa', function ($query) use ($id) {
                        $query->where('mhs_jur_id', $id);
                    })
                    ->orderBy('byr_id', 'DESC')
                    ->with(['mahasiswa', 'mahasiswa.jurusan'])
                    ->get();
            }
        } elseif ($guard == 'lecturer') {
            $level = $user->ds_level;
            $data = Bayar::where('byr_type', 'ukt')
                ->whereHas('mahasiswa', function ($query) use ($user) {
                    $query->where('mhs_jur_id', $user->ds_jur_id);
                })
                ->orderBy('byr_id', 'DESC')
                ->with(['mahasiswa', 'mahasiswa.jurusan'])
                ->get();
        } else {
            $data = Bayar::where('byr_type', 'ukt')
                ->where('byr_mhs_id', $user->mhs_id)
                ->orderBy('byr_id', 'DESC')
                ->with(['mahasiswa', 'mahasiswa.jurusan'])
                ->get();
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('mhs', function ($row) {
                if (!$row->mahasiswa) {
                    return '<span class="text-danger">ID: ' . $row->byr_mhs_id . ' (Data Tidak Ditemukan)</span>';
                }
                return $row->mahasiswa->mhs_nim .
                    '<br>' .
                    $row->mahasiswa->mhs_nama;
            })
            ->addColumn('status', function ($row) {
                return $row->getStatusHtml();
            })
            ->addColumn('upload_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('menu', function ($row) use ($guard, $level) {
                $raw = '';
                if ($guard == 'admin' || $level == 1) {
                    $raw =
                        '<button type="button" onclick="initValidasi(`' .
                        $row->byr_bukti .
                        '`, ' .
                        $row->byr_id .
                        ')" class="btn btn-sm btn-success btn-outline-success"><i class="icofont icofont-check-circled"></i>Validasi</button>';
                } else {
                    $hps =
                        '<a class="dropdown-item pointer" onclick="initDelete(`deleteUkt`, ' .
                        $row->byr_id .
                        ')"><i class="icofont icofont-trash text-danger"></i>Hapus</a>';

                    if ($row->byr_status == 1) {
                        $hps = '';
                    }
                    $raw =
                        '<a class="dropdown-toggle addon-btn" data-toggle="dropdown" aria-expanded="true">
                                <i class="icofont icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item pointer" onclick="initBukti(`' .
                        $row->byr_id .
                        '`)"><i class="icofont icofont-info-circle"></i>Lihat Bukti</a>
                                <div role="separator" class="dropdown-divider"></div>' .
                        $hps .
                        '</div>';
                }
                return $raw;
            })
            ->rawColumns(['mhs', 'status', 'menu'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'file_ukt' => 'mimes:jpeg,jpg,png,pdf|max:2000', // max 10000kb
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'File tidak valid');
        } else {
            $mhs = Auth::user();
            $TASMT = explode('-', $request->byr_ta);
            $cek = Bayar::where('byr_mhs_id', $mhs->mhs_id)
                ->where('byr_semester', $TASMT[1])
                ->count();

            if ($cek > 0) {
                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Bukti pembayaran semester ' . $TASMT[1] . ' sudah ada'
                    );
            }

            $file = $request->file('file_ukt');
            $ext = $file->getClientOriginalExtension();
            $lokasi = 'komponen/assets/images/ukt/';
            $newName =
                'ukt_' . $mhs->mhs_nim . '_' . $request->byr_ta . '_' . time();

            if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
                $newName = $newName . '.jpg';
                Image::make($file)
                    ->encode('jpg', 100)
                    ->orientate()
                    ->resize(1300, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($lokasi . $newName);
            } else {
                $newName = $newName . $ext;
                $file->move($lokasi, $newName);
            }

            $mhs = Auth::user();

            $angka = preg_replace("/[^0-9,]/", "", $request->byr_jml_bayar);
            $angka = str_replace(",", ".", $angka);
            Bayar::create([
                'byr_mhs_id' => $mhs->mhs_id,
                'byr_type' => 'ukt',
                'byr_semester' => $TASMT[1],
                'byr_ta' => $TASMT[0],
                'byr_nama' => $request->byr_nama,
                'byr_bank' => $request->byr_bank,
                'byr_rek_tuj' => $request->byr_rek_tuj,
                'byr_tgl_bayar' => $request->byr_tgl_bayar,
                'byr_jml_bayar' => $angka,
                'byr_status' => 0,
                'byr_bukti' => $lokasi . $newName,
            ]);
            //UPDATE STATUS MAHASISWA (Aktif)
            Mahasiswa::where('mhs_id', $mhs->mhs_id)->update(['mhs_status' => 1]);

            return redirect()
                ->back()
                ->with('success', 'Bukti pembayaran berhasil ditambahkan');
        }
    }

    public function delete(Request $request)
    {
        $bayar = Bayar::find($request->byr_id);
        if (file_exists($bayar->byr_bukti)) {
            @unlink($bayar->byr_bukti);
        }
        $bayar->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Bukti pembayaran berhasil dihapus',
        ]);
    }

    public function validasi(Request $request)
    {
        try {
            Bayar::where('byr_id', $request->byr_id)->update([
                'byr_status' => $request->byr_status,
                'byr_ket' => @$request->byr_ket ?? '-',
            ]);
            return response()->json([
                'status' => true,
                'msg' => 'Tindakan berhasil disimpan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Terjadi kesalahan. Mohon periksa data anda',
                'error' => $th,
            ]);
        }
    }
}
