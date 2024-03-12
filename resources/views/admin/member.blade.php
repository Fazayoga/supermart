@extends('mainlayout')

@section('maincontent')
    
    <h2>Data Member</h2>

    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan ID</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Point</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID</td>
                <td>Pelanggan_Id</td>
                <td>Almat</td>
                <td>No Telp</td>
                <td>Point</td>
                <td>Hapus | Edit</td>
            </tr>
        </tbody>
    </table>
    <br>
    <button class="button-add" id="showAddMemberForm">Tambah Member Baru</button>

    <script src="{{ asset('js/member.js') }}"></script>
@endsection