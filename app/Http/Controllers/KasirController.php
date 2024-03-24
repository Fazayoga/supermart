<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;

class KasirController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        return view('admin.kasir', ['barang' => $barang]);
    }
    
    public function checkout(Request $request)
    {
        $request->validate([
            'barang_id.*' => 'required|exists:barangs,id',
            'nama_produk.*' => 'required|string',
            'harga.*' => 'required|numeric',
            'jumlah_produk.*' => 'required|integer',
        ]);

        try {
            // Proses transaksi
            foreach ($request->barang_id as $key => $barangId) {
                $barang = Barang::find($barangId);

                // Lakukan validasi stok
                if ($barang->stok >= $request->jumlah_produk[$key]) {
                    // Lakukan sesuatu dengan transaksi, misalnya, simpan ke database
                    $transaksi = new Transaksi;
                    $transaksi->barang_id = $barangId;
                    $transaksi->nama_produk = $request->nama_produk[$key];
                    $transaksi->harga = $request->harga[$key];
                    $transaksi->jumlah_produk = $request->jumlah_produk[$key];
                    $transaksi->save();

                    // Kurangi stok barang
                    $barang->stok -= $request->jumlah_produk[$key];
                    $barang->save();
                } else {
                    // Stok tidak mencukupi
                    return redirect()->route('kasir.index')->with('error', 'Stok barang tidak mencukupi untuk ' . $barang->nama);
                }
            }

            return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            Log::error($e->getMessage());
            return redirect()->route('kasir.index')->with('error', 'Gagal melakukan checkout');
        }
    }

    public function pembelian()
    {
        // Mengambil semua transaksi beserta data barang terkait
        $transaksi = Transaksi::with('barang')->get();

        // Kembalikan view dengan data transaksi
        return view('admin.pembelian', ['transaksi' => $transaksi]);
    }

}
