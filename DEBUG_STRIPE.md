Route pour test de debug du paiement Stripe

Ajoutez cette route temporaire dans routes/web.php pour débugger :

```php
// Route de debug temporaire (à supprimer après test)
Route::get('/test-stripe-debug', function() {
    $sessionId = \Session::getId();
    $userId = \Auth::id();

    $cartItems = \App\Models\CartItem::where(function($query) use ($userId, $sessionId) {
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }
    })->get();

    return response()->json([
        'session_id' => $sessionId,
        'user_id' => $userId,
        'cart_items' => $cartItems,
        'cart_count' => $cartItems->count(),
        'total' => $cartItems->sum(function($item) {
            return $item->product_price * $item->quantity;
        })
    ]);
});
```

Accédez à : http://localhost:8000/test-stripe-debug
