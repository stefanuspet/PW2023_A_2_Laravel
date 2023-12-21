<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellAuctionController;
use Illuminate\Support\Facades\Auth;


Route::post('/registerStep1', [\App\Http\Controllers\RegisterController::class, 'actionRegister1'])->name('registerStep1');
Route::put('/register2/{idregistered}', [\App\Http\Controllers\RegisterController::class, 'actionRegister2'])->name('register2');
Route::get('/register/verify/{verify_key}', [\App\Http\Controllers\RegisterController::class, 'verify']);

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('/loginadmin', [\App\Http\Controllers\LoginController::class, 'loginadmin']);

Route::put('/forgotPassword', [\App\Http\Controllers\ProfilController::class, 'forgotPassword']);

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout']);

    Route::post('/sell/storeProduk', [\App\Http\Controllers\SellAuctionController::class, 'storeProduk']);
    Route::post('/sell/storeShipment', [\App\Http\Controllers\SellAuctionController::class, 'storeShipment']);
    Route::post('/sell/storeAuction/{idproduk}/{idshipment}', [\App\Http\Controllers\SellAuctionController::class, 'storeAuction']);
    Route::get('/getUserLogin', [\App\Http\Controllers\SellAuctionController::class, 'getUserLogin']);

    //untuk profil
    Route::get('/profile', [\App\Http\Controllers\ProfilController::class, 'showProfile']);
    Route::put('/updateProfilePic', [\App\Http\Controllers\ProfilController::class, 'updateProfilePic']);
    Route::put('/updateProfile1', [\App\Http\Controllers\ProfilController::class, 'updateProfile1']);
    Route::put('/updateProfile2', [\App\Http\Controllers\ProfilController::class, 'updateProfile2']);

    //admin manage user
    Route::get('/admin/showuser', [\App\Http\Controllers\AdminUserController::class, 'index']);
    Route::get('/admin/showuser/{id}', [\App\Http\Controllers\AdminUserController::class, 'show']);
    Route::delete('/admin/deleteuser/{id}', [\App\Http\Controllers\AdminUserController::class, 'destroy']);
    Route::put('/admin/edituser1/{id}', [\App\Http\Controllers\AdminUserController::class, 'edituser1']);
    Route::put('/admin/edituser2/{id}', [\App\Http\Controllers\AdminUserController::class, 'edituser2']);
    Route::put('/admin/editpicture/{id}', [\App\Http\Controllers\AdminUserController::class, 'editPic']);

    //pruduk
    Route::get('/produk', [\App\Http\Controllers\Api\ProdukController::class, 'index']);
    Route::get('/produk/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'show']);
    Route::post('/produk/search', [\App\Http\Controllers\Api\ProdukController::class, 'search']);

    // bid
    Route::get('/bid/{id}', [\App\Http\Controllers\Api\BidController::class, 'index']);
    Route::post('/bid', [\App\Http\Controllers\Api\BidController::class, 'store']);
    Route::get('/bid/check/{id}', [\App\Http\Controllers\Api\BidController::class, 'checkBid']);
    Route::put('/bid/{id}', [\App\Http\Controllers\Api\BidController::class, 'update']);
    Route::delete('/bid/{id}', [\App\Http\Controllers\Api\BidController::class, 'destroy']);

    //------------------------Admin Route------------------------
    
    // Tampil di Auction Admin
    Route::get('/manageAuc', [\App\Http\Controllers\ManageAucController::class, 'index']);
    Route::get('/manageHistory', [\App\Http\Controllers\ManageAucController::class, 'showHistory']);
    Route::get('/manageSoon', [\App\Http\Controllers\ManageAucController::class, 'showSoon']);

    //Verifikasi Admin
    Route::put('/verif/{id}', [\App\Http\Controllers\AuctionController::class, 'update']);
    Route::get('/verif/{id}', [\App\Http\Controllers\AuctionController::class, 'index']);

    //Produk Admin
    Route::put('/auction/{id}', [\App\Http\Controllers\ProdukController::class, 'update']);
    Route::delete('/auction/{id}', [\App\Http\Controllers\ProdukController::class, 'destroy']);
    Route::get('/auction/{id}', [\App\Http\Controllers\ProdukController::class, 'index']);

    //Bidder Admin
    Route::delete('/bidder/{id}', [\App\Http\Controllers\BidderController::class, 'destroy']);
    Route::get('/bidder/{id}', [\App\Http\Controllers\BidderController::class, 'index']);

    //Dashboard Admin
    Route::get('/stat', [\App\Http\Controllers\StatController::class, 'index']);
    Route::get('/statAuc', [\App\Http\Controllers\StatController::class, 'showStatAuction']);
    Route::get('/statBid', [\App\Http\Controllers\StatController::class, 'showStatBid']);
});
