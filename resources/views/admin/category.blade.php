@extends('mainlayout')

@section('maincontent')
    <h2>Data Diskon</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Category</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $index => $categories)
                <tr>
                    <td style="width: 50px;">{{ $index + 1 }}</td>
                <td>{{ $categories->name }}</td>
                <td>
                    <a href="{{ route('category.edit', ['category' => $categories->id]) }}" class="btn btn-edit">Edit</a> |
                    <form action="{{ route('category.destroy', ['category' => $categories->id]) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus category ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <br>
    <a href="{{ route('diskon.create') }}" class="btn btn-primary">Tambah Data Diskon</a>
@endsection
