<?php

namespace App\Imports;

use App\Helpers\NilaiHelper;
use App\Models\Mahasiswa;
use App\Models\SetNilai;
use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TemPenilaianImport implements ToCollection, WithStartRow
{
    public $ta_id, $matkul_id;

    public function __construct($ta_id, $matkul_id)
    {
        $this->ta_id = $ta_id;
        $this->matkul_id = $matkul_id;
    }

    public function startRow(): int
    {
        return 3;
    }

    public function collection(Collection $rows)
    {
        $mhs1 = Mahasiswa::where('mhs_id', $rows[0][0])->first();
        $cekSet = SetNilai::where('sn_jur_id', $mhs1->mhs_jur_id)->first();
        if (!$cekSet) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Setting penilaian tidak ditemukan. Harap menghubungi Ketua Jurusan / Program Studi'
                );
        }

        $sukses = 0;
        foreach ($rows as $row) {
            try {
                NilaiHelper::updateOneRowKrs(
                    $row[3],
                    $row[4],
                    $row[5],
                    $row[6],
                    $row[7],
                    $row[0],
                    $this->ta_id,
                    $this->matkul_id,
                    $cekSet
                );
                $sukses++;
            } catch (\Throwable $th) {
            }
        }
        session()->put('sukses_import', $sukses);
    }
}
