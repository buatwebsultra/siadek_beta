@extends('_layouts.error')
@section('css')
@endsection
@section('pageName', '419')
@section('body')
    <!-- Your text -->
    <h1>Oops! Error 419 (Page Expired)</h1>

    <p>
        <a href="{{ route('login') }}" class="btn btn-default btn-outline-inverse"><i
                class="icofont icofont-exchange"></i>Kembali</a>
    </p>
@endsection
@section('script')
@endsection
