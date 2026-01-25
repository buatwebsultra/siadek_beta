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
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="icofont icofont-ui-settings text-warning"></i> Pengaturan</h5>
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
                            <form id="form-pass" action="{{ route('lecturer.akun.updatePass') }}" method="POST">
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
        $('#mn6').addClass('active');

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
