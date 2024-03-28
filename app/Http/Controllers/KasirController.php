<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Diskon;

class KasirController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $diskon = Diskon::all();

        return view('admin.kasir', compact('barang', 'diskon'));
    }
    
    public function checkout(Request $request)
    {
        $cartItems = $request->cartData;
        $diskonValue = $request->diskon;
        $totalAmount = 0;
        
        // Menghitung total belanja sebelum diskon
        foreach ($cartItems as $item) {
            $barang = Barang::find($item['barang_id']);
            $totalAmount += $barang->harga * $item['jumlah_produk'];
        }
        
        // Menghitung total belanja setelah diskon
        $totalWithDiskon = $totalAmount;
        if ($diskonValue) {
            $totalWithDiskon = $totalAmount - ($totalAmount * ($diskonValue / 100));
        }
        
        // Proses checkout dan simpan transaksi
        foreach ($cartItems as $item) {
            $barang = Barang::find($item['barang_id']);
            if ($barang->stok >= $item['jumlah_produk']) {
                $barang->stok -= $item['jumlah_produk'];
                $barang->save();
                // Simpan transaksi dengan total yang sudah dihitung dengan diskon
                $totalItem = $barang->harga * $item['jumlah_produk'];
                $diskonItem = $diskonValue ? $totalItem * ($diskonValue / 100) : 0;
                $totalItemWithDiskon = $totalItem - $diskonItem;
                Transaksi::create([
                    'barang_id' => $barang->id,
                    'nama_barang' => $barang->nama,
                    'harga' => $barang->harga,
                    'quantity' => $item['jumlah_produk'],
                    'total_amount' => $totalItem,
                    'diskon_id' => $diskonValue, 
                    'total_with_diskon' => $totalItemWithDiskon
                ]);
            } else {
                return response()->json(['error' => 'Stok barang ' . $barang->nama . ' tidak mencukupi.']);
            }
        }
        
        return response()->json(['success' => 'Checkout berhasil.']);
    }

    public function pembelian()
    {
        $transaksi = Transaksi::with('barang', 'diskon')->get();

        return view('admin.transaksi', ['transaksi' => $transaksi]);
    }
}
