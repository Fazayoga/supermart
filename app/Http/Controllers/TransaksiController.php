<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Member; 
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('diskon', 'member')->get();
        $members = Member::all();
        return view('admin.transaksi', compact('transaksi', 'members'));
    }

    public function simpanPembelian(Request $request)
    {
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_produk' => 'required|string',
            'harga' => 'required|numeric',
            'jumlah_produk' => 'required|integer',
            'member_id' => 'nullable|exists:members,id',
            'diskon' => 'nullable|numeric',
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
            'member_id' => $validatedData['member_id'],
        ]);

        // Hitung poin yang diperoleh berdasarkan total pembelian
        $earnedPoints = floor($totalAmount / 100); // Misalnya, setiap pembelian Rp. 100 mendapatkan 1 poin

        // Update poin member
        $member = Member::find($validatedData['member_id']);
        $member->point += $earnedPoints;
        $member->save();

        return response()->json(['message' => 'Data pembelian berhasil disimpan']);
    }

    public function download($tanggal)
    {
        // Mendapatkan data transaksi berdasarkan tanggal
        $transaksi = Transaksi::whereDate('transaction_date', $tanggal)->get();

        // Menghasilkan nama file
        $fileName = 'transaksi_' . $tanggal . '.csv';

        // Membuka file untuk menulis
        $file = fopen(storage_path('app/' . $fileName), 'w');

        // Menulis header pada file CSV
        fputcsv($file, ['No', 'Nama Barang', 'Jumlah', 'Harga', 'Harga Normal', 'Diskon', 'Harga Total', 'Keterangan Diskon']);

        // Menulis data transaksi ke dalam file CSV
        foreach ($transaksi as $index => $item) {
            $rowData = [
                $index + 1,
                $item->barang->nama,
                $item->quantity,
                $item->barang->harga,
                $item->barang->harga * $item->quantity,
                $item->diskon ? $item->diskon->besar_diskon . '%' : '-',
                $item->total_amount,
                $item->diskon ? $item->diskon->nama : '-',
            ];
            fputcsv($file, $rowData);
        }

        // Menutup file
        fclose($file);

        // Mengembalikan file CSV sebagai respons untuk diunduh
        return Response::download(storage_path('app/' . $fileName), $fileName)->deleteFileAfterSend(true);
    }
}
