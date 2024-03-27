<!-- resources/views/cashiers/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Kasir Baru</h2>
        <form action="{{ route('cashiers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Kasir:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
