<!-- resources/views/cashiers/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Kasir</h2>
        <form action="{{ route('cashiers.update', $cashier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Kasir:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $cashier->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
