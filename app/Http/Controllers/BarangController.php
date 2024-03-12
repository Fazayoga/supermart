<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        return view('admin.barang', ['barang' => $barang]);
    }

    public function create()
    {
        return view('admin.create_barang');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'tanggal_exp' => 'required|date_format:Y-m-d',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);

            // Simpan data ke database
            Barang::create([
                'gambar' => 'images/' . $imageName,
                'nama' => $request->nama,
                'category' => $request->category,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'tanggal_exp' => $request->tanggal_exp,
            ]);

            // Redirect or respond as needed
            return redirect()->route('barang.index')->with('success', 'Barang berhasil disimpan.');
        }

        return redirect()->back()->with('error', 'Gambar wajib diunggah.');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);

        return view('admin.edit_barang', ['barang' => $barang]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'tanggal_exp' => 'required|date_format:Y-m-d',
        ]);
    
        // Update data barang
        $barang = Barang::find($id);
    
        // Cek ketersediaan gambar lama sebelum mencoba menghapusnya
        if ($barang->gambar) {
            Storage::delete($barang->gambar); // Menghapus gambar lama dari penyimpanan
        }
    
        // Menghapus gambar lama jika ada gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $barang->gambar = 'images/' . $imageName; // Menyimpan path gambar baru
        }
    
        // Update data lainnya
        $barang->update([
            'gambar' => 'images/' . $imageName,
            'nama' => $request->input('nama'),
            'category' => $request->input('category'),
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
            'tanggal_exp' => $request->input('tanggal_exp'),
        ]);
    
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Temukan data barang
        $barang = Barang::find($id);

        // Periksa apakah barang ditemukan sebelum menghapus
        if ($barang) {
            // Menghapus file gambar dari penyimpanan
            Storage::delete($barang->gambar);

            // Menghapus record barang dari database
            $barang->delete();

            return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
        } else {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan');
        }
    }

    public function checkAndMoveExpired()
    {
        $expiredBarang = Barang::where('tanggal_exp', '<', now())->get();

        foreach ($expiredBarang as $barang) {
            // Lakukan sesuatu di sini, misalnya, pindahkan ke halaman barang_exp.blade.php
            // Tambahkan log atau perubahan status atau lakukan sesuatu sesuai kebutuhan aplikasi Anda
            $barang->update(['expired' => true]); // Tambahkan kolom 'expired' di tabel barang
        }

        return view('barang_exp', ['expiredBarang' => $expiredBarang]);
    }
}