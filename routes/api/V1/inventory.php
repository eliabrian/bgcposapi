<?php

use App\Http\Controllers\Api\V1\Inventory\IndexController;

Route::name('inventory.')->group(function () {
    Route::get(
        uri: '/',
        action: IndexController::class,
    )->name('index');
});