<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\BukuController;
use App\Http\Controllers\Web\BerandaController;
use App\Http\Controllers\Web\KategoriBukuController;
use App\Http\Controllers\Web\MemberController;

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
    return app(BerandaController::class)->index();
})->name('home');

Route::post('/transaksi-buku', [BerandaController::class, 'transaksi'])->name('transaksi-buku.store');

Route::resource('members', MemberController::class);
Route::resource('buku', BukuController::class);
Route::resource('kategori-buku', KategoriBukuController::class)
    ->parameters(['kategori-buku' => 'kategoriBuku']);
