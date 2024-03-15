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
        // Ambil data pembelian dari request
        $cartData = $request->input('cartData');

        if (!empty($cartData)) {
            try {
                // Simpan data transaksi ke dalam database
                foreach ($cartData as $item) {
                    // Gunakan metode create untuk membuat dan menyimpan data
                    Transaksi::create([
                        'barang_id' => $item['barang_id'],
                        'nama_produk' => $item['nama_produk'],
                        'harga' => $item['harga'],
                        'jumlah_produk' => $item['jumlah_produk'],
                    ]);
                }

                // Redirect kembali ke halaman kasir setelah checkout
                return redirect()->route('kasir.index')->with('success', 'Transaction successful');
            } catch (\Exception $e) {
                // Tangani jika terjadi kesalahan saat menyimpan data
                Log::error($e->getMessage()); // Catat pesan kesalahan dalam log
                return back()->with('error', 'Failed to save transaction data');
            }
        } else {
            return back()->with('error', 'No items in the cart');
        }
    }
}
