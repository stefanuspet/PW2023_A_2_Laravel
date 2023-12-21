<?php

use App\Http\Controllers\ManageAucController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellAuctionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/homeadmin', function () {
    return view('dashboard');
});

Route::get('/details', function () {
    return view('details');
});


Route::get('/dashboardAdminUserDetail', function () {
    return view('dashboardAdminUserDetail');
});

Route::get('/home', function () {
    return view('homeUser');
});

Route::get('/detailProduk/{id}', function () {
    return view('detailProduct');
});

Route::get('/detail', function () {
    return view('sidebarUser');
});


Route::get('/detailsBid', function () {
    return view('detailsBid');
});

Route::get('/verification', function () {
    return view('verification');
});




//-----------------idel-----------------
Route::get('/userprofil', function () {
    return view('userprofil');
});

Route::get('/sell', function () {
    return view('sell');
});
Route::get('/registerStep1', function () {
    return view('registerStep1');
});

Route::get('/registerStep2/{idregistered}', function () {
    return view('registerStep2');
})->name('registerStep2');

Route::get('/manageuser', function () {
    return view('manageuser');
});

Route::get('/admineditprofil', function () {
    return view('adminEditProfil');
});

Route::get('/forgotpage', function () {
    return view('forgotPassword');
});

//-------------------------------------


Route::get('/auction', function () {
    return view('auction');
});

// Route::get('/auction', function () {
//     return view('auction', [
//         'item' => [
//             [
//                 'name' => 'Justin Car',
//                 'price' => 700000,
//                 'endtime' => 2,
//                 'pic' => asset('img/Car.jpg'),
//             ],
//             [
//                 'name' => 'Four Horseman Paint',
//                 'price' => 5000000,
//                 'endtime' => 1,
//                 'pic' => asset('img/Lukisan 4.jpg'),
//             ],
//             [
//                 'name' => 'Zeus Statue',
//                 'price' => 80000000,
//                 'endtime' => 7,
//                 'pic' => asset('img/Patung Zeus.jpg'),
//             ],
//             [
//                 'name' => 'Diana Hat',
//                 'price' => 1000000,
//                 'endtime' => 6,
//                 'pic' => asset('img/Dianas Hat.jpg'),
//             ],
//         ],
//         'soon' => [
//             [
//                 'name' => '1950 Car',
//                 'status' => 'Waiting for confirmation',
//                 'date' => '3 Oct',
//             ],
//             [
//                 'name' => 'Gold Chair',
//                 'status' => 'Waiting for confirmation',
//                 'date' => '3 Oct',
//             ],
//             [
//                 'name' => 'Permen Berlian',
//                 'status' => 'Ready to be launched',
//                 'date' => '4 Nov',
//             ],
//             [
//                 'name' => 'Chirstmas Tree',
//                 'status' => 'Ready to be launched',
//                 'date' => '20 Dec',
//             ],
//         ],
//         'history' => [
//             [
//                 'name' => 'BTS Album',
//                 'sold' => 10000000,
//                 'date' => '5 May'
//             ],
//             [
//                 'name' => 'BTS Album',
//                 'sold' => 10000000,
//                 'date' => '5 May'
//             ],
//             [
//                 'name' => 'BTS Album',
//                 'sold' => 10000000,
//                 'date' => '5 May'
//             ],
//             [
//                 'name' => 'BTS Album',
//                 'sold' => 10000000,
//                 'date' => '5 May'
//             ],
//         ]
//     ]);
// });
