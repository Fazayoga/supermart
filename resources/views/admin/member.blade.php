@extends('mainlayout')

@section('maincontent')    
    <h2>Daftar Member</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Point</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $index => $member)
                <tr>
                    <td style="width: 45px;">{{ $index + 1 }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->alamat }}</td>
                    <td>{{ $member->no_telp }}</td>
                    <td>{{ $member->point }}</td>
                    <td>
                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-edit">Edit</a> |
                        <form action="{{ route('member.destroy', $member->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Anda yakin ingin menghapus member ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('member.create') }}" class="btn btn-primary">Tambah Member</a>
@endsection