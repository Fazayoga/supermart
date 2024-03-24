<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('admin.transaksi', ['transaksi' => $transaksi]);
    }

    public function simpanPembelian(Request $request)
    {
        // Validasi data jika diperlukan
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_produk' => 'required|string',
            'harga' => 'required|numeric',
            'jumlah_produk' => 'required|integer',
            // sesuaikan dengan kolom-kolom yang ada di tabel pembelian
        ]);

        // Simpan data pembelian
        Transaksi::create([
            'barang_id' => $validatedData['barang_id'],
            'nama_produk' => $validatedData['nama_produk'],
            'harga' => $validatedData['harga'],
            'jumlah_produk' => $validatedData['jumlah_produk'],
            // sesuaikan dengan kolom-kolom yang ada di tabel pembelian
        ]);

        return response()->json(['message' => 'Data pembelian berhasil disimpan']);
    }
}
