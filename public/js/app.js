document.addEventListener('DOMContentLoaded', function () {
    // Daftar produk
    const products = document.querySelectorAll('.product');

    // Keranjang belanja
    const cartItems = document.getElementById('cart-items');
    const totalElement = document.getElementById('total');
    const diskonSelect = document.getElementById('diskon');
    const pointElement = document.getElementById('point'); // Tambahkan elemen untuk menampilkan point
    const memberSelect = document.getElementById('member'); // Tambahkan elemen untuk memilih member

    let cartTotal = 0;

    // Tambahkan variabel untuk menyimpan total point member
    let totalPoint = 0;

    // Fungsi untuk menghitung total point
    function calculatePoint(total) {
        // Jika total pembelian mencapai 15.000, member mendapatkan 150 point
        if (total >= 10000 && total < 20000) {
            return Math.floor(total / 100); // Pembagian total pembelian dengan 100
        } 
        // Jika total pembelian mencapai 20.000, member mendapatkan 200 point
        else if (total >= 20000) {
            return Math.floor(total / 100); // Pembagian total pembelian dengan 100
        } 
        // Jika tidak mencapai syarat pembelian, tidak mendapatkan point
        else {
            return 0;
        }
    }

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
                        updatePoint();
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
                            updatePoint();
                        } else {
                            listItem.remove();
                            updateTotal();
                            updateTotalWithDiskon(); // Perbarui total dengan diskon setelah mengurangi item
                            updatePoint();
                        }
                    });
                    listItem.appendChild(decreaseButton);
                }

                // Perbarui total
                cartTotal += productPrice * quantity;
                totalElement.textContent = cartTotal.toFixed(2);

                // Perbarui total point jika member dipilih
                if (memberSelect.value) {
                    totalPoint = calculatePoint(cartTotal);
                    pointElement.textContent = totalPoint; // Tampilkan total point
                }
                updateTotal();
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
    
    diskonSelect.addEventListener('change', function () {
        updateTotalWithDiskon(); // Perbarui total dengan diskon saat opsi diskon berubah
        if (memberSelect.value) {
            updatePoint(); // Perbarui total point saat diskon berubah jika member dipilih
        }
    });
    
    // Fungsi untuk memperbarui total dengan diskon
    function updateTotalWithDiskon() {
        var subtotal = parseFloat(cartTotal); // Mengambil total sebelum diskon
        var diskonValue = parseFloat($('#diskon option:selected').data('besar-diskon'));

        if (!isNaN(diskonValue)) {
            var totalWithDiscount = subtotal - (subtotal * (diskonValue / 100));
            totalElement.textContent = totalWithDiscount.toFixed(2);
        } else {
            totalElement.textContent = subtotal.toFixed(2);
        }
    }

    // Fungsi untuk menghitung total point dan menampilkan poin saat memilih atau mengubah member
    function updatePoint() {
        // Perbarui total point saat memilih member
        var subtotal = parseFloat(totalElement.textContent); // Mengambil total setelah diskon
        totalPoint = calculatePoint(subtotal);
        pointElement.textContent = totalPoint; // Tampilkan total point
    }

        
    // Tambahkan event listener untuk perubahan pemilihan member
    memberSelect.addEventListener('change', function () {
        if (memberSelect.value) {
            updatePoint(); // Perbarui total point saat memilih member
        } else {
            pointElement.textContent = '0'; // Set point menjadi 0 jika member tidak dipilih
        }
        updateTotalWithDiskon(); // Perbarui total dengan diskon saat memilih atau mengubah member
    });

    // Panggil fungsi updatePoint saat memuat halaman untuk menampilkan nilai poin awal
    updatePoint();

    // Ambil elemen tombol menu dan daftar menu
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.querySelector('nav ul');

    // Tambahkan event listener untuk tombol menu
    menuToggle.addEventListener('click', function () {
        // Toggle class 'active' pada daftar menu untuk menampilkan atau menyembunyikan daftar menu
        navMenu.classList.toggle('active');
    });
});