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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->foreignId('id_kategori_produk')->constrained('kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('deskripsi');
            $table->double('harga_start');
            $table->double('minimal_inkremen_bid');
            $table->string("sertifikat")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
