<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryAsset\Http\Controllers\InventoryAssetController;
use Modules\InventoryAsset\Http\Controllers\LokasiController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('inventoryassets', InventoryAssetController::class)->names('inventoryasset');
});

Route::get('/lokasi', [LokasiController::class, 'index'])
    ->name('lokasi.index');