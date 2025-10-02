<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BoutiqueController::class, 'index'])->name('accueil');

Route::get('/service', function () {
    return view('service');
})->name('service');

// Route pour la page boutique
Route::get('/boutique', [BoutiqueController::class, 'boutique'])->name('boutique');

// Routes d'authentification admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Routes protégées pour la gestion des produits (réservées à l'admin)
Route::middleware(['admin'])->group(function() {
    Route::resource('products', ProductController::class)->except(['show']);
});

// Route publique pour voir un produit (sans protection)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Routes du panier
Route::prefix('cart')->name('cart.')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::put('/update/{cartItem}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{cartItem}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('count');
});
