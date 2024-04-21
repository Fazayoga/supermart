@extends('indexlayout')

@section('indexcontent')
    <ul class="produk-list">
        @foreach($barang as $item)
            <li class="produk-item" data-category="{{ $item->category }}">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}">
                <h2>{{ $item->nama }}</h2>

                <p>Stok : {{ $item->stok }}</p>
                <p>Harga : Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>

                <button class="add-to-cart" data-product="{{ $item->nama }}" data-price="{{ $item->harga }}">Tambahkan ke Keranjang</button>
                <button class="buy-now" data-product="{{ $item->nama }}" data-price="{{ $item->harga }}">Beli Sekarang</button>
            </li>
        @endforeach
    </ul>

    <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const product = button.getAttribute('data-product');
                const price = button.getAttribute('data-price');
                // Simpan informasi produk ke dalam keranjang belanja
                const cartItem = { product: product, price: price };
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart.push(cartItem);
                localStorage.setItem('cart', JSON.stringify(cart));
                // Tampilkan alert bahwa produk telah ditambahkan ke keranjang
                alert('Produk berhasil ditambahkan ke keranjang!');
                // Redirect ke halaman keranjang
                window.location.href = "{{ route('keranjang.index') }}";
            });
        });
    </script>
@endsection
