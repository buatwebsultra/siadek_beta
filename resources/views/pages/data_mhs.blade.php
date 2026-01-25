@php
    $guard = Auth::getDefaultDriver();
    $action = route('student.data-diri.update');
    $actionFoto = route('student.data-diri.set-foto');
    $mn = '#mn4';
    if ($guard == 'admin') {
        $action = route('admin.mahasiswa.update');
        $actionFoto = route('admin.mahasiswa.set-foto');
        $mn = '#mn5';
    }

    if (@$isKaprodi) {
        $mn = '';
        $pageName = 'Detail Dosen/Pengajar';
        $action = route('admin.mahasiswa.update');
        $actionFoto = route('admin.mahasiswa.set-foto');
    }
@endphp
@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Detail Mahasiswa')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Detail Mahasiswa</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="#"> <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Mahasiswa</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Detail</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                @if ($guard == 'admin')
                    <div class="col-md-12 mb-3">
                        <a href="{{ route('admin.mahasiswa') }}" class="btn btn-sm btn-warning"> <i
                                class="icofont icofont-hand-drawn-left"></i> Kembali</a>
                    </div>
                @endif
                @if (@$isKaprodi)
                    <div class="col-md-12 mb-3">
                        <a href="{{ route('lead.mahasiswa') }}" class="btn btn-sm btn-warning"> <i
                                class="icofont icofont-hand-drawn-left"></i> Kembali</a>
                    </div>
                @endif

                @if ($mhs->mhs_kunci_data == 0 && $guard == 'student')
                    <div class="col-md-12">
                        <div class="alert alert-warning icons-alert">
                            <p><strong>Perhatian!</strong> <span>Isi data anda dengan baik dan benar lalu kunci : <button
                                        type="button" onclick="initKunci()"
                                        class="btn btn-sm btn-out btn-warning btn-square"><i
                                            class="icofont icofont-ui-lock"></i> Kunci</button></span></p>
                        </div>
                    </div>
                @endif

                <div class="col-sm-12">
                    <div class="card border-left-1">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs  tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#data1" role="tab"><i
                                                    class="icofont icofont-user-alt-5 text-primary"></i> Data Mahasiswa</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#alamat1" role="tab">
                                                Alamat</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#keluarga1" role="tab">
                                                Orang Tua</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabs card-block">
                                        <div class="tab-pane active" id="data1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="card user-card-full">
                                                        <div class="row m-l-0 m-r-0">
                                                            <div class="col-md-12 bg-c-lite-green user-profile">
                                                                <div class="card-block text-center text-white">
                                                                    <div class="m-b-25">
                                                                        <img src="{{ asset($mhs->mhs_foto) }}"
                                                                            class="" alt="Foto"
                                                                            style="width: 85%">
                                                                    </div>
                                                                    <h6 class="f-w-600">{{ $mhs->mhs_nama }}</h6>
                                                                    <p>NIM : {{ $mhs->mhs_nim }}</p>
                                                                    <p>
                                                                        <button type="button" onclick="initFoto()"
                                                                            class="btn btn-sm btn-mat btn-primary b-w-100">
                                                                            <i class="icofont icofont-ui-user"></i>
                                                                            Ganti Foto
                                                                        </button>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <form action="{{ $action }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="update_tipe" value="1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <label for="" class="col-md-3">Jurusan /
                                                                        Prodi</label>
                                                                    <select class="form-control form-control-sm col-md-9"
                                                                        name="mhs_jur_id" id="mhs_jur_id" readonly>
                                                                        <option value="{{ $mhs->jurusan->jur_id }}">🏦
                                                                            {{ $mhs->jurusan->jur_nama }}
                                                                            ({{ $mhs->jurusan->jur_jenjang }})</option>
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for=""
                                                                        class="col-md-3">Pembimbing Akademik (PA)</label>
                                                                    <select class="form-control form-control-sm col-md-9"
                                                                        name="mhs_dosen_id" id="mhs_dosen_id" readonly>
                                                                        <option value="{{ $mhs->pembimbing->ds_id }}">
                                                                            {{ $mhs->pembimbing->ds_nama }},
                                                                            {{ $mhs->pembimbing->ds_gelar }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Tahun
                                                                        Masuk</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_angkatan" id="mhs_angkatan"
                                                                        value="{{ $mhs->mhs_angkatan }}" readonly>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">NIM</label>
                                                                    <input type="text" onchange="clearWhiteSpace(this)"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_nim" id="mhs_nim"
                                                                        value="{{ $mhs->mhs_nim }}" readonly>
                                                                </div>

                                                                <div class="row form-group">
                                                                    <label for=""
                                                                        class="req col-md-3">Nama</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_nama" id="mhs_nama"
                                                                        value="{{ $mhs->mhs_nama }}" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Jenis
                                                                        Kelamin</label>
                                                                    <select class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_jk" id="mhs_jk" required>
                                                                        <option value="Laki-laki">Laki-laki</option>
                                                                        <option value="Perempuan">Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for=""
                                                                        class="req col-md-3">Agama</label>
                                                                    <select class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_agama" id="mhs_agama" required>
                                                                        <option value="">-- Pilih --</option>
                                                                        @foreach ($agama as $agm)
                                                                            <option value="{{ $agm->agm_nama }}">
                                                                                {{ $agm->agm_nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Tanggal
                                                                        Lahir</label>
                                                                    <input type="date"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_tgl_lahir" id="mhs_tgl_lahir"
                                                                        value="{{ $mhs->mhs_tgl_lahir }}" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Tempat
                                                                        Lahir</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_tmpt_lahir" id="mhs_tmpt_lahir"
                                                                        value="{{ $mhs->mhs_tmpt_lahir }}" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">No
                                                                        Telepon</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_tlp" id="mhs_tlp"
                                                                        value="{{ $mhs->mhs_tlp }}" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for=""
                                                                        class="req col-md-3">Email</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_email" id="mhs_email"
                                                                        value="{{ $mhs->mhs_email }}" required>
                                                                </div>

                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">
                                                                        Jalur Pendaftaran
                                                                    </label>
                                                                    <select class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_jalur_daftar" id="mhs_jalur_daftar"
                                                                        required>
                                                                        <option value="">-- Pilih --</option>
                                                                        @foreach ($jalurDaftar as $key1 => $val1)
                                                                            <option value="{{ $val1 }}">{{ $val1 }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">
                                                                        Jenis Pendaftaran
                                                                    </label>
                                                                    <select class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_jenis_daftar" id="mhs_jenis_daftar"
                                                                        required>
                                                                        <option value="">-- Pilih --</option>
                                                                        @foreach ($jenisDaftar as $key2 => $val2)
                                                                            <option value="{{ $val2 }}">{{ $val2 }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">
                                                                        Jenis Pembiayaan
                                                                    </label>
                                                                    <select class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_jenis_biaya" id="mhs_jenis_biaya"
                                                                        required>
                                                                        <option value="">-- Pilih --</option>
                                                                        @foreach ($jenisPembiayaan as $key3 => $val3)
                                                                            <option value="{{ $val3 }}">{{ $val3 }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">
                                                                        Tanggal Masuk Kuliah
                                                                    </label>
                                                                    <input type="date"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="mhs_tgl_masuk" id="mhs_tgl_masuk"
                                                                        value="{{ $mhs->mhs_tgl_masuk }}" required>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 text-right">
                                                                <hr>
                                                                <button type="submit"
                                                                    class="btn btn-out-dashed btn-success btn-square"> <i
                                                                        class="ti-save"></i> Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="alamat1" role="tabpanel">
                                            <form action="{{ $action }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="update_tipe" value="2">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row form-group">
                                                            <label for=""
                                                                class="col-md-3 req">Kewarganegaraan</label>
                                                            <select class="form-control form-control-sm col-md-9"
                                                                name="mhs_wn" id="mhs_wn" required>
                                                                <option value="Indonesia">Indonesia</option>
                                                                <option value="Asing">Asing</option>
                                                            </select>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3 req">NIK</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_nik" id="mhs_nik"
                                                                value="{{ $mhs->mhs_nik }}" required>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3 req">NISN</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_nisn" id="mhs_nisn"
                                                                value="{{ $mhs->mhs_nisn }}" required>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">NPWP</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_npwp" id="mhs_npwp"
                                                                value="{{ $mhs->mhs_npwp }}">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Alamat</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_alamat" id="mhs_alamat"
                                                                value="{{ $mhs->mhs_alamat }}">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Dusun</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_dusun" id="mhs_dusun"
                                                                value="{{ $mhs->mhs_dusun }}">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">RT</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_rt" id="mhs_rt"
                                                                value="{{ $mhs->mhs_rt }}">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">RW</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_rw" id="mhs_rw"
                                                                value="{{ $mhs->mhs_rw }}">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Kelurahan /
                                                                Desa</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_kelurahan" id="mhs_kelurahan"
                                                                value="{{ $mhs->mhs_kelurahan }}">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Kecamatan</label>
                                                            <div class="col-md-9" style="padding: 0 !important">
                                                                <table style="width: 100%">
                                                                    <tr>
                                                                        <td>
                                                                            <select class="form-control"
                                                                                name="mhs_kecamatan" id="mhs_kecamatan">
                                                                                <option value="{{ @$mhs->mhs_kecamatan }}"
                                                                                    selected="selected">
                                                                                    {{ @$mhs->kecamatan->kec_nama . ' - ' . @$mhs->kecamatan->kec_kabkota }}
                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Kode Pos</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="mhs_kode_pos" id="mhs_kode_pos"
                                                                value="{{ $mhs->mhs_kode_pos }}">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Penerima KPS</label>
                                                            <select class="form-control form-control-sm col-md-9"
                                                                name="mhs_kps" id="mhs_kps">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Ya">Ya</option>
                                                                <option value="Tidak">Tidak</option>
                                                            </select>
                                                        </div>

                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">No KPS</label>
                                                            <input type="text"
                                                                class="form-control form-control-sm col-md-9"
                                                                name="mhs_kps_no" id="mhs_kps_no"
                                                                value="{{ $mhs->mhs_kps_no }}" required>
                                                        </div>

                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Jenis Tinggal</label>
                                                            <select class="form-control form-control-sm col-md-9"
                                                                name="mhs_jenis_tinggal" id="mhs_jenis_tinggal">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Sendiri">Sendiri</option>
                                                                <option value="Bersama Orang Tua">Bersama Orang Tua
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Alat
                                                                Transportasi</label>
                                                            <select class="form-control form-control-sm col-md-9"
                                                                name="mhs_transportasi" id="mhs_transportasi">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="Tidak Ada">Tidak Ada</option>
                                                                <option value="Sepeda">Sepeda</option>
                                                                <option value="Sepeda Motor">Sepeda Motor</option>
                                                                <option value="Mobil">Mobil</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12 text-right">
                                                        <hr>
                                                        <button type="submit"
                                                            class="btn btn-out-dashed btn-success btn-square"> <i
                                                                class="ti-save"></i> Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="keluarga1" role="tabpanel">
                                            <form action="{{ $action }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="update_tipe" value="3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <h5>Ayah</h5>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">NIK</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="mhs_ayah_nik" id="mhs_ayah_nik"
                                                                    value="{{ $mhs->mhs_ayah_nik }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Nama</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="mhs_ayah_nama" id="mhs_ayah_nama"
                                                                    value="{{ $mhs->mhs_ayah_nama }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Tanggal Lahir</label>
                                                                <input type="date" class="form-control form-control-sm"
                                                                    name="mhs_ayah_tgl_lahir" id="mhs_ayah_tgl_lahir"
                                                                    value="{{ $mhs->mhs_ayah_tgl_lahir }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Pendidikan</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="mhs_ayah_pendidikan" id="mhs_ayah_pendidikan"
                                                                    value="{{ $mhs->mhs_ayah_pendidikan }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Pekerjaan</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="mhs_ayah_pekerjaan" id="mhs_ayah_pekerjaan"
                                                                    value="{{ $mhs->mhs_ayah_pekerjaan }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Penghasilan</label>
                                                                <input type="number" step="any"
                                                                    class="form-control form-control-sm"
                                                                    name="mhs_ayah_penghasilan" id="mhs_ayah_penghasilan"
                                                                    value="{{ $mhs->mhs_ayah_penghasilan }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <h5>Ibu</h5>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">NIK</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="mhs_ibu_nik" id="mhs_ibu_nik"
                                                                    value="{{ $mhs->mhs_ibu_nik }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Nama</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="mhs_ibu_nama" id="mhs_ibu_nama"
                                                                    value="{{ $mhs->mhs_ibu_nama }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Tanggal Lahir</label>
                                                                <input type="date" class="form-control form-control-sm"
                                                                    name="mhs_ibu_tgl_lahir" id="mhs_ibu_tgl_lahir"
                                                                    value="{{ $mhs->mhs_ibu_tgl_lahir }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Pendidikan</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="mhs_ibu_pendidikan" id="mhs_ibu_pendidikan"
                                                                    value="{{ $mhs->mhs_ibu_pendidikan }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Pekerjaan</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="mhs_ibu_pekerjaan" id="mhs_ibu_pekerjaan"
                                                                    value="{{ $mhs->mhs_ibu_pekerjaan }}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Penghasilan</label>
                                                                <input type="number" step="any"
                                                                    class="form-control form-control-sm"
                                                                    name="mhs_ibu_penghasilan" id="mhs_ibu_penghasilan"
                                                                    value="{{ $mhs->mhs_ibu_penghasilan }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-right">
                                                        <hr>
                                                        <button type="submit"
                                                            class="btn btn-out-dashed btn-success btn-square"> <i
                                                                class="ti-save"></i> Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_foto" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icofont icofont-ui-user"></i>
                        Ganti Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ $actionFoto }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12" style="overflow: auto">
                                <div class="form-group">
                                    <label for="">File Foto</label>
                                    <input type="file" class="form-control mb-2" name="foto" required>
                                    <span><code>Gunakan gambar dengan tipe .jpg atau .png</code></span>
                                    <br><span><code>Rekomendasi rasio 3 x 4; Max : 2 Mb</code></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect btn-round"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary waves-effect btn-round">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="form-kunci-data" method="POST" action="{{ route('student.kunci.data-diri') }}">
        @csrf
        <input type="hidden" name="mhs_id" value="{{ $mhs->mhs_id }}">
    </form>
@endsection
@include('_lib.select2')
@section('script')
    <script type="text/javascript">
        @if (@$isKaprodi)
            $('#mn7').addClass('active');
            $('#mn7').addClass('active pcoded-trigger');
            $('#mn72').addClass('active');
        @else
            $('{{ $mn }}').addClass('active');
        @endif

        let kunciData = {{ $mhs->mhs_kunci_data }};

        $(document).ready(function() {
            // $('.select2').select2();
            $('#mhs_jk').val("{{ $mhs->mhs_jk }}");
            $('#mhs_agama').val("{{ $mhs->mhs_agama }}");

            $('#mhs_wn').val("{{ $mhs->mhs_wn }}");
            $('#mhs_kps').val("{{ $mhs->mhs_kps }}");
            $('#mhs_jenis_tinggal').val("{{ $mhs->mhs_jenis_tinggal }}");
            $('#mhs_transportasi').val("{{ $mhs->mhs_transportasi }}");

            $('#mhs_kelurahan').val("{{ $mhs->mhs_kelurahan }}");
            $('#mhs_kelurahan').trigger('change');
            //NEW
            $('#mhs_jalur_daftar').val("{{ $mhs->mhs_jalur_daftar }}");
            $('#mhs_jenis_daftar').val("{{ $mhs->mhs_jenis_daftar }}");
            $('#mhs_jenis_biaya').val("{{ $mhs->mhs_jenis_biaya }}");
            initKecamatan();
        });

        function initKecamatan() {
            $('#mhs_kecamatan').select2({
                placeholder: 'Cari...',
                minimumInputLength: 3,
                ajax: {
                    url: "{{ route('data.kecamatan.cari') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kec_nama + ' - ' + item.kec_kabkota,
                                    id: item.kec_id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }

        function initFoto() {
            $('#modal_foto').modal('show');
        }

        function initKunci() {
            swal({
                    title: "Kunci Data ?",
                    text: "Setelah dikunci data anda tidak dapat diubah. Pastikan data anda sudah terisi dengan baik dan benar",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ya, Kunci",
                    cancelButtonText: "Batal"
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('#form-kunci-data').trigger('submit');
                    }
                });
        }

        $('form').on('submit', function(e) {
            if (kunciData == 1) {
                e.preventDefault();
                alertError("Data sudah dikunci. Perubahan gagal.");
            }
        });

        @if ($guard == 'admin' || @$isKaprodi)
            let input1 = '<input type="hidden" name="id_mhs" id="" value="{{ $mhs->mhs_id }}">';
            $('form').append(input1);
        @endif

        @if (@$isBiodata)
            let input2 = '<input type="hidden" name="isBiodata" id="" value="true">';
            $('form').append(input2);
        @endif

        @if ($mhs->mhs_kunci_data == 1)
            $('input').attr('readonly', 'readonly');
            $('select').attr('readonly', 'readonly');
            $('button[type="submit"]').hide();
        @endif
    </script>
@endsection
