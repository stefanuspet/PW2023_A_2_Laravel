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
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_user');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email_user')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verify_key')->nullable();
            $table->string('no_telp_user');

            //nullable supaya bisa register 2 tahap
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('negara')->nullable();
            $table->string('profile_pic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
