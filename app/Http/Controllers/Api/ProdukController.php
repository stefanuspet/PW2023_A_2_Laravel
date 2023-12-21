<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Auction;
use App\Models\Bid;

class ProdukController extends Controller
{
    // feth data produk
    public function index()
    {
        $auctions = Auction::where("verified", 1)
        ->whereDate('time_start', '<=', now())
        ->whereDate('time_end', '>=', now())
        ->get();
        $auctions->load('product.listGambar');

        // Initialize an array to store first images
        $fotoArray = [];

        // Get foto pertama dari produk di listgambar for each auction
        foreach ($auctions as $auction) {
            $fotoArray[] = $auction->product->listGambar->first();
        }

        return response()->json([
            'success' => true,
            'message' => 'Daftar data lelang, produk, dan gambar',
            'data' => $auctions,
            'foto' => $fotoArray
        ], 200);
    }

    public function show($id)
    {
        $auctions = Auction::where('id_auction', $id)->first();
        $gambarArray = $auctions->product->listGambar->toArray();

        $dataArray = [
            'data' => $auctions,
            'gambarArray' => $gambarArray,
        ];
        if (!$auctions) {
            return response()->json([
                'success' => false,
                'message' => 'Auction dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }
        $auctions->load('product');

        $bid = Bid::where('id_auction_to_bid', $auctions->id_auction)->get();
        //get highest harga in bid
        $highestBid = $bid->max('harga_bid');

        return response()->json([
            'success' => true,
            'message' => 'Detail data produk',
            'data' => $dataArray,
            'highestBid' => $highestBid
        ], 200);
    }

    // search product by name
    public function search(Request $request)
    {
        $produk = Produk::where('nama_produk', 'like', "%" . $request->nama_produk . "%")->get();

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk dengan nama ' . $request->nama_produk . ' tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data produk',
            'data' => $produk
        ], 200);
    }
}
