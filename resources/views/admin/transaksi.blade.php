@extends('mainlayout')

@section('maincontent')
    <h2>Data Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Barang ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->barang_id }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->jumlah_produk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <button class="button-add" id="showAddMemberForm">Tambah Data Barang</button>
@endsection
