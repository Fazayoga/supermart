@extends('mainlayout')

@section('maincontent')
    <h2>Data Diskon</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Diskon</th>
                <th>Besar Diskon (%)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diskon as $index => $item)
                <tr>
                    <td style="width: 50px;">{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->besar_diskon }}%</td>
                    <td>
                        <a href="{{ route('diskon.edit', ['id' => $item->id]) }}" class="btn btn-edit">Edit</a> |
                        <form action="{{ route('diskon.destroy', ['id' => $item->id]) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus diskon ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('diskon.create') }}" class="btn btn-primary">Tambah Data Diskon</a>
@endsection
