@extends('mainlayout')

@section('maincontent')    
    <div class="container">
        <h2>Edit Diskon</h2>
        <form action="{{ route('diskon.update', $diskon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="{{ $diskon->nama }}">
            </div>
            <div class="form-group">
                <label for="besar_diskon">Besar Diskon:</label>
                <input type="text" id="besar_diskon" name="besar_diskon" value="{{ $diskon->besar_diskon }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
