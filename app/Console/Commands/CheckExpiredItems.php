<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Barang;
use App\Models\BarangExp;

class CheckExpiredItems extends Command
{
    protected $signature = 'check:expired-items';

    protected $description = 'Check and move expired items to barang_exp table';

    public function handle()
    {
        // Mendapatkan barang yang sudah expired
        $barang_exp = Barang::whereDate('tanggal_exp', '<', now())->get();

        // Memindahkan barang yang sudah expired ke barang_exp
        foreach ($barang_exp as $item) {
            BarangExp::create([
                'nama' => $item->nama,
                'category' => $item->category,
                'stok' => $item->stok,
                'harga' => $item->harga,
                'tanggal_exp' => $item->tanggal_exp,
            ]);

            $item->delete(); // Menghapus barang dari tabel barang
        }

        $this->info('Expired items checked and moved successfully.');
    }
}
