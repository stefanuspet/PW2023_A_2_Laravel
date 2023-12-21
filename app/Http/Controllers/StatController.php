<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $data = Auction::with(['seller', 'product'])
            ->whereDate('time_start', '<=', now())
            ->whereDate('time_end', '>=', now())
            ->where('verified', 1)
            ->get();
        
            $result = [];

            foreach ($data as $auction) {
                $auctionData = $auction->toArray();
        
                $bids = Bid::where('id_auction_to_bid', $auction->id_auction)
                    ->orderBy('harga_bid', 'desc')
                    ->first();
        
                $auctionData['bids'] = $bids;
        
                $result[] = $auctionData;
            }
        
            return response()->json(['auctions' => $result]);
    }

    public function showStatAuction()
    {
        $auctions = Auction::count();

        return response()->json(['data' => $auctions]);
    }

    public function showStatBid()
    {
        $bids = Bid::count();

        return response()->json(['data' => $bids]);
    }
}