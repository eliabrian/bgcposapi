<?php

use Illuminate\Support\Facades\Route;

Route::prefix('category')
    ->group(callback: base_path('routes/api/V1/category.php'));
