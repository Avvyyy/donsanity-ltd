<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController as AdminProductsController;
use App\Http\Controllers\User\ProductsController as UserProductsController;

Route::prefix('admin')->namespace("App\Http\Controllers\Admin")->group(function(){
    Route::get('products/search', [AdminProductsController::class, 'search']);
    Route::resource('products', AdminProductsController::class);
});

Route::namespace("App\Http\Controllers\User")->group(function(){
    Route::get('products/search', [UserProductsController::class, 'search']);
    Route::resource('products', UserProductsController::class);
});