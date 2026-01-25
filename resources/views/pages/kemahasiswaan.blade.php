@php
    $guard = Auth::getDefaultDriver();
@endphp
@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Kemahasiswaan')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Kemahasiswaan</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Kemahasiswaan</a>
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
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5><i class="icofont icofont-hat-alt"></i> Menu Kemahasiswaan</h5>
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
                            <form id="form-mhs" action="{{ route('pro.mahasiswa.cek-menu') }}" method="POST"
                                target="_blank">
                                @csrf
                                <input type="hidden" name="tipe" id="tipe">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Jurusan / Prodi</label>
                                                    @include('_komponen.form_pilih_jurusan')
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Mahasiswa</label>
                                                    <select class="form-control form-control-sm" name="mhs_id"
                                                        id="mhs_id" required>
                                                        <option value="">-- Pilih --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Tahun Ajaran</label>
                                                    <select class="form-control form-control-sm" name="ta_id"
                                                        id="ta_id" required>
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($tas as $ta)
                                                            <option value="{{ $ta->ta_id }}">
                                                                {{ $ta->ta_kode }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 28px;">
                                        <button type="button" onclick="initForm1('krs')"
                                            class="btn btn-block btn-grd-primary"><i class="ti-file"></i> Cetak
                                            KRS</button><br>
                                        <button type="button" onclick="initForm1('khs')"
                                            class="btn btn-block btn-grd-info"><i class="ti-file"></i> Cetak
                                            KHS</button><br>
                                        <button type="button" onclick="initForm1('trans')"
                                            class="btn btn-block btn-grd-success"><i class="ti-file"></i> Cetak
                                            Transkrip</button>
                                    </div>
                                </div>
                                <input type="submit" style="display: none" id="btn-submit1">
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
        let localJurusanID = 'all';
        @if ($guard == 'admin')
            $('#mn6').addClass('active');
        @else
            $('#mn8').addClass('active');
            localJurusanID = '{{ $jurusan[0]->jur_id }}';

            let vall =
                `<option value="{{ $jurusan[0]->jur_id }}" selected="selected">{{ $jurusan[0]->jur_nama }} - ({{ $jurusan[0]->jur_jenjang }})</option>`;
            $('#jur_pilih').html(vall);
        @endif

        $(document).ready(function() {
            initMhs();
        });

        function initPilihJurusan(ob) {
            localJurusanID = $(ob).val();
            // initTable();
        }

        function initMhs() {
            $('#mhs_id').select2({
                placeholder: 'Cari berdasarkan NIM atau Nama ..',
                minimumInputLength: 3,
                ajax: {
                    url: "{{ route('pro.mahasiswa.cari') }}/" + localJurusanID,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.mhs_nama + ' - (' + item.mhs_nim + ') - ' + item
                                        .mhs_angkatan,
                                    id: item.mhs_id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }

        function initForm1(tipe) {
            $('#tipe').val(tipe);
            $('#btn-submit1').trigger('click');
        }
    </script>
@endsection
