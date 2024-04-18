@extends('mainlayout')

@section('maincontent')    
    <div class="container">
        <h2>Edit Member</h2>
        <form action="{{ route('member.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="{{ $member->nama }}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="{{ $member->alamat }}">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telepon:</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ $member->no_telp }}">
            </div>
            <div class="form-group">
                <label for="point">Point:</label>
                <input type="text" id="point" name="point" value="{{ $member->point }}">
            </div>
        </form>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
@endsection
