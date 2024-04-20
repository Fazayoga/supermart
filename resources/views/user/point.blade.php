@extends('indexlayout')

@section('indexcontent')
<div class="container">
    <h2>Informasi Points</h2>
        @auth
            @if (isset($member))
                <div class="form-group">
                    <h3>Point : </h3>
                    <p>{{ $member->point }}</p>
                </div>
            @else
                <!-- Tampilkan pesan untuk pengguna yang belum mendaftar -->
                <p>Mohon daftar membership terlebih dahulu jika ingin mendapatkan point.</p>
                <!-- Tampilkan tautan untuk mendaftar -->
            @endif
        @endauth
    </div>
@endsection
