<?php

use App\Http\Controllers\ProdutcsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ProdutcsController::class)->group(function () {
    Route::get('/products', 'show_all')->name('show_all');
    Route::post('/product', 'create_products')->name('create_products');
    Route::get('/product/{id}', 'show_id')->name('show_id');
    Route::get('/product/search/product_name={product_name}', 'show_name')->name('show_name');
    Route::put('/product/{id}', 'update_product')->name('update_product');
    Route::delete('product/{id}', 'delete_product')->name('product_name');
});
