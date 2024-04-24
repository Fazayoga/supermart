@extends('mainlayout')

@section('maincontent')
    <h2>Data Transaksi</h2>

    @foreach ($transaksi->groupBy(function($date) {
        return \Carbon\Carbon::parse($date->transaction_date)->toDateString();
    }) as $tanggal => $itemsPerTanggal)
        <?php $grandTotal = 0; $totalQuantity = 0; $totalHarga = 0; ?>
        <h2>Tanggal Transaksi: {{ $tanggal }}</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Harga Normal</th>
                    <th>Diskon</th>
                    <th>Harga Total</th>
                    <th>Keterangan Diskon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itemsPerTanggal as $index => $item)
                    <?php
                        $subtotal = $item->total_amount;
                        if ($item->diskon) {
                            $diskon = $item->diskon->besar_diskon / 100;
                            $subtotal -= $subtotal * $diskon;
                        }
                        $grandTotal += $subtotal;
                        $totalQuantity += $item->quantity;
                        $totalHarga += $item->barang->harga * $item->quantity;
                    ?>
                    <tr>
                        <td style="width: 45px;">{{ $index + 1 }}</td>
                        <td style="width: 275px;">{{ $item->barang->nama }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp. {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($item->barang->harga * $item->quantity, 0, ',', '.') }}</td>
                        <td>{{ $item->diskon ? $item->diskon->besar_diskon . '%' : '-' }}</td>
                        <td>Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>{{ $item->diskon ? $item->diskon->nama : '-' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">Jumlah Total</td>
                    <td>{{ $totalQuantity }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br>
        <a href="{{ route('transaksi.download', ['tanggal' => $tanggal]) }}" class="btn btn-primary">Unduh Transaksi</a>
    @endforeach
@endsection
