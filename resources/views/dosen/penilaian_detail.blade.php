@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Detail Penilaian')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Detail Penilaian</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Penilaian</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Detail Penilaian</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-sm-4 mb-2">
                    <a href="{{ route('lecturer.penilaian') }}?kd={{ $ta->ta_id . '-' . $ta->ta_kode . '-' . $ta->ta_status }}"
                        class="btn btn-warning"> <i class="icofont icofont-hand-drawn-left"></i> Kembali</a>
                    |
                    <button type="button" onclick="initImport()" class="btn btn-out-dashed btn-success btn-square"><i
                            class="icofont icofont-file-excel"></i>
                        Import Nilai</button>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-primary">
                        Perhitungan Penilaian : <code>Kehadiran {{ $setNilai->sn_hadir }}%</code> <code>Tugas
                            {{ $setNilai->sn_tugas }}%</code> <code>Kuis
                            {{ $setNilai->sn_kuis }}%</code> <code>MID {{ $setNilai->sn_mid }}%</code> <code>Final
                            {{ $setNilai->sn_final }}%</code>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panels-wells">
                        <div class="panel panel-primary">
                            <div class="panel-heading bg-primary">
                                Mata Kuliah
                            </div>
                            <div class="panel-body" style="overflow: auto">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tahun Ajaran</th>
                                            <th>:</th>
                                            <th>{{ $ta->ta_kode }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="130">Mata Kuliah</td>
                                            <td width="10">:</td>
                                            <td id="show-matkul_nama">{{ $matkul->matkul_nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jurusan/Prodi</td>
                                            <td>:</td>
                                            <td id="show-jur_nama">({{ $matkul->jurusan->jur_jenjang }})
                                                {{ $matkul->jurusan->jur_nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Dosen</td>
                                            <td>:</td>
                                            <td id="show-matkul_nama">{{ $dosen->ds_nama }},
                                                {{ $dosen->ds_gelar }}</td>
                                        </tr>
                                        <tr>
                                            <td>Semester</td>
                                            <td>:</td>
                                            <td id="show-matkul_semester">{{ $matkul->matkul_semester }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ruangan</td>
                                            <td>:</td>
                                            <td id="show-ruang_nama">{{ $matkul->ruang->ruang_nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hari</td>
                                            <td>:</td>
                                            <td id="show-ruang_nama">{{ $matkul->matkul_hari }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jadwal</td>
                                            <td>:</td>
                                            <td id="show-matkul_jadwal">
                                                {{ $matkul->matkul_jadwal . ' s/d ' . $matkul->matkul_end }}</td>
                                        </tr>
                                        <tr>
                                            <td>SKS</td>
                                            <td>:</td>
                                            <td id="show-matkul_sks">{{ $matkul->matkul_sks }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Mahasiswa</td>
                                            <td>:</td>
                                            <td id="show-matkul_mhs">{{ @count($mahasiswa) }} Orang</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5><i class="icofont icofont icofont-star text-primary"></i> Nilai Mahasiswa</h5>
                            <hr>
                            <div class="card-header-right">
                                <a href="{{ route('lecturer.unduh.hasil-penilaian', $ta->ta_id . '-' . $matkul->matkul_id) }}"
                                    class="btn btn-grd-success btn-icon" style="margin-top: -10px; margin-right: 10px;">
                                    <i class="icofont icofont-download-alt text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-block">
                            <form id="form-nilai" action="{{ route('lecturer.penilaian.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="ta_id" value="{{ $ta->ta_id }}">
                                <input type="hidden" name="matkul_id" value="{{ $matkul->matkul_id }}">
                                <input type="hidden" name="dosen_id" value="{{ $dosen->ds_id }}">
                                <div class="row">
                                    <div class="col-md-12" style="overflow: auto">
                                        <table id="tbl1" class="table table-hover"
                                            style="font-size: 10pt; width: 100%">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="text-center" width="20" rowspan="2">#</th>
                                                    <th class="text-center" rowspan="2">Nama</th>
                                                    <th class="text-center" rowspan="2">NIM</th>
                                                    <th class="text-center" rowspan="2" width="65">Kehadiran <br> (0
                                                        - 100)</th>
                                                    <th class="text-center" colspan="5">Nilai (0 - 100)</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" width="60">Tugas</th>
                                                    <th class="text-center" width="60">Kuis</th>
                                                    <th class="text-center" width="60">MID</th>
                                                    <th class="text-center" width="60">Final</th>
                                                    <th class="text-center bg-light" width="50">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mahasiswa as $mhs)
                                                    <tr>
                                                        <td>
                                                            {{ $loop->iteration }}
                                                            <input type="hidden" name="mhs_id[]"
                                                                value="{{ $mhs->mhs_id }}">
                                                        </td>
                                                        <td>{{ $mhs->mhs_nama }}</td>
                                                        <td>{{ $mhs->mhs_nim }}</td>
                                                        <td>
                                                            <input type="number" step="any"
                                                                class="form-control form-control-sm"
                                                                name="krs_kehadiran[]"
                                                                value="{{ $mhs->krs[0]->krs_kehadiran }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" step="any"
                                                                class="form-control form-control-sm"
                                                                name="krs_nilai_tugas[]"
                                                                value="{{ $mhs->krs[0]->krs_nilai_tugas }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" step="any" min="0"
                                                                max="100" class="form-control form-control-sm"
                                                                name="krs_nilai_kuis[]"
                                                                value="{{ $mhs->krs[0]->krs_nilai_kuis }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" step="any" min="0"
                                                                max="100" class="form-control form-control-sm"
                                                                name="krs_nilai_mid[]"
                                                                value="{{ $mhs->krs[0]->krs_nilai_mid }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" step="any" min="0"
                                                                max="100" class="form-control form-control-sm"
                                                                name="krs_nilai_final[]"
                                                                value="{{ $mhs->krs[0]->krs_nilai_final }}">
                                                        </td>
                                                        <td class="text-center bg-light">
                                                            <strong>{{ $mhs->krs[0]->krs_nilai_avg }}
                                                                ({{ $mhs->krs[0]->krs_grade }})
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <hr>
                                        <button type="submit" class="btn btn-success"><i
                                                class="icofont icofont-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-import" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('lecturer.import.penilaian') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ta_id" id="" value="{{ $ta->ta_id }}">
                <input type="hidden" name="matkul_id" id="" value="{{ $matkul->matkul_id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="icofont icofont-file-excel text-success"></i>
                            Import Nilai Mahasiswa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('lecturer.unduh.template-penilaian', $ta->ta_id . '-' . $matkul->matkul_id) }}"
                                    class="btn btn-sm btn-block btn-success btn-outline-success"><i
                                        class="icofont icofont-download"></i>
                                    Unduh Template Penilaian (.xlsx)</a>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="" class="req">Pilih File</label>
                                    <input type="file" class="form-control" name="file_nilai" id="file_nilai"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light "><i
                                class="icofont icofont-upload-alt"></i> Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@include('_lib.datatable')
@section('script')
    <script type="text/javascript">
        $('#mn4').addClass('active');

        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            hideSidebar();
            $('#tbl1').DataTable();
        });

        function initImport() {
            $('#modal-import').modal('show');
        }
    </script>
@endsection
