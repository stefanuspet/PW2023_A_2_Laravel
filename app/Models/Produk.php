<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = false;
    protected $fillable = [
        'nama_produk',
        'id_kategori_produk',
        'deskripsi',
        'harga_start',
        'minimal_inkremen_bid',
        'sertifikat',
    ];

    public function kategoriProduk(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori_produk', 'id');
    }

    public function auction(): HasOne
    {
        return $this->hasOne(Auction::class, 'id_produk_auctioned', 'id_produk');
    }

    public function listGambar(): HasMany
    {
        return $this->hasMany(Listgambar::class, 'id_produk_gambar', 'id_produk');
    }
}
