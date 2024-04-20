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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <button id="menu-toggle">&#9776;</button>
            </div>
            <nav>
                <ul>
                    <ul>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('kasir.index') }}">Kasir</a></li>
                        <div class="category-dropdown">
                            <a href="#">Data Master</a>
                            <div class="category-dropdown-content">
                                    <a href="{{ route('diskon.index') }}">Data Diskon</a>
                                    <a href="{{ route('barang.index') }}">Data Barang</a>
                                    <a href="{{ route('transaksi.index') }}">Data Transaksi</a>
                                    <a href="{{ route('member.index') }}">Data Member</a>
                                    <a href="{{ route('barangexp.index') }}">Data Barang Exp</a>
                            </div>
                        </div>
                        <li><a href="{{ route('admin.profil') }}">Profil</a></li>
                        @auth('admin')
                            <!-- Tampilan untuk pengguna yang sudah login -->
                            <li>
                                <form method="POST" action="{{ route('logout-admin') }}">
                                    @csrf
                                    <button class="submit" type="submit">Logout</button>
                                </form>
                            </li>
                        @else
                            <!-- Tampilan untuk pengguna yang belum login -->
                            <li><a href="{{ asset('login-admin') }}">Login</a></li>
                        @endauth
                    </ul>
                </ul>
            </nav>
        </div>
    </header>