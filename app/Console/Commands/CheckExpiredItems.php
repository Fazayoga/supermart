<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Barang;
use App\Models\BarangExp;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CheckExpiredItems extends Command
{
    protected $signature = 'check:expired-items';

    protected $description = 'Check and move expired items to barang_exp table';

    public function handle()
    {
        // Get expired items
        $expiredItems = Barang::whereDate('tanggal_exp', '<', now())->get();

        // Move expired items to barang_exp
        foreach ($expiredItems as $item) {
            // Move image if exists
            if ($item->gambar) {
                // Generate new path for the image in barang_exp folder
                $newImagePath = 'barang_exp/' . basename($item->gambar);

                // Copy the image to barang_exp folder
                Storage::copy($item->gambar, $newImagePath);
            }

            // Create new record in barang_exp table
            BarangExp::create([
                'gambar' => isset($newImagePath) ? $newImagePath : null,
                'nama' => $item->nama,
                'category' => $item->category,
                'stok' => $item->stok,
                'harga' => $item->harga,
                'tanggal_exp' => $item->tanggal_exp,
            ]);

            // Delete the item from barang table
            $item->delete();
        }

        // Display success message
        $this->info(count($expiredItems) . ' expired items checked and moved successfully.');
    }
}
