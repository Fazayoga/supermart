@extends('mainlayout')

@section('maincontent')
    <div class="kotak">
        <div class="left-column">
            <h2>Kasir</h2>
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
            <form id="checkout-form" action="{{ route('kasir.checkout') }}" method="POST">
                @csrf
                <ul id="cart-items"></ul>
                <div id="cart-total">
                    <div id="left-total"></div>
                    <div id="center-total"></div>
                    <div id="right-total"></div>
                </div>
                <div id="diskon-container">
                    <label for="diskon">Diskon (%):</label>
                    <select id="diskon">
                        <option value="">Pilih Diskon</option>
                        @foreach($diskon as $discount)
                            <option value="{{ $discount->besar_diskon }}">{{ $discount->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <p>Total: Rp. <span id="total">0.00</span></p>
                <button type="button" id="checkout-btn" class="checkout">Checkout</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#checkout-btn').click(function(){
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
    
                var diskonValue = parseFloat($('#diskon').val());
    
                $.ajax({
                    type: "POST",
                    url: "{{ route('kasir.checkout') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "cartData": cartData,
                        "diskon": diskonValue
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