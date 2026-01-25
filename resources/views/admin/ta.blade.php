@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Tahun Ajaran')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Tahun Ajaran</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Tahun Ajaran</a>
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
                    <div class="card b-l-info">
                        <div class="card-header">
                            <h5> <i class="icofont icofont-tasks-alt text-primary"></i> Tahun Ajaran</h5>
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
                                        class="btn btn-sm btn-success btn-outline-success btn-round"><i
                                            class="icofont icofont-ui-add"></i> Tambah Data</button>
                                </div>
                                <div class="col-md-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover" style="font-size: 10pt">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Tahun Ajaran</th>
                                                <th width="100" class="text-center">Status</th>
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

    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content border-top-1">
                <form id="form-ta" action="{{ route('admin.tahun-ajaran.create') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> Tambah Tahun Ajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Tahun Ajaran</label>
                                    <input type="number" class="form-control" name="ta_kode" id="ta_kode" min="10000"
                                        required>
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
        $('#mn2').addClass('active');
        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "{{ route('data.ta') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'tahunx',
                        name: 'tahunx'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
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
        });

        function initAdd() {
            $('#modal_add').modal('show');
        }

        $('#form-ta').on('submit', async function(e){
            e.preventDefault();
            let data = $(this).serialize();
            let url = $(this).attr('action');
            let res = await sendAjax(url, data);
            if (res.status) {
                $(this).trigger('reset');
                $('#tbl1').DataTable().ajax.reload();
                $('#modal_add').modal('hide');
                alertSuccess(res.msg);
            } else {
                $('#modal_add').modal('hide');
                alertError(res.msg);
            }
        });

        async function deleteTa(idx) {
            let res = await sendAjax("{{ route('admin.tahun-ajaran.delete') }}", { id: idx });
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                $('#modal_add').modal('hide');
                alertError(res.msg);
            }
        }

        async function initKunci(idx, key) {
            let res = await sendAjax("{{ route('admin.tahun-ajaran.kunci') }}", { id: idx, ta_status: key });
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
        }
    </script>
@endsection
