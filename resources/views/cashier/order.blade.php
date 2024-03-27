<!-- resources/views/cashiers/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Kasir</h2>
        <a href="{{ route('cashiers.create') }}" class="btn btn-primary mb-2">Tambah Kasir</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cashiers as $cashier)
                    <tr>
                        <td>{{ $cashier->id }}</td>
                        <td>{{ $cashier->name }}</td>
                        <td>
                            <a href="{{ route('cashiers.show', $cashier->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('cashiers.edit', $cashier->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('cashiers.destroy', $cashier->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus kasir ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
