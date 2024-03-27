<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('diskon')->get();

        return view('admin.transaksi', compact('transaksi'));
    }

    public function simpanPembelian(Request $request)
    {
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_produk' => 'required|string',
            'harga' => 'required|numeric',
            'jumlah_produk' => 'required|integer',
        ]);
    
        // Ambil nilai diskon dari request
        $diskonValue = $request->diskon;
    
        // Hitung total_amount dengan mengalikan harga dengan jumlah_produk
        $totalAmount = $validatedData['harga'] * $validatedData['jumlah_produk'];
    
        // Jika diskon diberikan, hitung total_amount setelah diskon
        if (!is_null($diskonValue)) {
            $diskonAmount = $totalAmount * ($diskonValue / 100);
            $totalAmount -= $diskonAmount;
        }
    
        // Simpan transaksi ke database
        Transaksi::create([
            'barang_id' => $validatedData['barang_id'],
            'nama_produk' => $validatedData['nama_produk'],
            'harga' => $validatedData['harga'],
            'quantity' => $validatedData['jumlah_produk'],
            'total_amount' => $totalAmount, // Simpan total_amount
            'diskon_id' => $diskonValue, // Simpan nilai diskon
        ]);
    
        return response()->json(['message' => 'Data pembelian berhasil disimpan']);
    }    
}
