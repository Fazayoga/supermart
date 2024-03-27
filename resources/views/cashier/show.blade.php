<!-- resources/views/cashiers/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Kasir</h2>
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $cashier->id }}</p>
                <p><strong>Nama:</strong> {{ $cashier->name }}</p>
            </div>
        </div>
        <a href="{{ route('cashiers.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </div>
@endsection
