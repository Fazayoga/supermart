@extends('mainlayout')

@section('maincontent')
    <h2>Data Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Barang ID</th>
                <th>Jumlah Masuk</th>
                <th>Jumlah Keluar</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>id</td>
                    <td>barang_id</td>
                    <td>jumlah_masuk</td>
                    <td>jumlah_keluar</td>
                    <td>created_at</td>
                </tr>
        </tbody>
    </table>
    <br>
    <button class="button-add" id="showAddMemberForm">Tambah Data Barang</button>
@endsection
