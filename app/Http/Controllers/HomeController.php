<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class HomeController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        return view('user.home', ['barang' => $barang]);
    }
}
