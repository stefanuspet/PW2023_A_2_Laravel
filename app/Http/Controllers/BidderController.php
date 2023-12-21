<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;

class BidderController extends Controller
{
    public function index($id)
    {
        $bidder = Bid::with(['user', 'auction', 'auction.product'])
        ->where('id_auction_to_bid', $id)
        ->orderBy('harga_bid', 'desc') 
        ->get();

        $auction = Auction::with('product')->find($id);

        $dataArray = [
            'data' => $bidder->toArray(),
            'auction' => $auction
        ];

        if (!is_null($auction)) {
            return response([
                'message' => 'Content found, it is ',
                'data' => $dataArray
            ], 200);
        }

        //return view('verification', $dataArray);
        return response()->json([
            'success' => true,
            'message' => 'Content not found',
            'data' => null
        ], 200);
    }

    public function destroy($id)
    {
        $bid = Bid::find($id);

        if (is_null($bid)) {
            return response([
                'message' => 'Content Not Found',
                'data' => null
            ], 404);
        }

        if ($bid->delete()) {
            return response([

                'message' => 'Delete Bid Success',
                'data' => $bid
            ], 200);
        }

        return response([
            'message' => 'Delete Content Failed',
            'data' => null
        ], 400);
    }
}
