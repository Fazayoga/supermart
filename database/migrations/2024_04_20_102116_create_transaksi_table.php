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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('diskon_id')->nullable();
            $table->integer('quantity');
            $table->decimal('total_amount', 10, 2);
            $table->timestamp('transaction_date')->useCurrent(); 
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->foreign('diskon_id')->references('id')->on('diskon')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
