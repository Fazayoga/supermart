<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAMTQ Supermart</title>
    <link rel="icon" type="img/x-icon" href="{{ asset('logo.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
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
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('kasir.index') }}">Kasir</a></li>
                        <li><a href="{{ route('barang.index') }}">Data Barang</a></li>
                        <li><a href="{{ route('transaksi.index') }}">Data Transaksi</a></li>
                        <li><a href="{{ route('member') }}">Data Member</a></li>
                        <li><a href="{{ route('barangexp.index') }}">Data Barang Exp</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </ul>
            </nav>
        </div>
    </header>