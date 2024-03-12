<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'gambar',
        'nama',
        'category',
        'stok',
        'harga',
        'tanggal_exp',
    ];
    
}
