@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Akun')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Akun</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Akun</a>
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
                                        <img src="{{ asset($mhs->mhs_foto) }}" class="img-radius" alt="Foto"
                                            style="width: 80%">
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
                                                    class="">({{ $mhs->jurusan->jur_jenjang }})
                                                    {{ $mhs->jurusan->jur_nama }}</a></h6>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <hr>
                                            <p class="m-b-10 f-w-600">Pembimbing Akademik</p>
                                            <h6 class="text-muted f-w-400"><a href="#"
                                                    class="">{{ $mhs->pembimbing->ds_nama . ', ' . $mhs->pembimbing->ds_gelar }}</a>
                                            </h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="icofont icofont-ui-settings text-warning"></i> Keamanan</h5>
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
                            <form id="form-pass" action="{{ route('student.akun.updatePass') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="req">Password Lama</label>
                                            <input type="password" class="form-control form-control-sm" name="pass_l"
                                                id="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="req">Password Baru</label>
                                            <input type="password" class="form-control form-control-sm" name="pass_b"
                                                id="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="req">Password Baru (Ulangi)</label>
                                            <input type="password" class="form-control form-control-sm" name="pass_b2"
                                                id="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <hr>
                                        <button type="submit" class="btn btn-sm btn-mat btn-warning"><i
                                                class="icofont icofont-ui-unlock"></i> Simpan</button>
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
        $('#mn5').addClass('active');
        //   $('#mn2').addClass('active pcoded-trigger');
        //   $('#mn2-1').addClass('active');

        $('#form-pass').on('submit', async function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let url = $(this).attr('action');
            let res = await sendAjax(url, data);
            if (res.status) {
                $(this).trigger('reset');
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
                console.log(res);
            }
        });
    </script>
@endsection
