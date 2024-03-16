document.addEventListener('DOMContentLoaded', function () {
    const products = document.querySelectorAll('.product');
    
    products.forEach(product => {
        const expirationDate = new Date(product.getAttribute('data-expiration'));
        const currentDate = new Date();
        
        // Jika tanggal kadaluarsa sudah terlewati, sembunyikan barang
        if (currentDate > expirationDate) {
            product.style.display = 'none';
        }
    });
});
