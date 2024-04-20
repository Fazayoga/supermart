@extends('indexlayout')

@section('indexcontent')
    <div class="container">
        <h1>Daftar Membership</h1>
        <form action="{{ route('membership.store') }}" method="POST">
            @csrf
            @auth
                <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
            @endauth
            @if(auth()->check() && auth()->user()->name)
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ auth()->user()->name }}" readonly>
                </div>  
            @endif

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="no_telp">No. Telepon:</label>
                <input type="text" id="no_telp" name="no_telp" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
