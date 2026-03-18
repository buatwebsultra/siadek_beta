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
                                <div class="col-md-2 mb-3">
                                    <button type="button" onclick="initAdd()"
                                        class="btn btn-block btn-sm btn-success btn-outline-success"><i
                                            class="icofont icofont-ui-add"></i> Tambah Data</button>
                                </div>
                                <div class="col-md-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover" style="font-size: 10pt">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Mahasiswa</th>
                                                <th>Jurusan/Prodi</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Semester</th>
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

    <div class="modal fade" id="modal_add" role="dialog" aria-labelledby="modal_add" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-top-2">
                <form id="form-ukt" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="mhs_id" id="mhs_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> <span
                                class="modal_title">Tambah</span> Data Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Tahun Ajaran / Semester</label>
                                    <select class="form-control form-control-sm" name="byr_ta" id="byr_ta" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($tas as $ta)
                                            <option value="{{ $ta->ta_kode . '-' . $loop->iteration }}">
                                                {{ $ta->ta_kode }} / Semester {{ $loop->iteration }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Atas Nama / NIM</label>
                                    <input type="text" class="form-control form-control-sm" name="byr_nama"
                                        id="byr_nama" value="{{ $mhs->mhs_nama }} - ({{ $mhs->mhs_nim }})" readonly
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Bank Pembayaran</label>
                                    <select class="form-control form-control-sm" name="byr_bank" id="byr_bank" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Bank Tabungan Negara">Bank Tabungan Negara</option>
                                        <option value="Bank Negara Indonesia">Bank Negara Indonesia</option>
                                        <option value="Bank Rakyat Indonesia">Bank Rakyat Indonesia</option>
                                        <option value="Bank Mandiri">Bank Mandiri</option>
                                        <option value="Bank Central Asia">Bank Central Asia</option>
                                        <option value="Bank ICBC Indonesia">Bank ICBC Indonesia</option>
                                        <option value="Bank Permata">Bank Permata</option>
                                        <option value="Bank Syariah Indonesia">Bank Syariah Indonesia</option>
                                        <option value="Bank Artos Indonesia">Bank Artos Indonesia</option>
                                        <option value="BPD Sulawesi Tenggara">BPD Sulawesi Tenggara</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">No Rekening Pembayaran</label>
                                    <input type="text" class="form-control form-control-sm" name="byr_rek_tuj"
                                        id="byr_rek_tuj" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control form-control-sm" name="byr_tgl_bayar"
                                        id="byr_tgl_bayar" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Jumlah Pembayaran</label>
                                    <input type="text" class="form-control form-control-sm" name="byr_jml_bayar"
                                        id="byr_jml_bayar" onblur="formatCurrency(this, true);"
                                        onkeyup="formatCurrency(this, false);" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Bukti Pembayaran</label>
                                    <input type="file" class="form-control form-control-sm" name="file_ukt"
                                        id="file_ukt" required>
                                    <span><code>Unggah file dengan format (jpg,png atau pdf)</code></span><br>
                                    <span><code>Ukuran maksimal : 2 Mb</code></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default waves-effect btn-round"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-info waves-effect btn-round"><i
                                class="icofont icofont-save"></i> Simpan</button>
                    </div>
                </form>
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
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
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
                                    <tr>
                                        <td colspan="3">
                                            <div class="form-control">
                                                <label for="">Keterangan</label>
                                                <textarea class="form-control" name="ket_ukt" id="ket_ukt" readonly>-</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
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

    <form id="form-ukt-delete" action="{{ route('student.ukt.delete') }}" method="POST">
        @csrf
        <input type="hidden" name="byr_id" id="byr_idx">
    </form>
@endsection
@include('_lib.datatable')
@include('_lib.select2')
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js" integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('#mn6').addClass('active');

        $(document).ready(function() {
            // hideSidebar();
            initTable();
            $('#byr_bank').select2({
                dropdownParent: $("#modal_add")
            });
            $("#byr_jml_bayar").inputmask({
                alias: "numeric",
                groupSeparator: ".",
                autoGroup: true,
                radixPoint: ",",
                digits: 2,
                rightAlign: false,
                oncleared: function () { self.Value(''); }
            });
        });

        // function formatCurrency(input, blur) {
        //     // input.value = input.value.replace(/[^\d^\.]/g, "");
        //     // input.value = input.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //     input.value = input.value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        // }

        function initTable() {
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "{{ route('data.pembayaran-ukt') }}/",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
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

        function initAdd() {
            $('#form-ukt').trigger('reset');
            $('#form-ukt').attr('action', "{{ route('student.ukt.store') }}");
            $('#modal_add').modal('show');
        }

        function deleteUkt(id) {
            $('#byr_idx').val(id);
            $('#form-ukt-delete').trigger('submit');
        }

        $('#form-ukt-delete').on('submit', async function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let action = $(this).attr('action');
            let res = await sendAjax(action, data);
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
        });

        async function initBukti(id) {
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
    </script>
@endsection
