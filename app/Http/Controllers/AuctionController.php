<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index($id)
    {
        $auction = Auction::with(['product', 'product.kategoriProduk', 'product.listGambar', 'shipment', 'seller'])
        ->where('id_auction', $id)
        ->first();

        $gambarArray = $auction->product->listGambar->toArray();

        $dataArray = [
            'data' => $auction,
            'gambarArray' => $gambarArray,
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

    public function update(Request $request, $id)
    {
        try {
            // Find the auction by ID
            $auction = Auction::findOrFail($id);

            // Validate the request data
            $request->validate([
                'verified' => 'required|boolean',
            ]);

            // Update the verified column
            $auction->update([
                'verified' => $request->input('verified'),
            ]);

            return response()->json([
                'message' => 'Berhasil update status verifikasi',
                'data' => $auction
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

}
