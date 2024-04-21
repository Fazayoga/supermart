@extends('indexlayout')

@section('indexcontent')
    <h2>Keranjang Belanja</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (!$keranjang->isEmpty())
                @foreach ($keranjang as $item)
                <tr>
                    <td style="width: 45px;">{{ $index + 1 }}</td>
                    <td>{{ number_format($item->nama_produk, 0, ',', '.') }}</td>
                    <td>Rp. {{ $item->harga }}</td>
                </tr>
                @endforeach
                <a href="{{ route('keranjang.checkout') }}" class="btn btn-primary">Checkout</a>
            @else
                <p>Keranjang belanja Anda kosong.</p>
            @endif
        </tbody>
    </table>
@endsection
