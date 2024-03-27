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
                    <select id="diskon" name="diskon"> <!-- Tambahkan name="diskon" di sini -->
                        <option value="">Tidak Ada Diskon</option>
                        @foreach($diskon as $discount)
                            <option value="{{ $discount->id }}">{{ $discount->nama }}</option> <!-- Ubah value menjadi ID diskon -->
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
            $('.produk-item').click(function(){
                var productId = $(this).data('id');
                var productName = $(this).find('h2').text();
                var price = $(this).data('harga');
                var quantity = 1; // Default quantity is 1

                var item = {
                    'barang_id': productId,
                    'nama_produk': productName,
                    'harga': price,
                    'jumlah_produk': quantity
                };

                var listItem = '<li data-id="' + productId + '" data-harga="' + price + '">' +
                                    '<div class="nama-produk">' + productName + '</div>' +
                                    '<div class="harga">Rp. ' + price.toFixed(2) + '</div>' +
                                    '<div class="quantity">' + quantity + '</div>' +
                                    '<div class="aksi"><button class="hapus">Hapus</button></div>' +
                                '</li>';
                $('#cart-items').append(listItem);
                updateTotal();
                updateTotalWithDiskon();
            });

            $(document).on('click', '.hapus', function(){
                $(this).closest('li').remove();
                updateTotal();
                updateTotalWithDiskon();
            });

            $('#diskon').change(function () {
                updateTotalWithDiskon();
            });

            $('#checkout-btn').click(function(){
                var cartData = [];
                $('#cart-items li').each(function(){
                    var productId = $(this).data('id');
                    var productName = $(this).find('.nama-produk').text();
                    var price = parseFloat($(this).data('harga'));
                    var quantity = parseInt($(this).find('.quantity').text());

                    var item = {
                        'barang_id': productId,
                        'nama_produk': productName,
                        'harga': price,
                        'jumlah_produk': quantity
                    };

                    cartData.push(item);
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('kasir.checkout') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "cartData": cartData,
                        "diskon": $('#diskon').val() 
                    },
                    success: function(response){
                        alert("Transaksi berhasil!");
                        window.location.reload();
                    },
                    error: function(xhr, status, error){
                        alert("Gagal melakukan checkout: " + error);
                    }
                });
            });

            function updateTotal() {
                var cartTotal = 0;
                $('#cart-items li').each(function(){
                    var price = parseFloat($(this).data('harga'));
                    var quantity = parseInt($(this).find('.quantity').text());
                    cartTotal += price * quantity;
                });
                $('#total').text(cartTotal.toFixed(2));
            }

            $('#diskon').change(function () {
                var diskonValue = parseFloat($(this).val()); // Ambil nilai diskon yang dipilih
                var subtotal = parseFloat($('#total').text()); // Ambil subtotal dari total belanja

                if (!isNaN(diskonValue)) { // Periksa apakah diskon dipilih
                    // Hitung total belanja setelah diskon
                    var totalWithDiscount = subtotal - (subtotal * (diskonValue / 100));

                    // Tampilkan total belanja setelah diskon
                    $('#total').text(totalWithDiscount.toFixed(2));
                } else {
                    // Jika diskon tidak dipilih, tampilkan total belanja tanpa diskon
                    $('#total').text(subtotal.toFixed(2));
                }
            });
        });
    </script>
@endsection
