@extends('indexlayout')

@section('indexcontent')    
    <div class="container">
        <h2>Edit Membership</h2>
        <form action="{{ route('membership.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ auth()->user()->name }}" readonly>
            </div>  
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="{{ $member->alamat }}">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telepon:</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ $member->no_telp }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
