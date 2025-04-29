<?php

use App\Http\Controllers\Api\V1\Inventory\IndexController;
use App\Http\Controllers\Api\V1\Inventory\ShowController;
use App\Http\Controllers\Api\V1\Inventory\StoreController;

Route::name('inventory.')->group(function () {
    Route::get(
        uri: '/',
        action: IndexController::class,
    )->name('index');

    Route::get(
        uri: '/{id}',
        action: ShowController::class,
    )->name('show');

    Route::post(
        uri: '/',
        action: StoreController::class,
    )->name('store');
});
