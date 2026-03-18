@php
    $guard = Auth::getDefaultDriver();
@endphp
@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Pembayaran SPP')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Pembayaran SPP</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Pembayaran SPP</a>
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
                            <h5><i class="icofont icofont-clip-board text-primary"></i> Data Pembayaran</h5>
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
                            <div class="row">
                                @if ($guard == 'admin')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @include('_komponen.form_pilih_jurusan', $jurusan)
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <button type="button" onclick="initSync()" class="btn btn-sm btn-primary mb-2">
                                        <i class="icofont icofont-refresh"></i>
                                        Update Status Mahasiswa
                                    </button>
                                    <button type="button" onclick="initLaporan()" class="btn btn-sm btn-info mb-2 ml-2">
                                        <i class="icofont icofont-file-document"></i>
                                        Laporan Keuangan
                                    </button>
                                </div>
                                <div class="col-md-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover" style="font-size: 10pt; width: 100%">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Mahasiswa</th>
                                                <th>Jurusan/Prodi</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Semester</th>
                                                <th>Waktu Upload</th>
                                                <th>Status</th>
                                                <th width="100" class="text-center">Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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

    <div class="modal fade" id="modal_bukti" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-top-1">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icofont icofont-clip-board"></i> Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="">
                    <div class="row">
                        <div class="col-md-12 text-center mb-2">
                            <button type="button" onclick="gasValidasi(1)" class="btn btn-success"><i
                                    class="icofont icofont-check-circled"></i>Validasi</button> |
                            <button type="button" onclick="gasValidasi(2)" class="btn btn-warning"><i
                                    class="icofont icofont-warning-alt"></i>Tolak</button>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <div class="form-control">
                                                <label for="">Keterangan</label>
                                                <textarea class="form-control" name="ket_ukt" id="ket_ukt">-</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100">TA / Semester</td>
                                        <td width="10">:</td>
                                        <td id="show_byr_ta">...</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Pembayaran</td>
                                        <td>:</td>
                                        <td id="show_byr_bank">...</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembayaran</td>
                                        <td>:</td>
                                        <td id="show_byr_tgl_bayar">...</td>
                                    </tr>
                                    <tr>
                                        <td>Atas Nama</td>
                                        <td>:</td>
                                        <td id="show_byr_nama">...</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Pembayaran </td>
                                        <td>:</td>
                                        <td id="show_byr_jml_bayar">...</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Upload </td>
                                        <td>:</td>
                                        <td id="show_upload_at">...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 mt-2">
                            <object data="" id="obj_file" type="application/pdf"
                                style="width: 100%; min-height: 600px">
                                <embed src="" id="emb_file" type="application/pdf"
                                    style="width: 100%; min-height: 600px" />
                            </object>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect btn-round"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_sync" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <form id="form-sync" action="{{ route('admin.mhs-status.sync') }}" method="POST">
                @csrf
                <div class="modal-content border-top-1">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="icofont icofont-refresh"></i>
                            Update Status Mahasiswa
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-warning icons-alert">
                                    <p><strong>Update</strong> status mahasiswa berdasarkan pembayaran UKT pada tahun ajaran
                                        terpilih.</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Tahun Ajaran</label>
                                    <select class="form-control" name="sync_ta" id="sync_ta" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($tas as $ta1)
                                            <option value="{{ $ta1->ta_kode }}">📆 {{ $ta1->ta_kode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="icofont icofont-paper-plane"></i>
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal_laporan" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <form id="form-laporan" action="{{ route('admin.laporan.ukt') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="icofont icofont-file-document"></i>
                            Laporan Keuangan
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Jurusan/Prodi</label>
                                    <select class="form-control" name="lap_jur_id" id="lap_jur_id" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($jurusan as $jur)
                                            <option value="{{ $jur->jur_id }}">
                                                {{ $jur->jur_nama }} - ({{ $jur->jur_jenjang }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Angkatan</label>
                                    <select class="form-control" name="lap_angkatan" id="lap_angkatan" required>
                                        <option value="">-- Pilih --</option>
                                        @for ($i = date('Y'); $i >= 2019; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="icofont icofont-paper-plane"></i>
                            Export
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form id="form-valid" action="{{ route('admin.ukt.validasi') }}" method="POST">
        @csrf
        <input type="hidden" name="byr_id" id="byr_idx">
        <input type="hidden" name="byr_status" id="byr_status" value="0">
        <input type="hidden" name="byr_ket" id="byr_ketx">
    </form>
@endsection
@include('_lib.datatable')
@include('_lib.select2')
@section('script')
    <script type="text/javascript">
        $('#mn9').addClass('active');
        localJurusan = 'all';

        $(document).ready(function() {
            // hideSidebar();
            initTable();
        });

        async function initPilihJurusan(ob) {
            localJurusan = $(ob).val();
            await $('#tbl1').DataTable().destroy();
            initTable();
        }

        function initTable() {
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('data.pembayaran-ukt') }}/" + localJurusan,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'mhs',
                        name: 'mhs',
                        orderable: false
                    },
                    {
                        data: 'mahasiswa.jurusan',
                        name: 'mahasiswa.jurusan',
                        orderable: false,
                        render: function(data) {
                            if (!data) return '<span class="text-danger">Data Tidak Ditemukan</span>';
                            return data.jur_nama + ' (' + data.jur_jenjang + ')';
                        }
                    },
                    {
                        data: 'byr_ta',
                        name: 'byr_ta',
                        className: 'text-center'
                    },
                    {
                        data: 'byr_semester',
                        name: 'byr_semester',
                        className: 'text-center'
                    },
                    {
                        data: 'upload_at',
                        name: 'upload_at',
                        className: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'menu',
                        name: 'menu',
                        searchable: false,
                        className: 'text-center',
                        orderable: false
                    },
                ]
            });
        }

        async function initValidasi(file, id) {
            $('#byr_idx').val(id);
            let res = await sendAjax("{{ route('data.pembayaran.detail') }}/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
            } else {
                alertError(res.msg);
            }
        }

        function isiData(data) {
            $('#show_byr_nama').html(data.byr_nama);
            $('#show_byr_bank').html(data.byr_bank + ' (' + data.byr_rek_tuj + ')');
            $('#show_byr_tgl_bayar').html(data.byr_tgl_bayar);
            $('#show_byr_jml_bayar').html('Rp. ' + rupiah(data.byr_jml_bayar));
            $('#show_byr_ta').html(data.byr_ta + ' / Semester : ' + data.byr_semester);
            $('#obj_file').attr('data', globalAppUrl + data.byr_bukti);
            $('#emb_file').attr('src', globalAppUrl + data.byr_bukti);
            $('#show_upload_at').html(data.upload_at);
            $('#ket_ukt').html(data.byr_ket);
            $('#modal_bukti').modal('show');
        }

        function gasValidasi(status) {
            let isiKet = $('#ket_ukt').val();
            $('#byr_ketx').val(isiKet);
            $('#byr_status').val(status);
            $('#form-valid').trigger('submit');
        }

        $('#form-valid').on('submit', async function(e) {
            e.preventDefault();
            let action = $(this).attr('action');
            let data = $(this).serialize();
            let res = await sendAjax(action, data);
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
            $('#modal_bukti').modal('hide');
        });

        function initSync() {
            $('#form-sync').trigger('reset');
            $('#modal_sync').modal('show');
        }

        function initLaporan() {
            $('#form-laporan').trigger('reset');
            $('#modal_laporan').modal('show');
        }
    </script>
@endsection
