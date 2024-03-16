<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangExp;
use Carbon\Carbon;

class BarangExpController extends Controller
{
    public function index()
    {
        // Mendapatkan barang yang sudah expired
        $barang_exp = BarangExp::whereDate('tanggal_exp', '<', Carbon::now())->get();

        return view('admin.barang_exp', ['barang_exp' => $barang_exp]);
    }
}
