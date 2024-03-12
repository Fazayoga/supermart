@extends('mainlayout')

@section('maincontent')
    <div class="container">
        <h2>Create Barang</h2>
        <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar">
            </div>

            <div class="form-group">
                <label for="nama">Nama Barang:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>

            <div class="form-group">
                <label for="tanggal_exp">Tanggal Exp:</label>
                <input type="date" class="form-control" id="tanggal_exp" name="tanggal_exp" required>
            </div>            

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
