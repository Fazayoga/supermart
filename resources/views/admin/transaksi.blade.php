@extends('mainlayout')

@section('maincontent')
    <h2>Data Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Keterangan Diskon</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $index => $item)
                <tr>
                    <td style="width: 50px;">{{ $index + 1 }}</td>
                    <td>{{ $item->barang->nama }}</td>
                    <td>Rp. {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->diskon->besar_diskon ?? '-' }}</td> <!-- Menampilkan diskon jika ada, jika tidak kosongkan -->
                    <td>{{ $item->diskon ? 'Diskon ' . $item->diskon . '%' : '-' }}</td> <!-- Menampilkan keterangan diskon jika ada, jika tidak kosongkan -->
                    <td>Rp. {{ number_format($item->total_amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
