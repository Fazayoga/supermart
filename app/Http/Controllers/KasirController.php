<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;

class KasirController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        return view('admin.kasir', ['barang' => $barang]);
    }

    public function checkout(Request $request)
    {
        // Validasi input sesuai kebutuhan Anda
        $request->validate([
            'stok.*' => 'required|integer|min:0',
        ]);

        // Proses transaksi
        foreach ($request->stok as $barangId => $quantity) {
            $barang = Barang::find($barangId);

            // Lakukan validasi stok
            if ($barang && $barang->stok >= $quantity) {
                // Lakukan sesuatu dengan transaksi, misalnya, simpan ke database
                $transaksi = new Transaksi;
                $transaksi->barang_id = $barangId;
                $transaksi->jumlah_keluar = $quantity;
                $transaksi->save();

                // Kurangi stok barang
                $barang->stok -= $quantity;
                $barang->save();
            } else {
                // Stok tidak mencukupi, berikan notifikasi atau tangani sesuai kebutuhan
                return redirect()->route('kasir.index')->with('error', 'Stok barang tidak mencukupi untuk ' . $barang->nama);
            }
        }

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil!');
    }
}
