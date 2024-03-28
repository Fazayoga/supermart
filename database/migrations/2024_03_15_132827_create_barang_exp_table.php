<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_exp', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('nama'); 
            $table->string('category')->nullable();
            $table->integer('stok')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->date('tanggal_exp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_exp');
    }
};
