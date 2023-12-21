<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'jenis_kategori',
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_kategori_produk', 'id');
    }
}
