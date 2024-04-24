@extends('mainlayout')

@section('maincontent')
    <h2>Data Barang</h2>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Category</th>
                <th>Stok</th>
                <th>Tanggal Exp</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $item)
                <tr>
                    <td><img src="{{ $item->gambar }}"></td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->category ? $item->category->name : 'Unknown' }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->tanggal_exp }}</td>
                    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('barang.edit', ['id' => $item->id]) }}" class="btn btn-edit">Edit</a> |
                        <form action="{{ route('barang.destroy', ['id' => $item->id]) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Data Barang</a>
@endsection