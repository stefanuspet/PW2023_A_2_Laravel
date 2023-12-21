<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ManageAucController extends Controller
{
    /**
     * Show Ongoing Auction
     */
    public function index()
    {
        $auctions = Auction::with('product', 'product.listGambar')
            ->whereDate('time_start', '<=', now())
            ->whereDate('time_end', '>=', now())
            ->where('verified', 1)
            ->get();

        // Mengatur format data gambar
        $formattedAuctions = $auctions->map(function ($auction) {
            $firstGambar = $auction->product->listGambar->first();

            return [
                'id_auction' => $auction->id_auction,
                'time_start' => $auction->time_start,
                'time_end' => $auction->time_end,
                'product' => [
                    'id_produk' => $auction->product->id_produk,
                    'nama_produk' => $auction->product->nama_produk,
                    'deskripsi' => $auction->product->deskripsi,
                    'harga_start' => $auction->product->harga_start,
                    'gambar' => $firstGambar ? $firstGambar->gambar : null
                ]
            ];
        });

        return response([
            'message' => 'All Contents Retrieved',
            'data' => $formattedAuctions,
        ], 200);
    }


    /**
     * Show Ongoing Auction
     */
    public function showHistory()
    {
        $data = Auction::with('product')
        ->whereDate('time_end', '<', now())
        ->get();

        $auctions = $data->map(function ($auction) {
            $auction->time_end = date('d M', strtotime($auction->time_end));
            return $auction;
        });

        return response([
            'message' => 'All Contents Retrieved',
            'data' => $auctions
        ], 200);
    }

    public function showSoon()
    {
        $data = Auction::with('product')
        ->whereDate('time_start', '>=', now())
        ->orderBy('verified', 'asc')
        ->get();

        $auctions = $data->map(function ($auction) {
            $auction->time_start = date('d M', strtotime($auction->time_start));
            return $auction;
        });

        return response([
            'message' => 'All Contents Retrieved',
            'data' => $auctions
        ], 200);
    }
}
