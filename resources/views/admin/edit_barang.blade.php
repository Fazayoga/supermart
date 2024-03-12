@extends('mainlayout')

@section('maincontent')
    <div class="container">
        <h2>Edit Barang</h2>
        <form action="{{ route('barang.update', ['id' => $barang->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar">
                <!-- Tampilkan gambar saat ini -->
                <img src="{{ asset($barang->gambar) }}" alt="Gambar Barang" class="current-image">
            </div>

            <div class="form-group">
                <label for="nama">Nama Barang:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $barang->category }}" required>
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" value="{{ $barang->stok }}" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ $barang->harga }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_exp">Tanggal Exp:</label>
                <input type="date" class="form-control" id="tanggal_exp" name="tanggal_exp" value="{{ $barang->tanggal_exp }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
