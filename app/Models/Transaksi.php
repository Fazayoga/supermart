<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['barang_id', 'diskon_id', 'quantity', 'total_amount'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id');
    }
}