<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryCategoryController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BoutiqueController::class, 'index'])->name('accueil');

Route::get('/service', function () {
    return view('service');
})->name('service');

Route::get('/galerie', [GalleryController::class, 'index'])->name('galerie');

// Route pour récupérer les images par catégorie (pour hover services)
Route::get('/gallery/category/{categorySlug}/images', [GalleryController::class, 'getImagesByCategory'])->name('gallery.category.images');

// Route pour la page boutique
Route::get('/boutique', [BoutiqueController::class, 'boutique'])->name('boutique');

// Routes d'authentification admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Routes protégées pour la gestion des produits (réservées à l'admin)
Route::middleware(['admin'])->group(function() {
    Route::resource('products', ProductController::class)->except(['show']);
    
    // Routes pour la gestion des catégories de produits
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // Routes pour la gestion des catégories de galerie
    Route::post('/gallery-categories', [GalleryCategoryController::class, 'store'])->name('gallery-categories.store');
    Route::put('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'update'])->name('gallery-categories.update');
    Route::delete('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'destroy'])->name('gallery-categories.destroy');
    
    // Routes pour la gestion de la galerie
    Route::get('/admin/gallery', [GalleryController::class, 'manage'])->name('gallery.manage');
    Route::post('/admin/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/admin/gallery/{image}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/admin/gallery/{image}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/admin/gallery/{image}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
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

// Routes d'authentification client
Route::get('/client/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [ClientAuthController::class, 'login'])->name('client.login.post');
Route::get('/client/register', [ClientAuthController::class, 'showRegisterForm'])->name('client.register');
Route::post('/client/register', [ClientAuthController::class, 'register'])->name('client.register.post');
Route::post('/client/logout', [ClientAuthController::class, 'logout'])->name('client.logout');

// Routes protégées pour les clients
Route::middleware(['client'])->group(function() {
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');
    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('order.show');
    
    // Routes Stripe pour le paiement
    Route::post('/payment/checkout', [PaymentController::class, 'createCheckoutSession'])->name('payment.checkout');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Webhook Stripe (pas de middleware pour permettre à Stripe d'envoyer les notifications)
Route::post('/stripe/webhook', [PaymentController::class, 'webhook'])->name('stripe.webhook');

// Routes admin pour les commandes
Route::middleware(['admin'])->group(function() {
    Route::get('/admin/orders', [AdminController::class, 'showOrders'])->name('admin.orders');
    Route::get('/admin/orders/{order}', [AdminController::class, 'showOrderDetails'])->name('admin.order.details');
    Route::put('/admin/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.status');
    
    // Routes pour les devis (admin)
    Route::get('/admin/quotes', [AdminController::class, 'showQuotes'])->name('admin.quotes');
    Route::get('/admin/quotes/{quote}', [AdminController::class, 'showQuoteDetails'])->name('admin.quote.details');
    Route::put('/admin/quotes/{quote}/status', [AdminController::class, 'updateQuoteStatus'])->name('admin.quote.status');
    Route::delete('/admin/quotes/{quote}', [AdminController::class, 'deleteQuote'])->name('admin.quote.delete');
});

// Routes pour les demandes de devis
Route::get('/demander-un-devis', [QuoteController::class, 'create'])->name('quote.create');
Route::post('/demander-un-devis', [QuoteController::class, 'store'])->name('quote.store');
Route::get('/devis/confirmation', [QuoteController::class, 'success'])->name('quote.success');
