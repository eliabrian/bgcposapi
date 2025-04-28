<?php

use App\Http\Controllers\Api\V1\Category\DeleteController;
use App\Http\Controllers\Api\V1\Category\IndexController;
use App\Http\Controllers\Api\V1\Category\ShowController;
use App\Http\Controllers\Api\V1\Category\StoreController;
use App\Http\Controllers\Api\V1\Category\UpdateController;
use Illuminate\Support\Facades\Route;

Route::name('category.')->group(function () {
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

    Route::put(
        uri: '/{id}',
        action: UpdateController::class,
    )->name('update');

    Route::delete(
        uri: '/{id}',
        action: DeleteController::class,
    )->name('delete');
});
