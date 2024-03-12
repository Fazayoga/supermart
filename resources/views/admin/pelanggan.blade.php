<!-- resources/views/pelanggan.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Data Pelanggan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelanggan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
