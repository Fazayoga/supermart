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
                <input type="submit" id="checkout-btn" class="checkout" value="Checkout">
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#checkout-form').submit(function(e){
                e.preventDefault(); // Mencegah pengiriman formulir secara default
    
                // Mengambil data pembelian dari formulir
                var cartData = [];
                $('.produk-item').each(function(){
                    var productId = $(this).data('id');
                    var productName = $(this).find('h2').text();
                    var price = $(this).data('harga');
                    var quantity = 1; // Misalnya, kita hanya mendukung jumlah produk 1 pada saat ini
    
                    var item = {
                        'barang_id': productId,
                        'nama_produk': productName,
                        'harga': price,
                        'jumlah_produk': quantity
                    };
    
                    cartData.push(item);
                });
    
                // Mengirim data pembelian ke controller Laravel melalui AJAX
                $.ajax({
                    type: "POST",
                    url: "{{ route('kasir.checkout') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "cartData": cartData
                    },
                    success: function(response){
                        // Handle kesuksesan, misalnya, tampilkan pesan sukses dan muat ulang halaman
                        alert("Transaksi berhasil!");
                        window.location.reload();
                    },
                    error: function(xhr, status, error){
                        // Handle kesalahan, misalnya, tampilkan pesan kesalahan
                        alert("Gagal melakukan checkout: " + error);
                    }
                });
            });
        });
    </script>
@endsection
