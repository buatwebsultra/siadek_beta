@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Penilaian')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Penilaian</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Penilaian</a>
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
                            <h5><i class="icofont icofont icofont-star text-primary"></i> Penilaian Mahasiswa</h5>
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
                            @if ($setNilai > 0)
                                @if (@$jadPen->wk_status == 1)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="form-ta" action="#">
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <select class="form-control" name="pilih_ta" id="pilih_ta"
                                                            required>
                                                            <option value="">-- Pilih Tahun Ajaran --</option>
                                                            <option
                                                                value="{{ $jadPen->ta->ta_id . '-' . $jadPen->ta->ta_kode . '-' . $jadPen->ta->ta_status }}">
                                                                {{ $jadPen->ta->ta_kode }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <button type="submit" class="btn btn-grd-info "><i
                                                                class="icofont icofont-ui-rotation"></i> Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="card_penilai" class="col-12" style="overflow: auto; display: none">
                                            <table id="tbl1" class="table table-hover"
                                                style="font-size: 10pt; width: 100%">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th width="20">#</th>
                                                        <th>Mata Kuliah</th>
                                                        <th>Jurusan</th>
                                                        <th>Semester</th>
                                                        <th>Ruangan</th>
                                                        <th>Hari</th>
                                                        <th>Jadwal</th>
                                                        <th width="100" class="text-center">Menu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning border-warning">
                                                <strong>Peringatan!</strong> Jadwal input penilaian belum dibuka<code> Harap
                                                    menghubungi Administrator</code>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger border-danger">
                                            <strong>Peringatan!</strong> Setting penilaian belum dilakukan<code> Harap
                                                menghubungi Ketua Jurusan / Program Studi</code>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('_lib.datatable')
@section('script')
    <script type="text/javascript">
        $('#mn4').addClass('active');

        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            hideSidebar();
            @if (@$_GET['kd'])
                $('#pilih_ta').val("{{ $_GET['kd'] }}");
                $('#form-ta').trigger('submit');
            @endif
        });

        $('#form-ta').on('submit', async function(e) {
            e.preventDefault();
            let mix_val = $('#pilih_ta').val();
            setTahunAjaran(mix_val);
            initTablePenilai();
            showCardPenilai();
            // let res = await
        });

        function showCardPenilai() {
            $('#card_penilai').fadeOut(500);
            $('#card_penilai').fadeIn(500);
        }

        async function initTablePenilai() {
            await $('#tbl1').DataTable().destroy();
            $('#tbl1').DataTable({
                ordering: true,
                serverSide: false,
                responsive: false,
                processing: true,
                ajax: "{{ route('lecturer.data.penilaian.matkul') }}/" + globalTaPilih,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'matkul_nama',
                        name: 'matkul_nama'
                    },
                    {
                        data: 'jurnama',
                        name: 'jurnama'
                    },
                    {
                        data: 'matkul_semester',
                        name: 'matkul_semester',
                        className: 'text-center'
                    },
                    {
                        data: 'ruang.ruang_nama',
                        name: 'ruang.ruang_nama'
                    },
                    {
                        data: 'matkul_hari',
                        name: 'matkul_hari'
                    },
                    {
                        data: 'jadwal',
                        name: 'jadwal',
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
        }
    </script>
@endsection
