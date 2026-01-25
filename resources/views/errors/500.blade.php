@extends('_layouts.error')
@section('css')
@endsection
@section('pageName', '500')
@section('body')
    <!-- Your text -->
    <h1>Oops! Error 500 (Server Error)</h1>

    <p>
        <a href="{{ route('login') }}" class="btn btn-default btn-outline-inverse"><i
                class="icofont icofont-exchange"></i>Kembali</a>
    </p>
@endsection
@section('script')
@endsection
