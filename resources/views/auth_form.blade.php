@extends('layouts.layout')

@section('main')
    @extends('layouts.form')
    @if (Request::path() === 'login')
        @section('form name')
            Masuk
        @endsection

        @section('form action')
            /login
        @endsection

        @section('form request')
            Belum punya akun ? <a href="/signup">Daftar</a>
        @endsection
    @endif
    @if (Request::path() === 'signup')
        @section('form name')
            Daftar
        @endsection

        @section('form action')
            /signup
        @endsection

        @section('form request')
            Sudah punya akun ? <a href="/login">Masuk</a>
        @endsection
    @endif
@endsection
