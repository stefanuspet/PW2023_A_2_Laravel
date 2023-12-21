<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Auction;
use App\Models\Produk;
use App\Models\Shipment;
use App\Models\User;
use App\Models\ListGambar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SellAuctionController extends Controller
{

    private $idLogin;

    //ini otomatis jalan ketika class diinisialisasi
    public function __construct()
    {
        $user = Auth::user();

        if ($user) {
            $this->idLogin = $user->id_user;
        }
    }

    public function index()
    {
        try {
            $auction = Auction::all();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $auction
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    //step 1 simpan produk dan id produk yang di auction
    public function storeProduk(Request $request)
    {
        try {
            $produkData = $request->all();

            $validate = Validator::make($produkData, [
                'nama_produk' => 'required|max:255',
                'id_kategori_produk' => 'required',
                'deskripsi' => 'required',
                'harga_start' => 'required',
                'minimal_inkremen_bid' => 'required',
                'gambar_barang.*' => 'required|image:jpeg,png,jpg|max:2048', // * indicates multiple files
                'gambar_sertifikat' => 'image:jpeg,png,jpg|max:2048' // Optional
            ]);

            if ($validate->fails()) {
                return response(['message' => $validate->errors()], 400);
            }

            $produk = Produk::create([
                'nama_produk' => $request->nama_produk,
                'id_kategori_produk' => $request->id_kategori_produk,
                'deskripsi' => $request->deskripsi,
                'harga_start' => $request->harga_start,
                'minimal_inkremen_bid' => $request->minimal_inkremen_bid,
            ]);

            $uploadFolder = 'img';
            $gambarBarangFiles = $request->file('gambar_barang');

            foreach ($gambarBarangFiles as $image) {
                $imageUploadedPath = $image->store($uploadFolder, 'public');
                $uploadedImage = basename($imageUploadedPath);

                ListGambar::create([
                    'id_produk_gambar' => $produk->id_produk,
                    'gambar' => $uploadedImage
                ]);
            }

            // Handle sertifikat
            if (request()->hasFile('gambar_sertifikat')) {
                $imagesertif = $request->file('gambar_sertifikat');
                $image_uploaded_path_sertif = $imagesertif->store($uploadFolder, 'public');
                $uploadedImageSertif =  basename($image_uploaded_path_sertif);

                $produk->sertifikat = $uploadedImageSertif;
                $produk->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Berhasil insert data produk',
                'data' => $produk,
                'idproduk' => $produk->id_produk,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }


    //step 2 shipment
    public function storeShipment(Request $request)
    {
        try {
            $shipment = Shipment::create([
                'status' => 'dikemas',
                'harga' => $request->harga,
                'jenis_shipment' => $request->jenis_shipment,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil insert data',
                'data' => $shipment,
                'idshipment' => $shipment->id_shipment,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    //step 3 buat auction 
    public function storeAuction(Request $request, $idproduk, $idshipment)
    {
        try {

            $request->validate([
                'tanggal_start' => 'required',
                'tanggal_end' => 'required',
                'time_start' => 'required',
                'time_end' => 'required',
            ]);

            $tanggalstart = $request->input('tanggal_start');
            $tanggalend = $request->input('tanggal_end');
            $timeStart = $request->input('time_start');
            $timeEnd = $request->input('time_end');

            // Merge date and time into a single datetime field
            $dateTimeStart = Carbon::parse($tanggalstart . ' ' . $timeStart);
            $dateTimeEnd = Carbon::parse($tanggalend . ' ' . $timeEnd);

            /** @var \App\Models\User $user **/
            $user = Auth::user();


            $auctionAttributes = [
                'id_produk_auctioned' => $idproduk,
                'id_shipment_auction' => $idshipment,
                'id_seller' => $user->id_user,
                'time_start' => $dateTimeStart,
                'time_end' => $dateTimeEnd,
                'verified' => 0
            ];

            $auction = Auction::create($auctionAttributes);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil insert data',
                'data' => $auction
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    //get user login
    public function getUserLogin()
    {
        try {
            $user = Auth::user();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data user',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'user gagal',
                'data' => []
            ], 400);
        }
    }
}
