<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('members', MemberController::class);
Route::apiResource('buku', BukuController::class);
Route::apiResource('kategori-buku', KategoriBukuController::class)
    ->parameters(['kategori-buku' => 'kategoriBuku']);
