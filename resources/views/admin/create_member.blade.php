@extends('mainlayout')

@section('maincontent')
    <div class="container">
        <h1>Tambah Member Baru</h1>
        <form action="{{ route('member.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="no_telp">No. Telepon:</label>
                <input type="text" id="no_telp" name="no_telp" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="point">Point:</label>
                <input type="number" id="point" name="point" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
