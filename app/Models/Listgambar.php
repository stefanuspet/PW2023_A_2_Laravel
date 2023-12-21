<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listgambar extends Model
{
    use HasFactory;
    protected $table = 'list_gambar';
    protected $primaryKey = 'id_list_gambar';
    public $timestamps = false;
    protected $fillable = [
        'id_produk_gambar',
        'gambar',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk_gambar', 'id_produk');
    }
}
