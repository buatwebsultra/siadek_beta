@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Jadwal Penilaian')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Jadwal Penilaian</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Jadwal Penilaian</a>
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
                            <h5><i class="icofont icofont-clock-time"></i> Atur Jadwal Penilaian</h5>
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
                                <div class="col-md-12 mb-3">
                                    <button type="button" onclick="initAdd()"
                                        class="btn btn-sm btn-success btn-outline-success"><i
                                            class="icofont icofont-ui-add"></i> Tambah</button>
                                </div>
                                <div class="col-md-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover table-striped" style="width: 100%">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Tahun Ajar</th>
                                                <th class="text-center">Waktu Selesai</th>
                                                <th class="text-center">Status</th>
                                                <th width="100" class="text-center">Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwals as $jad)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $jad->ta->ta_kode }}</td>
                                                    <td class="text-center">
                                                        {{ $jad->wk_tgl_end . ' - ' . $jad->wk_jam_end }}</td>
                                                    <td class="text-center">
                                                        {!! $jad->getLabelHtml() !!}
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" onclick="initEdit({{ $jad->wk_id }})"
                                                            class="btn btn-info btn-icon"><i
                                                                class="ti-pencil-alt"></i></button>
                                                        <button type="button"
                                                            onclick="initDelete(`deleteJadwal`, {{ $jad->wk_id }})"
                                                            class="btn btn-danger btn-icon"><i
                                                                class="ti-trash"></i></button>
                                                    </td>
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
    </div>

    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content border-top-1">
                <form id="form-waktu" action="{{ route('pro.jadwal-pen.insert') }}" method="POST">
                    @csrf
                    <input type="hidden" name="wk_id" id="wk_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="ti-pencil-alt"></i> <span class="modal_title">Tambah</span> Waktu
                            Penilaian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Tahun Ajaran</label>
                                    <select class="form-control" name="wk_ta_id" id="wk_ta_id" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($tas as $ta)
                                            <option value="{{ $ta->ta_id }}">{{ $ta->ta_kode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="wk_tgl_end" id="wk_tgl_end" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Waktu Selesai</label>
                                    <input type="time" class="form-control" name="wk_jam_end" id="wk_jam_end"
                                        value="{{ date('H:i') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect btn-round"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info waves-effect btn-round"><i
                                class="icofont icofont-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@include('_lib.datatable')
@section('script')
    <script type="text/javascript">
        $('#mn-jad').addClass('active');

        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            initTable();
        });

        function initTable() {
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
            });
        }

        function initAdd() {
            $('.modal_title').html('Tambah');
            $('#form-waktu').trigger('reset');
            $('#form-waktu').attr('action', "{{ route('pro.jadwal-pen.insert') }}");
            $('#wk_ta_id').removeAttr('disabled');
            $('#modal_add').modal('show');
        }

        async function initEdit(id) {
            $('.modal_title').html('Edit');
            $('#form-waktu').trigger('reset');
            $('#form-waktu').attr('action', "{{ route('pro.jadwal-pen.update') }}");
            $('#wk_ta_id').attr('disabled', 'true');
            $('#modal_add').modal('show');

            let res = await sendAjax("{{ route('pro.jadwal-pen.get') }}/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
                $('#modal_add').modal('show');
            } else {
                alertError(res.msg);
            }
        }

        function isiData(data) {
            $('#wk_ta_id').val(data.wk_ta_id);
            $('#wk_tgl_end').val(data.wk_tgl_end);
            $('#wk_jam_end').val(data.wk_jam_end);
            $('#wk_id').val(data.wk_id);
        }

        async function deleteJadwal(idx) {
            let res = await sendAjax("{{ route('pro.jadwal-pen.delete') }}", {
                id: idx
            });
            if (res.status) {
                window.location.href = window.location.href;
            } else {
                alertError(res.msg);
                console.log(res);
            }
        }
    </script>
@endsection
