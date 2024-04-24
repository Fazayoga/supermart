@extends('indexlayout')

@section('indexcontent')
    <div class="container">
        <h2>Informasi Membership</h2>
        @auth
            @if (isset($member))
                <div class="form-group">
                    <h3>Nama : </h3>
                    <p>{{ $member->nama }}</p>
                </div>

                <div class="form-group">
                    <h3>Alamat : </h3>
                    <p>{{ $member->alamat }}</p>
                </div>

                <div class="form-group">
                    <h3>No. Telepon : </h3>
                    <p>{{ $member->no_telp }}</p>
                </div>
                <a href="{{ route('membership.edit', $member->id) }}" class="btn btn-primary">Edit Membership</a>
            @else
                <p>Anda belum menjadi anggota. Silakan mendaftar untuk mendapatkan keuntungan keanggotaan.</p>
                <a href="{{ route('membership.create') }}" class="btn btn-primary">Daftar Membership</a>
            @endif
        @else
            <p>Silakan login untuk melihat informasi keanggotaan.</p>
        @endauth
    </div>
@endsection
