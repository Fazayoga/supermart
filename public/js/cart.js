// public/js/cart.js

document.addEventListener('DOMContentLoaded', function () {
    // Ambil semua tombol "Tambahkan ke Keranjang" dan "Beli Sekarang"
    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    var buyNowButtons = document.querySelectorAll('.buy-now');

    // Tambahkan event listener untuk setiap tombol
    addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            addToCart(button);
        });
    });

    buyNowButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            buyNow(button);
        });
    });

    // Fungsi untuk menambahkan produk ke keranjang
    function addToCart(button) {
        var product = button.dataset.product;
        var price = button.dataset.price;

        // Implementasikan logika penambahan ke keranjang di sini
        console.log('Tambahkan ke keranjang:', product, 'Harga:', price);
    }

    // Fungsi untuk langsung membeli produk
    function buyNow(button) {
        var product = button.dataset.product;
        var price = button.dataset.price;

        // Implementasikan logika pembelian di sini
        console.log('Beli Sekarang:', product, 'Harga:', price);
    }
});
