<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangExp extends Model
{
    use HasFactory;

    protected $table = 'barang_exp';

    protected $fillable = [
        'gambar',
        'nama',
        'category',
        'stok',
        'harga',
        'tanggal_exp',
    ];
}
