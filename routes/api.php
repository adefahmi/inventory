<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BarangCategoryController;
use App\Http\Controllers\API\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
// Auth::loginUsingId(1);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => 'auth:api'], function () {
    // Route::group(['middleware' => ['can:view laporan']], function () {
    //     Route::resource('barang-category', BarangCategoryController::class);
    // });
    Route::apiResource('barang-category', BarangCategoryController::class);
    Route::apiResource('barang', BarangController::class);
});
