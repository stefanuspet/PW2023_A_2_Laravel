<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bid extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "bid";
    protected $primaryKey = "id_bid";
    protected $fillable = [
        'id_bidder',
        'id_auction_to_bid',
        'harga_bid',
        'waktu_bid'
    ];

    protected $casts = [
        'waktu_bid' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_bidder', 'id_user');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'id_auction_to_bid', 'id_auction');
    }
}
