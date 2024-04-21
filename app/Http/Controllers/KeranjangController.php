<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;

class KeranjangController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validasi input
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:barang,id',
        ]);

        // Dapatkan data barang dari database
        $barang = Barang::findOrFail($request->product_id);

        // Simpan barang ke keranjang
        $keranjang = new Keranjang();
        $keranjang->user_id = $request->users_id;
        $keranjang->nama_produk = $barang->nama;
        $keranjang->harga = $barang->harga;
        $keranjang->save();

        return response()->json(['success' => 'Barang berhasil ditambahkan ke keranjang.']);
    }

    public function viewCart(Request $request)
    {
        // Dapatkan semua barang dalam keranjang untuk user tertentu
        $user_id = $request->user()->id;
        $keranjang = Keranjang::where('users_id', $user_id)->get();

        return view('user.keranjang', ['keranjang' => $keranjang]);
    }

    public function removeFromCart(Request $request, $id)
    {
        // Cari barang dalam keranjang berdasarkan ID
        $cartItem = Keranjang::findOrFail($id);

        // Hapus barang dari keranjang
        $cartItem->delete();

        return redirect()->route('user.keranjang')->with('success', 'Barang berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        // Dapatkan semua barang dalam keranjang untuk user tertentu
        $user_id = $request->user()->id;
        $keranjang = Keranjang::where('users_id', $user_id)->get();

        // Proses checkout dan simpan transaksi
        foreach ($keranjang as $item) {
            Transaksi::create([
                'user_id' => $user_id,
                'nama_produk' => $item->nama_produk,
                'harga' => $item->harga,
                // Tambahkan kolom lain sesuai kebutuhan transaksi
            ]);

            // Hapus item dari keranjang setelah checkout
            $item->delete();
        }

        return redirect()->route('user.keranjang')->with('success', 'Checkout berhasil.');
    }
}
