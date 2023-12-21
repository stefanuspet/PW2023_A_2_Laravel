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
        Schema::create('auction', function (Blueprint $table) {
            $table->id('id_auction');
            $table->foreignId('id_produk_auctioned')->constrained('produk', 'id_produk')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_shipment_auction')->constrained('shipment', 'id_shipment')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_seller')->constrained('user', 'id_user')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->char('verified');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction');
    }
};
