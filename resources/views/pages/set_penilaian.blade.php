@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Pengaturan Penilaian')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Pengaturan Penilaian</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Program Studi</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Pengaturan Penilaian</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-left-2">
                        <div class="card-header">
                            <h5><i class="icofont icofont-settings text-warning"></i> Penilaian
                                ({{ $jurusan->jur_nama . ' - ' . $jurusan->jur_jenjang }})</h5>
                            <hr>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="feather icon-maximize full-card"></i>
                                    </li>
                                    <li><i class="feather icon-minus minimize-card"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <form id="form-nilai" action="{{ route('pro.set-penilaian.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>IP Kumulatif</h4>
                                        <table class="table table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th colspan="2">Parameter</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="15%">Kehadiran (%)</td>
                                                    <td width="2%">:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_hadir" id="sn_hadir" value="{{ $setNilai->sn_hadir }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tugas (%)</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_tugas" id="sn_tugas" value="{{ $setNilai->sn_tugas }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kuis (%)</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_kuis" id="sn_kuis" value="{{ $setNilai->sn_kuis }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>MID (%)</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_mid" id="sn_mid" value="{{ $setNilai->sn_mid }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Final (%)</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_final" id="sn_final" value="{{ $setNilai->sn_final }}"
                                                            required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Penentuan Grade</h4>
                                        <table class="table table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th colspan="2">Grade</th>
                                                    <th colspan="3">Range Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" width="15%">A</td>
                                                    <td width="2%">:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_a" value="{{ $setNilai->sn_gd_a }}" required>
                                                    </td>
                                                    <td>s/d</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_a_end" value="{{ $setNilai->sn_gd_a_end }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">A -</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_a_min" value="{{ $setNilai->sn_gd_a_min }}"
                                                            required>
                                                    </td>
                                                    <td>s/d</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_a_min_end" value="{{ $setNilai->sn_gd_a_min_end }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">B</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_b" value="{{ $setNilai->sn_gd_b }}" required>
                                                    </td>
                                                    <td>s/d</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_b_end" value="{{ $setNilai->sn_gd_b_end }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">B -</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_b_min" value="{{ $setNilai->sn_gd_b_min }}"
                                                            required>
                                                    </td>
                                                    <td>s/d</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_b_min_end"
                                                            value="{{ $setNilai->sn_gd_b_min_end }}" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">C</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_c" value="{{ $setNilai->sn_gd_c }}" required>
                                                    </td>
                                                    <td>s/d</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_c_end" value="{{ $setNilai->sn_gd_c_end }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">D</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_d" value="{{ $setNilai->sn_gd_d }}" required>
                                                    </td>
                                                    <td>s/d</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_d_end" value="{{ $setNilai->sn_gd_d_end }}"
                                                            required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">E</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_e" value="{{ $setNilai->sn_gd_e }}" required>
                                                    </td>
                                                    <td>s/d</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="sn_gd_e_end" value="{{ $setNilai->sn_gd_e_end }}"
                                                            required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-outline-primary"><i
                                                class="icofont icofont-save"></i>
                                            Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $('#mn7').addClass('active');
        $('#mn7').addClass('active pcoded-trigger');
        $('#mn74').addClass('active');

        $('#form-nilai').on('submit', function(e) {
            let sn_hadir = $('#sn_hadir').val();
            let sn_tugas = $('#sn_tugas').val();
            let sn_kuis = $('#sn_kuis').val();
            let sn_mid = $('#sn_mid').val();
            let sn_final = $('#sn_final').val();
            let total = parseInt(sn_hadir) + parseInt(sn_tugas) + parseInt(sn_kuis) + parseInt(sn_mid) + parseInt(
                sn_final);

            if (total < 100) {
                e.preventDefault();
                alertError(`Nilai total Parameter IP Kumulatif (${total}) tidak mencapai 100`)
            }
            if (total > 100) {
                e.preventDefault();
                alertError(`Nilai total Parameter IP Kumulatif (${total}) melebihi 100`)
            }
        });
    </script>
@endsection
