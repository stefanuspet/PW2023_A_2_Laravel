<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index($id)
    {
        $produk = Produk::with('kategoriProduk', 'auction', 'listGambar')->find($id);
        
        $gambarArray = $produk->listGambar->toArray();

        $dataArray = [
            'data' => $produk,
            'gambarArray' => $gambarArray
        ];

        if (!is_null($produk)) {
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

    public function show($id)
    {
        $produk = Produk::with('kategoriProduk', 'auction')->find($id);

        if (!is_null($produk)) {
            return response([
                'message' => 'Content found, it is ',
                'data' => $produk
            ], 200);
        }

        return response([
            'message' => 'Content not found',
            'data' => null
        ], 404);
    }

    public function update(Request $request, $id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $dataProduk = $request->all();

            // Validate the request data
            $validate = Validator::make($dataProduk, [
                'nama_produk' => 'required|max:20',
                'id_kategori_produk' => 'required',
                'deskripsi' => 'required',
                'harga_start' => 'required',
                'minimal_inkremen_bid' => 'required',
            ]);

            if ($validate->fails())
                return response(['message' => $validate->errors()], 400);


            
            $produk->update([
                'nama_produk' => $request->nama_produk,
                'id_kategori_produk' => $request->id_kategori_produk,
                'deskripsi' => $request->deskripsi,
                'harga_start' => $request->harga_start,
                'minimal_inkremen_bid' => $request->minimal_inkremen_bid,
            ]);

            return response()->json([
                'message' => 'Berhasil update status verifikasi',
                'data' => $produk
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (is_null($produk)) {
            return response([
                'message' => 'Content Not Found',
                'data' => null
            ], 404);
        }

        if ($produk->delete()) {
            return response([

                'message' => 'Delete Bid Success',
                'data' => $produk
            ], 200);
        }

        return response([
            'message' => 'Delete Content Failed',
            'data' => null
        ], 400);
    }
}
