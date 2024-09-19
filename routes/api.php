<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProdukController;
// use App\Http\Controllers\UserController;


// Route::post('/login', [UserController::class, 'login']);
// Route::post('/register', [UserController::class, 'register']);

// // Route::post('/users', [UserController::class, 'register']);


// Route::get('/user/{id}', [UserController::class, 'show']);

// Route::get('/users', [UserController::class, 'index']);   // Untuk mengambil daftar user
// Route::post('/users', [UserController::class, 'store']);  // Untuk menambah user
// Route::get('/users/{id}', [UserController::class, 'show']);  // Untuk mengambil user berdasarkan ID
// Route::put('/users/{id}', [UserController::class, 'update']); // Untuk mengupdate user berdasarkan ID
// Route::delete('/users/{id}', [UserController::class, 'destroy']); // Untuk menghapus user berdasarkan ID


// Route::get('/produk', [ProdukController::class, 'index']);      // Ambil semua produk
// Route::post('/produk', [ProdukController::class, 'store']);     // Tambah produk baru
// Route::get('/produk/{id}', [ProdukController::class, 'show']);  // Ambil produk berdasarkan ID
// Route::put('/produk/{id}', [ProdukController::class, 'update']); // Update produk berdasarkan ID
// Route::delete('/produk/{id}', [ProdukController::class, 'destroy']); // Hapus produk berdasarkan ID



// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "api" middleware group. Make something great!
// |
// */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;


Route::middleware('auth:api')->post('/change-password', [UserController::class, 'changePassword']);
Route::post('/order', [ProdukController::class, 'order']);

// Mendapatkan semua pesanan
Route::get('/orders', [ProdukController::class, 'index']);

// Mendapatkan pesanan berdasarkan ID
Route::get('/orders/{id}', [ProdukController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);
Route::post('/register', [UserController::class, 'register_action']);
Route::post('/login', [UserController::class, 'login_action']);
Route::post('/logout', [UserController::class, 'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});