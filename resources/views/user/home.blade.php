@extends('indexlayout')

@section('indexcontent')
    <ul class="produk-list">
        @foreach($barang as $item)
            <li class="produk-item" data-category="{{ $item->category }}">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}">
                <h2>{{ $item->nama }}</h2>

                <p>Stok : {{ $item->stok }}</p>
                <p>Harga : Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                <p>Tanggal Exp : {{ $item->tanggal_exp }}</p>

                <button class="add-to-cart" data-product="{{ $item->nama }}" data-price="{{ $item->harga }}">Tambahkan ke Keranjang</button>
                <button class="buy-now" data-product="{{ $item->nama }}" data-price="{{ $item->harga }}">Beli Sekarang</button>
            </li>
        @endforeach
    </ul>
@endsection
