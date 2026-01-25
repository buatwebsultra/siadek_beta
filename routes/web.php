<?php

use App\Http\Controllers\AdrProController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\ConfAppController;
use App\Http\Controllers\Data\RefController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\Pages\{AdminPageController, DosenPageController, MahasiswaPageController};
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SetNilaiController;
use App\Http\Controllers\TaController;
use App\Http\Controllers\Tools\ExcelController;
use App\Http\Controllers\Tools\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaktuController;
use Illuminate\Support\Facades\Route;

Route::get('/',  function(){
    return redirect('login');
});

Route::get('/tess',  [AdminPageController::class, 'tess'])->name('tess');

Route::get('/login',  [AuthController::class, 'viewLogin'])->name('login');

Route::post('/login',  [AuthController::class, 'postLogin'])->name('login.gas');
Route::post('/logout',  [AuthController::class, 'postLogout'])->name('logout.gas');

// Route::get('/tes',  [MahasiswaPageController::class, 'index']);
Route::middleware('auth:admin,lecturer,student')->group(function () {
    Route::prefix('/data')->group(function () {
        Route::get('/matkul/{semester?}/{jurusan?}',  [MatkulController::class, 'data'])->name('data.matkul');
        Route::get('/tahun-ajaran',  [TaController::class, 'data'])->name('data.ta');
        Route::get('/fakultas',  [FakultasController::class, 'data'])->name('data.fakultas');
        Route::get('/jurusan',  [JurusanController::class, 'data'])->name('data.jurusan');
        Route::get('/dosen/{jur_id?}',  [DosenController::class, 'data'])->name('data.dosen');
        Route::get('/mahasiswa/{jur_id?}',  [MahasiswaController::class, 'data'])->name('data.mahasiswa');
        Route::get('/mata-kuliah/{kode?}',  [MatkulController::class, 'data'])->name('data.matkul_detail');
        Route::get('/ruangan',  [RuangController::class, 'data'])->name('data.ruangan');
        Route::get('/ruangan/{id?}',  [RuangController::class, 'get'])->name('data.ruangan.get');
        Route::get('/krs/{kode?}',  [KrsController::class, 'data'])->name('data.krs');
        Route::get('/get/mahasiswa/krs-detail',  [KrsController::class, 'getMahasiswaDetail'])->name('data.get.mahasiswa.krs-detail');
        Route::get('/get/mahasiswa/khs-detail',  [NilaiController::class, 'getNilaiMahasiswa'])->name('data.get.mahasiswa.khs-detail');
        Route::get('/kecamatan/cari',  [RefController::class, 'cariKec'])->name('data.kecamatan.cari');

        Route::get('/pembayaran-ukt/{id?}',  [BayarController::class, 'data'])->name('data.pembayaran-ukt');
        Route::get('/pembayaran/detail/{id?}',  [BayarController::class, 'get'])->name('data.pembayaran.detail');
    });

    Route::prefix('/print')->group(function () {
        Route::get('/krs/{kode?}',  [KrsController::class, 'print'])->name('print.krs');
        Route::get('/khs/{kode?}',  [NilaiController::class, 'print'])->name('print.khs');
        Route::get('/transkrip/{kode?}',  [NilaiController::class, 'transkrip'])->name('print.transkrip');
    });
});


Route::middleware('auth:lecturer')->group(function () {
    Route::prefix('/lecturer')->group(function () {
        Route::get('/',  [DosenPageController::class, 'index'])->name('lecturer');
        Route::get('/jadwal',  [DosenPageController::class, 'jadwal'])->name('lecturer.jadwal');
        Route::get('/mahasiswa/{angkatan?}',  [DosenPageController::class, 'mahasiswa'])->name('lecturer.mahasiswa');
        Route::get('/penilaian',  [DosenPageController::class, 'penilaian'])->name('lecturer.penilaian');
        Route::get('/data-diri',  [DosenPageController::class, 'dataDiri'])->name('lecturer.dataDiri');
        Route::get('/akun',  [DosenPageController::class, 'akun'])->name('lecturer.akun');
        Route::get('/pengaturan',  [DosenPageController::class, 'pengaturan'])->name('lecturer.pengaturan');
        Route::get('/penilaian/detail/{kode}',  [DosenPageController::class, 'penilaianDetail'])->name('lecturer.penilaian.detail');

        Route::get('/data/jadwal/{kode?}',  [DosenController::class, 'getJadwal'])->name('lecturer.data.jadwal');
        Route::post('/data/detail/jadwal/{kode?}',  [MatkulController::class, 'getDetailJadwal'])->name('lecturer.data.detail.jadwal');
        Route::get('/data/penilaian/matkul/{kode?}',  [MatkulController::class, 'getMatkulPenilaian'])->name('lecturer.data.penilaian.matkul');
        Route::get('/data/mahasiswa/get/{id?}',  [MahasiswaController::class, 'get'])->name('lecturer.mahasiswa.get');

        Route::post('/penilaian/update',  [NilaiController::class, 'updateNilaiKrs'])->name('lecturer.penilaian.update');
        Route::post('/akun/updatePass',  [DosenController::class, 'updatePass'])->name('lecturer.akun.updatePass');
        Route::post('/data-diri/update',  [DosenController::class, 'update'])->name('lecturer.data-diri.update');
        Route::post('/data-diri/set-foto',  [DosenController::class, 'setFoto'])->name('lecturer.data-diri.set-foto');

        Route::get('/unduh/template-penilaian/{param}',  [ExcelController::class, 'unduhTemPenilaian'])->name('lecturer.unduh.template-penilaian');
        Route::post('/import/penilaian',  [ExcelController::class, 'importPenilaian'])->name('lecturer.import.penilaian');
        Route::get('/unduh/hasil-penilaian/{param}',  [ExcelController::class, 'unduhHasilPenilaian'])->name('lecturer.unduh.hasil-penilaian');

        Route::middleware('CheckLevel:1')->group(function () {
            Route::prefix('/lead')->group(function () {
                Route::get('/dosen',  [DosenPageController::class, 'dosen'])->name('lead.dosen');
                Route::get('/dosen/detail/{id?}',  [DosenPageController::class, 'detailPengajar'])->name('lead.dosen.detail');
                Route::get('/mahasiswa',  [DosenPageController::class, 'leadMahasiswa'])->name('lead.mahasiswa');
                Route::get('/mahasiswa/detail/{id?}',  [DosenPageController::class, 'detailMahasiswa'])->name('lead.mahasiswa.detail');
                Route::get('/mata-kuliah',  [DosenPageController::class, 'matkul'])->name('lead.matkul');
                Route::get('/kemahasiswaan',  [DosenPageController::class, 'kemahasiswaan'])->name('lead.kemahasiswaan');
                Route::get('/set-penilaian',  [DosenPageController::class, 'setPenilaian'])->name('lead.set-penilaian');

                Route::get('/statistik-mahasiswa',  [DosenPageController::class, 'stsMhs'])->name('lead.sts-mhs');
                // Route::get('/jadwal-penilaian',  [DosenPageController::class, 'jadwalPen'])->name('lead.jadwal-pen');
                Route::get('/laporan',  [DosenPageController::class, 'laporan'])->name('lead.laporan');
            });
        });
    });

});

Route::middleware('auth:student')->group(function () {
    Route::prefix('/student')->group(function () {
        Route::get('/',  [MahasiswaPageController::class, 'index'])->name('student');
        Route::get('/krs',  [MahasiswaPageController::class, 'indexKrs'])->name('student.krs');
        // Route::get('/krs/view',  [MahasiswaPageController::class, 'viewKrs'])->name('student.krs.view');
        Route::get('/khs',  [MahasiswaPageController::class, 'indexKhs'])->name('student.khs');
        Route::get('/akun',  [MahasiswaPageController::class, 'akun'])->name('student.akun');
        Route::get('/data-diri',  [MahasiswaPageController::class, 'dataDiri'])->name('student.data-diri');
        Route::get('/pengaturan',  [MahasiswaPageController::class, 'pengaturan'])->name('student.pengaturan');
        Route::get('/ukt',  [MahasiswaPageController::class, 'ukt'])->name('student.ukt');
        Route::post('/krs/create',  [KrsController::class, 'create'])->name('student.krs.create');
        Route::post('/krs/delete',  [KrsController::class, 'delete'])->name('student.krs.delete');
        Route::post('/data-diri/update',  [MahasiswaController::class, 'update'])->name('student.data-diri.update');
        Route::post('/data-diri/set-foto',  [MahasiswaController::class, 'setFoto'])->name('student.data-diri.set-foto');
        Route::post('/akun/updatePass',  [MahasiswaController::class, 'updatePass'])->name('student.akun.updatePass');
        Route::post('/ukt/store',  [BayarController::class, 'store'])->name('student.ukt.store');
        Route::post('/ukt/delete',  [BayarController::class, 'delete'])->name('student.ukt.delete');

        Route::post('/kunci/data-diri',  [MahasiswaController::class, 'KunciBiodata'])->name('student.kunci.data-diri');
    });

});

Route::middleware(['auth:admin,lecturer', 'CheckLevel:1'])->group(function () {
    Route::prefix('/pro')->group(function () {
        Route::get('/dosen/get/{id?}',  [DosenController::class, 'get'])->name('admin.dosen.get');
        Route::post('/dosen/create',  [DosenController::class, 'create'])->name('admin.dosen.create');
        Route::post('/dosen/update',  [DosenController::class, 'update'])->name('admin.dosen.update');
        Route::post('/dosen/delete',  [DosenController::class, 'delete'])->name('admin.dosen.delete');
        Route::post('/dosen/reset',  [DosenController::class, 'reset'])->name('admin.dosen.reset');
        Route::post('/dosen/set-foto',  [DosenController::class, 'setFoto'])->name('admin.dosen.set-foto');
        Route::get('/mahasiswa/get/{id?}',  [MahasiswaController::class, 'get'])->name('admin.mahasiswa.get');
        Route::post('/mahasiswa/create',  [MahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
        Route::post('/mahasiswa/update',  [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
        Route::post('/mahasiswa/delete',  [MahasiswaController::class, 'delete'])->name('admin.mahasiswa.delete');
        Route::post('/mahasiswa/reset',  [MahasiswaController::class, 'reset'])->name('admin.mahasiswa.reset');
        Route::post('/mahasiswa/set-foto',  [MahasiswaController::class, 'setFoto'])->name('admin.mahasiswa.set-foto');
        Route::get('/mata-kuliah/get/{id?}',  [MatkulController::class, 'get'])->name('admin.matkul.get');
        Route::post('/mata-kuliah/create',  [MatkulController::class, 'create'])->name('admin.matkul.create');
        Route::post('/mata-kuliah/update',  [MatkulController::class, 'update'])->name('admin.matkul.update');
        Route::post('/mata-kuliah/delete',  [MatkulController::class, 'delete'])->name('admin.matkul.delete');
        Route::get('/mahasiswa/cari/{jur_id?}',  [MahasiswaController::class, 'cariMhs'])->name('pro.mahasiswa.cari');
        Route::post('/kemahasiswaan/cek-menu',  [MahasiswaController::class, 'cekMenu'])->name('pro.mahasiswa.cek-menu');
        Route::get('/dosen/cari/{jur_id?}',  [DosenController::class, 'cariDosen'])->name('pro.dosen.cari');

        Route::post('/set-penilaian/update',  [SetNilaiController::class, 'update'])->name('pro.set-penilaian.update');
        Route::post('/penilaian/reset',  [NilaiController::class, 'reset'])->name('pro.penilaian.reset');

        Route::get('/jadwal-pen/get/{id?}',  [WaktuController::class, 'get'])->name('pro.jadwal-pen.get');
        Route::post('/jadwal-pen/insert',  [WaktuController::class, 'insert'])->name('pro.jadwal-pen.insert');
        Route::post('/jadwal-pen/update',  [WaktuController::class, 'update'])->name('pro.jadwal-pen.update');
        Route::post('/jadwal-pen/delete',  [WaktuController::class, 'delete'])->name('pro.jadwal-pen.delete');

        Route::post('/laporan/pengajar',  [LaporanController::class, 'pengajar'])->name('pro.laporan.pengajar');
        Route::post('/laporan/mahasiswa',  [LaporanController::class, 'mahasiswa'])->name('pro.laporan.mahasiswa');

        Route::post('/mahasiswa/export-data',  [ExcelController::class, 'dataMahasiswa'])->name('pro.mahasiswa.export-data');

    });
});

Route::middleware('auth:admin')->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/',  [AdminPageController::class, 'index'])->name('admin');
        Route::get('/tahun-ajaran',  [AdminPageController::class, 'tahunAjar'])->name('admin.tahun-ajaran');
        // Route::get('/fakultas',  [AdminPageController::class, 'fakultas'])->name('admin.fakultas');
        Route::get('/jurusan',  [AdminPageController::class, 'jurusan'])->name('admin.jurusan');
        Route::get('/ruangan',  [AdminPageController::class, 'ruangan'])->name('admin.ruangan');
        Route::get('/pengajar',  [AdminPageController::class, 'pengajar'])->name('admin.pengajar');
        Route::get('/pengajar/detail/{id?}',  [AdminPageController::class, 'detailPengajar'])->name('admin.pengajar.detail');
        Route::get('/mahasiswa',  [AdminPageController::class, 'mahasiswa'])->name('admin.mahasiswa');
        Route::get('/mahasiswa/detail/{id?}',  [AdminPageController::class, 'detailMahasiswa'])->name('admin.mahasiswa.detail');
        Route::get('/matakuliah',  [AdminPageController::class, 'mataKuliah'])->name('admin.matakuliah');
        Route::get('/pengaturan',  [AdminPageController::class, 'pengaturan'])->name('admin.pengaturan');
        Route::get('/akun',  [AdminPageController::class, 'akun'])->name('admin.akun');
        Route::get('/ukt',  [AdminPageController::class, 'ukt'])->name('admin.ukt');
        Route::post('/tahun-ajaran/create',  [TaController::class, 'create'])->name('admin.tahun-ajaran.create');
        Route::post('/tahun-ajaran/delete',  [TaController::class, 'delete'])->name('admin.tahun-ajaran.delete');
        Route::post('/tahun-ajaran/kunci',  [TaController::class, 'kunci'])->name('admin.tahun-ajaran.kunci');
        // Route::get('/fakultas/get/{id?}',  [FakultasController::class, 'get'])->name('admin.fakultas.get');
        // Route::post('/fakultas/create',  [FakultasController::class, 'create'])->name('admin.fakultas.create');
        // Route::post('/fakultas/update',  [FakultasController::class, 'update'])->name('admin.fakultas.update');
        // Route::post('/fakultas/delete',  [FakultasController::class, 'delete'])->name('admin.fakultas.delete');
        Route::get('/jurusan/get/{id?}',  [JurusanController::class, 'get'])->name('admin.jurusan.get');
        Route::post('/jurusan/create',  [JurusanController::class, 'create'])->name('admin.jurusan.create');
        Route::post('/jurusan/update',  [JurusanController::class, 'update'])->name('admin.jurusan.update');
        Route::post('/jurusan/delete',  [JurusanController::class, 'delete'])->name('admin.jurusan.delete');
        Route::post('/ruangan/create',  [RuangController::class, 'create'])->name('admin.ruangan.create');
        Route::post('/ruangan/update',  [RuangController::class, 'update'])->name('admin.ruangan.update');
        Route::post('/ruangan/delete',  [RuangController::class, 'delete'])->name('admin.ruangan.delete');
        Route::post('/app-config/update',  [ConfAppController::class, 'update'])->name('admin.app.update');
        Route::post('/app-config/updateLogo',  [ConfAppController::class, 'updateLogoIcon'])->name('admin.app.updateLogo');
        Route::post('/akun/update',  [UserController::class, 'update'])->name('admin.akun.update');
        Route::post('/akun/updatePass',  [UserController::class, 'updatePass'])->name('admin.akun.updatePass');
        Route::post('/ukt/validasi',  [BayarController::class, 'validasi'])->name('admin.ukt.validasi');

        Route::post('/mahasiswa/buka/data-diri',  [MahasiswaController::class, 'bukaBiodata'])->name('admin.mahasiswa.buka.data-diri');

        Route::get('/statistik-mahasiswa',  [AdminPageController::class, 'stsMhs'])->name('admin.sts-mhs');
        Route::get('/laporan',  [AdminPageController::class, 'laporan'])->name('admin.laporan');

        Route::get('/jadwal-penilaian',  [AdminPageController::class, 'jadwalPen'])->name('admin.jadwal-pen');

        Route::get('/dosen/unduh/mhs-akademik',  [ExcelController::class, 'mhsAkademik'])->name('admin.dosen.unduh.mhs-akademik');

        Route::post('/mhs-status/sync',  [AdrProController::class, 'syncStatusMhs'])->name('admin.mhs-status.sync');

        Route::post('/laporan/ukt',  [LaporanController::class, 'laporanUkt'])->name('admin.laporan.ukt');
    });
});
