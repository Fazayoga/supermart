@extends('mainlayout')

@section('maincontent')
    <div class="container">
        <form action="{{ route('kasir.checkout') }}" method="post">
            @csrf
            <ul class="produk-list">
                @foreach($barang as $item)
                    <div class="produk-item">
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}">
                        <h3>{{ $item->nama }}</h3>
                        <p>Stok: {{ $item->stok }}</p>
                        <input type="hidden" name="barang_id[]" value="{{ $item->id }}">
                        <input type="number" name="quantity[]" value="0" min="0">
                    </div>
                @endforeach
            </ul>

            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
    </div>
@endsection
