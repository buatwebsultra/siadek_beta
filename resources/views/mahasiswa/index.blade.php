@php
    $semester = json_decode($mhs->mhs_semester_data);
    $ipk = 0.0;
    if (@$nilai) {
        $ipk = $nilai->nilai_ip;
    }
    $arrHari = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
@endphp
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

            @if ($mhs->mhs_kunci_data == 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning icons-alert">
                            <p><strong>Perhatian!</strong> <span>Biodata anda belum dikunci : <a
                                        href="{{ route('student.data-diri') }}"
                                        class="btn btn-sm btn-out btn-warning btn-square"><i
                                            class="icofont icofont-ui-user"></i> Isi Biodata</a></span></p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-c-blue text-white widget-visitor-card">
                                <div class="card-block-small text-center">
                                    <h2>{{ $totSks }}</h2>
                                    <h6>Total SKS</h6>
                                    <i class="feather icon-file-text"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-c-yellow text-white widget-visitor-card">
                                <div class="card-block-small text-center">
                                    <h2>{{ number_format($ipk, 2) }}</h2>
                                    <h6>IP Semester </h6>
                                    <i class="feather icon-award"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-5 bg-grad-4 user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="m-b-25">
                                                <img class="img-fluid img-radius" src="{{ asset($mhs->mhs_foto) }}"
                                                    alt="Foto" style="width: 120px">
                                            </div>
                                            <h6 class="f-w-600">{{ $mhs->mhs_nama }}</h6>
                                            <p>NIM : {{ $mhs->mhs_nim }}</p>
                                            <p><strong>{{ $mhs->mhs_angkatan }}</strong></p>
                                            {{-- <i class="feather icon-edit m-t-10 f-16"></i> --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="card-block">
                                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                            <div class="row">

                                                <div class="col-sm-12 ">
                                                    <p class="m-b-10 f-w-600">Jurusan/Prodi</p>
                                                    <h6 class="text-muted f-w-400"><a href="#"
                                                            class="">{{ $mhs->jurusan->jur_nama }}
                                                            ({{ $mhs->jurusan->jur_jenjang }})</a></h6>
                                                </div>
                                                <div class="col-sm-12 ">
                                                    <hr>
                                                    <p class="m-b-10 f-w-600">Pembimbing Akademik</p>
                                                    <h6 class="text-muted f-w-400"><a href="#"
                                                            class="">{{ $mhs->pembimbing->ds_nama }},
                                                            {{ $mhs->pembimbing->ds_gelar }}</a></h6>
                                                    <p>({{ $mhs->pembimbing->ds_nip }})</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-block btn-out-dashed btn-primary btn-square">Semester
                                {{ end($semester) }}</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-block btn-out-dashed btn-primary btn-square">TA
                                {{ $ta->ta_kode }}</button>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="icofont icofont-ui-timer text-warning"></i> Kuliah Hari Ini
                                        ({{ $arrHari[date('N')] }})</h5>
                                </div>
                                <div class="card-block table-border-style">
                                    <div class="table-responsive" style="overflow: auto">
                                        <table class="table table-hover table-striped" style="font-size: 10pt">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Mata Kuliah</th>
                                                    <th>Ruangan</th>
                                                    <th class="text-center">Jadwal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($cekUkt)
                                                    @forelse ($jadwal as $jdw)
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}.</th>
                                                            <td>{{ $jdw->matkul->matkul_nama }}</td>
                                                            <td>{{ $jdw->matkul->ruang->ruang_nama }}</td>
                                                            <td class="text-center">{{ $jdw->matkul->matkul_jadwal }} s/d
                                                                {{ $jdw->matkul->matkul_end }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">
                                                                <code>Tidak ada jadwal hari ini</code>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center">
                                                            <code>Bukti Pembayaran UKT {{ $ta->ta_kode }} Belum Ada</code>
                                                        </td>
                                                    </tr>
                                                @endif


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5> Riwayat Pembayaran UKT</h5>
                                </div>
                                <div class="card-block table-border-style">
                                    <div class="table-responsive" style="overflow: auto">
                                        <table class="table table-hover table-striped" style="font-size: 10pt">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tahun Ajaran</th>
                                                    <th class="text-center">Semester</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($ukts as $ukt)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}.</td>
                                                        <td>{{ $ukt->byr_ta }}</td>
                                                        <td class="text-center">{{ $ukt->byr_semester }}</td>
                                                        <td class="text-center">{!! $ukt->getStatusHtml() !!}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">
                                                            <code>Data belum ada</code>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    </script>
@endsection
