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
        Schema::create('detail_produks', function (Blueprint $table) {
            $table->id('DetailID');
            $table->unsignedBigInteger('PenjualanID');
            $table->unsignedBigInteger('ProdukID');
            $table->unsignedBigInteger('JumlahProduk');
            $table->decimal('Subtotal',10,2);
            // $table->foreign('PenjualanID')->references('PenjualanID')->on('penjualan');
            // $table->foreign('ProdukID')->references('ProdukID')->on('produk');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_produks');
    }
};
