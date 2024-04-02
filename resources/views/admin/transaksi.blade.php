@extends('mainlayout')

@section('maincontent')
    <h2>Data Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Total</th>
                <th>Keterangan Diskon</th>
            </tr>
        </thead>
        <tbody>
            <?php $grandTotal = 0; $totalQuantity = 0; $totalHarga = 0; ?> <!-- Inisialisasi variabel grandTotal, totalQuantity, dan totalHarga -->
            @foreach ($transaksi as $index => $item)
                <?php
                    $subtotal = $item->total_amount; // Total sebelum diskon
                    if ($item->diskon) {
                        $diskon = $item->diskon->besar_diskon / 100; // Konversi diskon menjadi desimal
                        $subtotal -= $subtotal * $diskon; // Kurangi subtotal dengan diskon
                    }
                    $grandTotal += $subtotal; // Tambahkan subtotal ke grandTotal
                    $totalQuantity += $item->quantity; // Tambahkan jumlah item ke totalQuantity
                    $totalHarga += $item->barang->harga * $item->quantity; // Tambahkan harga barang * jumlah ke totalHarga
                ?>
                <tr>
                    <td style="width: 45px;">{{ $index + 1 }}</td>
                    <td>{{ $item->barang->nama }}</td>
                    <td>Rp. {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->diskon ? $item->diskon->besar_diskon . '%' : '-' }}</td>
                    <td>Rp. {{ number_format($subtotal, 0, ',', '.') }}</td> <!-- Tampilkan subtotal setelah diskon -->
                    <td>{{ $item->diskon ? $item->diskon->nama : '-' }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">Jumlah Keseluruhan</td>
                <td>{{ $totalQuantity }}</td> <!-- Tampilkan totalQuantity -->
                <td></td>
                <td><strong>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</strong></td> <!-- Tampilkan grandTotal -->
                <td></td>
            </tr>
        </tbody>
    </table>
@endsection
