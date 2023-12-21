<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    // get bid by id auction
    public function index($id)
    {
        $bid = Bid::with(['auction', 'user'])
            ->where('id_auction_to_bid', $id)
            ->orderBy('harga_bid', 'desc')
            ->get();

        if ($bid->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Bid dengan id auction ' . $id . ' tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Detail data bid',
            'data' => $bid
        ], 200);
    }
    // create bid by id auction
    public function store(Request $request)
    {
        $user = Auth::user();
        $bid = new Bid();
        $bid->id_auction_to_bid = $request->id_auction_to_bid;
        $bid->id_bidder = $user->id_user;
        $bid->harga_bid = $request->harga_bid;
        $bid->waktu_bid = now();
        $bid->save();

        return response()->json([
            'success' => true,
            'message' => 'Bid berhasil ditambahkan',
            'data' => $bid
        ], 200);
    }

    // check if user already bid by auction id
    public function checkBid($id)
    {
        $user = Auth::user();
        $bid = Bid::where('id_auction_to_bid', $id)
            ->where('id_bidder', $user->id_user)
            ->first();

        if ($bid) {
            return response()->json([
                'success' => true,
                'message' => 'User sudah melakukan bid',
                'data' => $bid
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User belum melakukan bid'
            ], 404);
        }
    }
    // update bid user by id auction
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $bid = Bid::where('id_auction_to_bid', $id)
            ->where('id_bidder', $user->id_user)
            ->first();

        if ($bid) {
            $bid->harga_bid = $request->harga_bid;
            $bid->save();

            return response()->json([
                'success' => true,
                'message' => 'Bid berhasil diupdate',
                'data' => $bid
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User belum melakukan bid'
            ], 404);
        }
    }

    // delete bid user by id auction
    public function destroy($id)
    {
        $user = Auth::user();
        $bid = Bid::where('id_auction_to_bid', $id)
            ->where('id_bidder', $user->id_user)
            ->first();

        if ($bid) {
            $bid->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bid berhasil dihapus',
                'data' => $bid
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User belum melakukan bid'
            ], 404);
        }
    }
}
