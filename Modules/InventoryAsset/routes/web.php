<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryAsset\app\Http\Controllers\LokasiController;
use Modules\InventoryAsset\app\Http\Controllers\InventoryAssetController;

Route::resource('inventoryassets', InventoryAssetController::class)->names('inventoryasset');


    Route::get('/lokasi', [LokasiController::class, 'index'])
        ->name('lokasi.index');

    Route::post('/lokasi/store', [LokasiController::class, 'store'])
        ->name('lokasi.store');

    Route::put('/lokasi/update/{id}', [LokasiController::class, 'update'])
        ->name('lokasi.update');

    Route::delete('/lokasi/delete/{id}', [LokasiController::class, 'destroy'])
        ->name('lokasi.destroy');

