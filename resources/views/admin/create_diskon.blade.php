@extends('mainlayout')

@section('maincontent')
    <div class="container">
        <h2>Tambah Diskon Baru</h2>
        <form action="{{ route('diskon.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Diskon:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="besar_diskon">Besar Diskon (%):</label>
                <input type="number" id="besar_diskon" name="besar_diskon" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
@endsection
