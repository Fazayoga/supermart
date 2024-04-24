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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('gambar')->nullable();
            $table->string('nama')->nullable();
            $table->integer('stok')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->date('tanggal_exp')->nullable();
            $table->boolean('expired')->default(false);
            $table->timestamps();

            $table->foreign('category')->references('id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
