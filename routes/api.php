<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BarangCategoryController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\BarangKeluarController;
use App\Http\Controllers\API\BarangMasukController;
use App\Http\Controllers\API\LaporanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    //Admin
    Route::group(['middleware' => ['can:view laporan']], function () {
        Route::apiResource('barang-category', BarangCategoryController::class);
        Route::apiResource('barang', BarangController::class);
        Route::get('laporan-barang-masuk', [LaporanController::class, 'barangMasuk']);
        Route::get('laporan-barang-keluar', [LaporanController::class, 'barangKeluar']);
        Route::get('laporan-stock', [LaporanController::class, 'stock']);
    });

    //Gudang
    Route::group(['middleware' => ['permission:manage barang masuk|manage barang keluar']], function () {
        Route::apiResource('barang-masuk', BarangMasukController::class);
        Route::apiResource('barang-keluar', BarangKeluarController::class);
    });

});
