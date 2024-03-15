@extends('mainlayout')

@section('maincontent')
    <div class="kotak">
        <div class="left-column">
            <h2>Category</h2>
            <ul class="produk-list">
                @foreach($barang as $item)
                    <div class="produk-item product" data-id="{{ $item->id }}" data-harga="{{ $item->harga }}">
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}">
                        <h2>{{ $item->nama }}</h2>
                        <p>Stok : {{ $item->stok }}</p>
                        <p>Harga : Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="right-column">
            <h2>Subtotal Produk :</h2>
            <div class="bayar">
                <div class="produk">Nama Produk</div>
                <div class="harga">Harga</div>
                <div class="total">Jumlah</div>
                <div class="aksi">Aksi</div>
            </div>
            <form id="checkout-form" action="{{ route('kasir.checkout') }}" method="post">
                @csrf
                <ul id="cart-items"></ul>
                <div id="cart-total">
                    <div id="left-total"></div>
                    <div id="center-total"></div>
                    <div id="right-total"></div>
                </div>
                <p>Total: Rp. <span id="total">0.00</span></p>
                <!-- Tambahkan input hidden untuk CSRF token -->
                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                <button id="checkout-btn" class="checkout">Checkout</button>
            </form>
        </div>
    </div>
@endsection
