@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Dashboard')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Dashboard</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ asset($appData->app_logo) }}" alt="" style="width: 230px">
                </div>
                <div class="col-md-12 text-center mb-5 mt-3">
                    <h5 class="cfont1">{{ $appData->app_author }}</h5>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <a onclick="initMhs()" style="cursor: pointer;">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-users bg-c-yellow card1-icon"></i>
                                <span class="text-c-yellow f-w-600">Mahasiswa</span>
                                <h4>{{ $mhs }}</h4>
                                <div>
                                    <span class="f-left m-t-10 text-muted">
                                        <i class="text-c-yellow f-16 icofont icofont-login m-r-10"></i>...
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a onclick="initDosen()" style="cursor: pointer;">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-user bg-c-blue card1-icon"></i>
                                <span class="text-c-blue f-w-600">Dosen/Pengajar</span>
                                <h4>{{ $dosen }}</h4>
                                <div>
                                    <span class="f-left m-t-10 text-muted">
                                        <i class="text-c-blue f-16 icofont icofont-login m-r-10"></i>...
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="icofont icofont-briefcase-alt-1 bg-c-pink card1-icon"></i>
                            <span class="text-c-pink f-w-600">Jurusan</span>
                            <h4>{{ $jurusan }}</h4>
                            <div>
                                <span class="f-left m-t-10 text-muted">
                                    <i class="text-c-pink f-16 icofont icofont-login m-r-10"></i>...
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3" style="margin-top: 20px">
                    <div class="card bg-c-blue text-white widget-visitor-card">
                        <div class="card-block-small text-center">
                            <h2>{{ $newTa }}</h2>
                            <h6>Tahun Ajaran</h6>
                            <i class="feather icon-file-text"></i>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="3"><strong>Rekapitulasi Mahasiswa</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mhs_by_sts as $data5)
                                            <tr>
                                                <td># {{ $data5['status'] }}</td>
                                                <td>{{ $data5['jml'] }}</td>
                                                <td>Mahasiswa</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content border-top-2">
                <div class="modal-header">
                    <h5 class="modal-title">Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="">
                    <div class="row">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center">Angkatan</th>
                                    <th class="text-center">Jumlah Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countMhs as $cmhs)
                                    <tr>
                                        <td class="text-center">{{ $cmhs['mhs_angg'] }}</td>
                                        <td class="text-center">{{ $cmhs['mhs_jml'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect btn-round"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content border-top-1">
                <div class="modal-header">
                    <h5 class="modal-title">Data Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="">
                    <div class="row">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center">Prodi</th>
                                    <th class="text-center">Jumlah Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countDosen as $cdosen)
                                    <tr>
                                        <td class="">{{ $cdosen['jur_nama'] }}</td>
                                        <td class="text-center">{{ $cdosen['jur_dosen'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect btn-round"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $('#mn1').addClass('active');
        //   $('#mn2').addClass('active pcoded-trigger');
        //   $('#mn2-1').addClass('active');

        function initMhs() {
            $('#modal1').modal('show');
        }

        function initDosen() {
            $('#modal2').modal('show');
        }
    </script>
@endsection
