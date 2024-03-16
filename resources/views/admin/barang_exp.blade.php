@extends('mainlayout')

@section('maincontent')
    <h2>Data Barang Expired</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Tanggal Expired</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang_exp as $barang)
                <tr>
                    <td>{{ $barang->id }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->category }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>Rp. {{ number_format($barang->harga, 0, ',', '.') }}</td>
                    <td>{{ $barang->tanggal_exp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
