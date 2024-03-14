document.addEventListener('DOMContentLoaded', function () {
    // Daftar produk
    const products = document.querySelectorAll('.product');

    // Keranjang belanja
    const cartItems = document.getElementById('cart-items');
    const totalElement = document.getElementById('total');
    let cartTotal = 0;

    // Tambahkan event listener untuk setiap produk
    products.forEach(product => {
        product.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const productName = this.querySelector('h2').textContent.trim();
            const productPrice = parseFloat(this.getAttribute('data-harga'));

            // Cek apakah produk sudah ada di keranjang
            const existingItem = Array.from(cartItems.children).find(item =>
                item.getAttribute('data-id') === productId
            );

            if (existingItem) {
                // Jika produk sudah ada, tambahkan jumlahnya
                const quantityElement = existingItem.querySelector('.quantity');
                const quantity = parseInt(quantityElement.textContent) + 1;
                quantityElement.textContent = quantity;
            } else {
                // Jika produk belum ada, tambahkan sebagai item baru
                const listItem = document.createElement('li');
                listItem.setAttribute('data-id', productId);
                listItem.setAttribute('data-harga', productPrice); // tambahkan atribut harga
                listItem.textContent = `${productName}`;

                // Tambahkan harga produk
                const priceElement = document.createElement('div');
                priceElement.classList.add('data-harga');
                priceElement.textContent = `Rp. ${productPrice.toFixed(2)}`;
                listItem.appendChild(priceElement);
                
                // Tambahkan jumlah produk
                const quantityElement = document.createElement('span');
                quantityElement.classList.add('quantity');
                quantityElement.textContent = '1';
                listItem.appendChild(quantityElement);

                cartItems.appendChild(listItem);

                // Tambahkan tombol hapus
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Hapus';
                deleteButton.addEventListener('click', function () {
                    listItem.remove();
                    updateTotal();
                });
                listItem.appendChild(deleteButton);
                
                // Tambahkan tombol kurangi
                const decreaseButton = document.createElement('button');
                decreaseButton.textContent = 'Kurangi';
                decreaseButton.addEventListener('click', function () {
                    const quantityElement = listItem.querySelector('.quantity');
                    let quantity = parseInt(quantityElement.textContent);
                    if (quantity > 1) {
                        quantity -= 1;
                        quantityElement.textContent = quantity;
                        updateTotal();
                    } else {
                        listItem.remove();
                        updateTotal();
                    }
                });
                listItem.appendChild(decreaseButton);
            }

            // Perbarui total
            cartTotal += productPrice;
            totalElement.textContent = cartTotal.toFixed(2);
        });
    });

    // Checkout
    const checkoutBtn = document.getElementById('checkout-btn');
    checkoutBtn.addEventListener('click', function () {
        alert(`Total pembelian: Rp.${cartTotal.toFixed(2)}`);
        // Implementasikan proses checkout sesuai kebutuhan
        // Misalnya, kirim data pembelian ke server, atau tampilkan formulir pembayaran, dll.
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
});
