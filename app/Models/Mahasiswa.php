<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_mahasiswa';
    protected $primaryKey = 'mhs_id';
    protected $guarded = [];
    protected $hidden = ['password'];

    public function krs()
    {
        return $this->hasMany(Krs::class, 'krs_mhs_id', 'mhs_id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'nilai_mhs_id', 'mhs_id');
    }

    public function ukt()
    {
        return $this->hasMany(Bayar::class, 'byr_mhs_id', 'mhs_id');
    }

    // Belongs

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'mhs_jur_id', 'jur_id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'mhs_fk_id', 'fk_id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'mhs_dosen_id', 'ds_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'mhs_kecamatan', 'kec_id');
    }

    public function keldes()
    {
        return $this->belongsTo(Keldes::class, 'mhs_kelurahan', 'kel_id');
    }

    public function _updateSemesterData()
    {
        // $mhs = self::find($this->mhs_id);
        $tas = TahunAjar::where('ta_kode', '>=', $this->mhs_angkatan.'0')->orderBy('ta_kode', 'ASC')->get();
        $mhs_semester_data = [];
        $index = 1;
        foreach ($tas as $ta) {
            $mhs_semester_data[$ta->ta_kode] = $index;
            $index++;
        }
        $this->mhs_semester_data = json_encode($mhs_semester_data);
        $this->mhs_semester = count($mhs_semester_data);
        $this->save();
    }

}
