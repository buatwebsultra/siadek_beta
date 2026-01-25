@php
    $guard = Auth::getDefaultDriver();
@endphp
@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Laporan')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Laporan</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Laporan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5>Laporan Pengajar</h5>
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
                            <form action="{{ route('pro.laporan.pengajar') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tahun Ajaran</label>
                                            <select class="form-control" name="ta_pilih" id="" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach ($tas as $ta)
                                                    <option value="{{ $ta->ta_id }}">{{ $ta->ta_kode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Program Studi</label>
                                            <select class="col-sm-12 select2" name="jur_pilih" id="jur_pilih" required>
                                                @if ($guard == 'admin')
                                                    <option value="all">-- Semua Prodi --</option>
                                                @endif
                                                @foreach ($jurusans as $jur)
                                                    <option value="{{ $jur->jur_id }}">{{ $jur->jur_nama }} -
                                                        ({{ $jur->jur_jenjang }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Generate</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5>Laporan Mahasiswa</h5>
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
                            <form action="{{ route('pro.laporan.mahasiswa') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tahun Ajaran</label>
                                            <select class="form-control" name="ta_pilih" id="" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach ($tas as $ta)
                                                    <option value="{{ $ta->ta_id }}">{{ $ta->ta_kode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Program Studi</label>
                                            <select class="col-sm-12 select2" name="jur_pilih" id="jur_pilih" required>
                                                @if ($guard == 'admin')
                                                    <option value="all">-- Semua Prodi --</option>
                                                @endif
                                                @foreach ($jurusans as $jur)
                                                    <option value="{{ $jur->jur_id }}">{{ $jur->jur_nama }} -
                                                        ({{ $jur->jur_jenjang }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Generate</button>
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
@include('_lib.select2')
@section('script')
    <script type="text/javascript">
        $('#mn-lap').addClass('active');
        @if ($guard == 'lecturer')
            $('#mn7').addClass('active');
            $('#mn7').addClass('active pcoded-trigger');
        @endif

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
