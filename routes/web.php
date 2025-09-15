<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BoutiqueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/boutique', [BoutiqueController::class, 'index'])->name('boutique');

Route::resource('products', ProductController::class);