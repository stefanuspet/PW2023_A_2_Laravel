<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Shipment;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Auction extends Model
{
    use HasFactory;
    protected $table = 'auction';
    protected $primaryKey = 'id_auction';
    public $timestamps = false;

    protected $fillable = [
        'id_produk_auctioned',
        'id_shipment_auction',
        'id_seller',
        'time_start',
        'time_end',
        'verified'
    ];

    // protected $casts = [
    //     'time_start' => 'datetime:d M',
    //     'time_end' => 'datetime:d M'
    // ];

    public function product()
    {
        return $this->belongsTo(Produk::class, 'id_produk_auctioned', 'id_produk');
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'id_shipment_auction', 'id_shipment');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment_auction', 'id_payment');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'id_seller', 'id_user');
    }

    public function bidder(): HasOne
    {
        return $this->hasOne(Bid::class, 'id_auction_to_bid', 'id_auction');
    }
}
