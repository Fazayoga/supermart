@extends('mainlayout')

@section('maincontent')
    @auth('admin')
    <h2>Selamat datang <u><strong>{{ auth('admin')->user()->name }}</strong></u> di Website MAMTQ</h2>
    @endauth
@endsection