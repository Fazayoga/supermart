@extends('mainlayout')

@section('maincontent')
    <h2>Data Barang</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Tanggal Exp</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>ID</td>
                    <td>Nama</td>
                    <td>Stok</td>
                    <td>Tanggal Exp</td>
                    <td>Harga</td>
                    <td>Hapus | Edit</td>
                </tr>
        </tbody>
    </table>    
    <br>
    <button class="button-add" id="showAddMemberForm">Tambah Data Barang</button>
@endsection
