
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
        Schema::create('bid', function (Blueprint $table) {
            $table->id('id_bid');
            $table->foreignId('id_bidder')->constrained('user', 'id_user')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_auction_to_bid')->constrained('auction', 'id_auction')->onDelete('cascade')->onUpdate('cascade');
            $table->double('harga_bid');
            $table->dateTime('waktu_bid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid');
    }
};
