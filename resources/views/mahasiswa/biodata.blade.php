@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Data Diri')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Data Diri</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Data Diri</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-5 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="{{ asset('komponen/assets/images/user/user.png') }}" class="img-radius"
                                            alt="Profile-Image" width="100px">
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
                                            <p class="m-b-10 f-w-600">Fakultas</p>
                                            <h6 class="text-muted f-w-400"><a href="#"
                                                    class="">{{ $mhs->fakultas->fk_nama }}</a></h6>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <hr>
                                            <p class="m-b-10 f-w-600">Jurusan/Prodi</p>
                                            <h6 class="text-muted f-w-400"><a href="#"
                                                    class="">{{ $mhs->jurusan->jur_nama }}</a></h6>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <hr>
                                            <p class="m-b-10 f-w-600">Dosen Pembimbing</p>
                                            <h6 class="text-muted f-w-400"><a href="#"
                                                    class="">{{ $mhs->pembimbing->ds_nama }}</a></h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wather user -->
                <div class="col-sm-6">
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5><i class="icofont icofont-cube text-primary"></i> Data Diri</h5>
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
                            <form action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="req">Nama</label>
                                            <input type="text" class="form-control form-control-sm" name=""
                                                id="" value="{{ $mhs->mhs_nama }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="req">Jenis Kelamin</label>
                                            <select class="form-control form-control-sm" name="mhs_jk" id="mhs_jk"
                                                required>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="req">Agama</label>
                                            <select class="form-control form-control-sm" name="mhs_agama" id="mhs_agama"
                                                required>
                                                <option value="">-- Pilih --</option>
                                                @foreach ($agama as $agm)
                                                    <option value="{{ $agm->agm_nama }}">{{ $agm->agm_nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="req">Tanggal Lahir</label>
                                            <input type="date" class="form-control form-control-sm" name=""
                                                id="" value="{{ $mhs->mhs_tgl_lahir }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="req">Tempat Lahir</label>
                                            <input type="text" class="form-control form-control-sm" name=""
                                                id="" value="{{ $mhs->mhs_tmpt_lahir }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="req">No Telepon</label>
                                            <input type="text" class="form-control form-control-sm" name=""
                                                id="" value="{{ $mhs->mhs_tlp }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="req">Email</label>
                                            <input type="email" class="form-control form-control-sm" name=""
                                                id="" value="{{ $mhs->mhs_email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <hr>
                                        <button type="submit" class="btn btn-sm btn-mat btn-success"><i
                                                class="icofont icofont-save"></i> Simpan</button>
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
@section('script')
    <script type="text/javascript">
        $('#mn4').addClass('active');
        $('#mhs_jk').val('{{ $mhs->mhs_jk }}');
        $('#mhs_agama').val('{{ $mhs->mhs_agama }}');
    </script>
@endsection
