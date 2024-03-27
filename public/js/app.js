document.addEventListener('DOMContentLoaded', function () {
    // Daftar produk
    const products = document.querySelectorAll('.product');

    // Keranjang belanja
    const cartItems = document.getElementById('cart-items');
    const totalElement = document.getElementById('total');
    const diskonSelect = document.getElementById('diskon');
    let cartTotal = 0;

    // Tambahkan event listener untuk setiap produk
    products.forEach(product => {
        product.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const productName = this.querySelector('h2').textContent.trim();
            const productPrice = parseFloat(this.getAttribute('data-harga'));

            // Menggunakan prompt untuk meminta pengguna memasukkan jumlah produk
            let quantityInput = prompt(`Masukkan jumlah ${productName}:`);
            // Konversi input pengguna ke dalam integer
            let quantity = parseInt(quantityInput);
            // Pastikan input adalah angka yang valid dan lebih dari 0
            if (!isNaN(quantity) && quantity > 0) {
                // Cek apakah produk sudah ada di keranjang
                const existingItem = Array.from(cartItems.children).find(item =>
                    item.getAttribute('data-id') === productId
                );

                if (existingItem) {
                    // Jika produk sudah ada, tambahkan jumlahnya sesuai input pengguna
                    const quantityElement = existingItem.querySelector('.quantity');
                    quantity += parseInt(quantityElement.textContent);
                    quantityElement.textContent = quantity;
                } else {
                    // Jika produk belum ada, tambahkan sebagai item baru
                    const listItem = document.createElement('li');
                    listItem.setAttribute('data-id', productId);
                    listItem.setAttribute('data-harga', productPrice); // tambahkan atribut harga
                    listItem.textContent = `${productName}`;

                    // Tambahkan harga produk
                    const priceElement = document.createElement('div');
                    priceElement.classList.add('harga');
                    priceElement.textContent = `Rp. ${productPrice.toFixed(2)}`;
                    listItem.appendChild(priceElement);

                    // Tambahkan jumlah produk
                    const quantityElement = document.createElement('span');
                    quantityElement.classList.add('quantity');
                    quantityElement.textContent = quantity;
                    listItem.appendChild(quantityElement);

                    cartItems.appendChild(listItem);

                    // Tambahkan tombol hapus
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Hapus';
                    deleteButton.addEventListener('click', function () {
                        listItem.remove();
                        updateTotal();
                        updateTotalWithDiskon(); // Perbarui total dengan diskon setelah menghapus item
                    });
                    listItem.appendChild(deleteButton);

                    // Tambahkan tombol kurangi
                    const decreaseButton = document.createElement('button');
                    decreaseButton.textContent = 'Kurangi';
                    decreaseButton.addEventListener('click', function (event) {
                        event.preventDefault();
                        const quantityElement = listItem.querySelector('.quantity');
                        let quantity = parseInt(quantityElement.textContent);
                        if (quantity > 1) {
                            quantity -= 1;
                            quantityElement.textContent = quantity;
                            updateTotal();
                            updateTotalWithDiskon(); // Perbarui total dengan diskon setelah mengurangi item
                        } else {
                            listItem.remove();
                            updateTotal();
                            updateTotalWithDiskon(); // Perbarui total dengan diskon setelah mengurangi item
                        }
                    });
                    listItem.appendChild(decreaseButton);
                }

                // Perbarui total
                cartTotal += productPrice * quantity;
                totalElement.textContent = cartTotal.toFixed(2);
                updateTotalWithDiskon(); // Perbarui total dengan diskon setelah menambahkan item
            } else {
                alert('Jumlah barang tidak valid. Masukkan angka yang lebih besar dari 0.');
            }
        });
    });

    // Fungsi untuk memperbarui total setelah menghapus atau mengurangi item
    function updateTotal() {
        cartTotal = Array.from(cartItems.children).reduce((total, item) => {
            const price = parseFloat(item.getAttribute('data-harga'));
            const quantity = parseInt(item.querySelector('.quantity').textContent);
            return total + (price * quantity);
        }, 0);
        totalElement.textContent = cartTotal.toFixed(2);
    }

    // Fungsi untuk memperbarui total dengan diskon
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
