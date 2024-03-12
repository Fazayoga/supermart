<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAMTQ Supermart</title>
    <link rel="icon" type="img/x-icon" href="{{ asset('logo.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</head>
<body>
    <header>
        <div class="left-section">
            <img src="{{ asset('img/mamtq.png') }}" alt="MAMTQ">
        </div>
        <div class="right-section">
            <div class="search-container">
                <h3>Membership</h3>
                <div class="button-container">
                    <input type="text" placeholder="Cari...">
                    <button>Cari</button>
                </div>
            </div>
            <nav>
                <ul>
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <div class="category-dropdown">
                            <a href="#">Category</a>
                            <div class="category-dropdown-content">
                                <a href="#" class="filter-category" data-category="Makanan">Makanan</a>
                                <a href="#" class="filter-category" data-category="Minuman">Minuman</a>
                                <a href="#" class="filter-category" data-category="Sabun">Sabun</a>
                                <a href="#" class="filter-category" data-category="Sampo">Sampo</a>
                            </div>
                        </div>
                        <li><a href="">Cek Point</a></li>
                        <li><a href="">Keranjang</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </ul>
            </nav>
        </div>
    </header>