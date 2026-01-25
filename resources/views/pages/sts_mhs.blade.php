@php
    $guard = Auth::getDefaultDriver();
@endphp
@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Statistik Mahasiswa')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Statistik Mahasiswa</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Statistik Mahasiswa</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6>Total Mahasiswa</h6>
                            <h2 id="show-tot-mhs">{{ $tot_mhs }}</h2>
                            <i class="card-icon icofont icofont-people"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6>Mahasiswa Pria</h6>
                            <h2 id="show-tot-mhs">{{ $tot_pria }}</h2>
                            <i class="card-icon icofont icofont-businessman"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6>Mahasiswa Wanita</h6>
                            <h2 id="show-tot-mhs">{{ $tot_wanita }}</h2>
                            <i class="card-icon icofont icofont-businesswoman"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5>Total Mahasiswa / Prodi</h5>
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
                        <div class="card-block" style="overflow: auto;">
                            <canvas id="barChart" style="height: 500px !important; width: 100%"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5>Mahasiswa / Angkatan</h5>
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
                        <div class="card-block" style="overflow: auto;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Angkatan</th>
                                        <th class="text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mhs_by_year as $datay)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $datay['tahun'] }}</td>
                                            <td class="text-center">{{ $datay['tot_mhs'] }}</td>
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

@endsection
@include('_lib.chartjs')
@section('script')
    <script type="text/javascript">
        $('#mn-sts-mhs').addClass('active');
        @if ($guard == 'lecturer')
            $('#mn7').addClass('active');
            $('#mn7').addClass('active pcoded-trigger');
        @endif

        function initBarChart() {
            let options = {
                indexAxis: 'y',
                responsive: true,
            };

            let data1 = {
                labels: @json($st_tot_mhs->pluck('jur_nama')),
                datasets: [{
                    label: "Jumlah Mahasiswa",
                    backgroundColor: '#23a2f7',
                    hoverBackgroundColor: '#23f7b4',
                    data: @json($st_tot_mhs->pluck('tot_mhs')),
                }]
            };

            let bar = document.getElementById("barChart").getContext('2d');
            let myBarChart = new Chart(bar, {
                type: 'horizontalBar',
                data: data1,
                options: options,
            });
        }

        $(document).ready(function() {
            initBarChart();
        });
    </script>
@endsection
