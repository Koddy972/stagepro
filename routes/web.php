<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BoutiqueController::class, 'index'])->name('accueil');

Route::get('/service', function () {
    return view('service');
})->name('service');

// Redirection de l'ancienne route boutique vers accueil
Route::get('/boutique', function () {
    return redirect()->route('accueil');
});

Route::resource('products', ProductController::class);

// Routes du panier
Route::prefix('cart')->name('cart.')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::put('/update/{cartItem}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{cartItem}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('count');
});