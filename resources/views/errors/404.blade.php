@extends('_layouts.error')
@section('css')
@endsection
@section('pageName', '404')
@section('body')
    <!-- Your text -->
    <h1>Oops! Error 404 (not found)</h1>

    <p>Halaman yang anda cari tidak ditemukan<br>
        <a href="{{ route('login') }}" class="btn btn-default btn-outline-inverse"><i
                class="icofont icofont-exchange"></i>Kembali</a>
    </p>
@endsection
@section('script')
@endsection
