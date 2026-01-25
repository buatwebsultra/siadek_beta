@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Mahasiswa')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Mahasiswa</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Mahasiswa</a>
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
                            <h5><i class="icofont icofont icofont-ui-user-group text-primary"></i> Mahasiswa Bimbingan</h5>
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="" id="pilih_angkatan" onchange="setAngkatan(this)"
                                            class="form-control">
                                            <option value="all">- Semua Angkatan -</option>
                                            @for ($i = date('Y'); $i >= 2019; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover" style="font-size: 10pt">
                                        <thead class="bg-light">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th class="text-center">Angkatan</th>
                                                <th width="100" class="text-center">Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($msiswa as $mhs)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $mhs->mhs_nim }}</td>
                                                    <td>{{ $mhs->mhs_nama }}</td>
                                                    <td>{{ $mhs->jurusan->jur_nama }}</td>
                                                    <td class="text-center">{{ $mhs->mhs_angkatan }}</td>
                                                    <td class="text-center">
                                                        <button type="button" onclick="initDetailMhs({{ $mhs->mhs_id }})"
                                                            class="btn btn-sm btn-info btn-outline-info"><i
                                                                class="icofont icofont-info-square"></i>Info</button>
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

    <div class="modal fade" id="modal_info" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-top-1">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icofont icofont-info-square"></i> Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="">
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto">
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td width="130">Nama</td>
                                        <td width="10">:</td>
                                        <td id="show-mhs-nama">--</td>
                                    </tr>
                                    <tr>
                                        <td>NIM</td>
                                        <td>:</td>
                                        <td id="show-mhs-nim">--</td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td>:</td>
                                        <td id="show-mhs-jurusan">--</td>
                                    </tr>
                                    <tr>
                                        <td>Angkatan/Semester</td>
                                        <td>:</td>
                                        <td id="show-mhs-angg-semes">--</td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</td>
                                        <td>:</td>
                                        <td id="show-mhs-tlp">--</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td id="show-mhs-email">--</td>
                                    </tr>
                                </tbody>
                            </table>
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
@endsection
@include('_lib.datatable')
@section('script')
    <script type="text/javascript">
        $('#mn3').addClass('active');
        $.extend(true, $.fn.dataTable.defaults, configDataTable);
        $(document).ready(function() {
            $('#pilih_angkatan').val('{{ $angkatan }}');
            $('#tbl1').DataTable({
                responsive: true
            });
        });

        async function initDetailMhs(id_mhs) {
            let res = await sendAjax("{{ route('lecturer.mahasiswa.get') }}/" + id_mhs, {}, 'GET');
            if (res.status) {
                isiData(res.data);
                $('#modal_info').modal('show');
            }
        }

        function isiData(data) {
            $('#show-mhs-nama').html(data.mhs_nama);
            $('#show-mhs-nim').html(data.mhs_nim);
            $('#show-mhs-jurusan').html(data.jurusan.jur_nama + ' (' + data.jurusan.jur_jenjang + ')');
            $('#show-mhs-angg-semes').html(data.mhs_angkatan + ' / ' + data.mhs_semester);
            $('#show-mhs-tlp').html(data.mhs_tlp);
            $('#show-mhs-email').html(data.mhs_email);
        }

        function setAngkatan(ob) {
            let ang = $(ob).val();
            document.location = "{{ route('lecturer.mahasiswa') }}/" + ang;
        }
    </script>
@endsection
