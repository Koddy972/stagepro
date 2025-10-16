<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Ajouter un produit au panier
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        
        $sessionId = Session::getId();
        $userId = Auth::id();
        
        // Vérifier si l'article existe déjà dans le panier
        $cartItem = CartItem::where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Augmenter la quantité
            $cartItem->quantity += $request->input('quantity', 1);            $cartItem->save();
        } else {
            // Créer un nouvel article
            CartItem::create([
                'session_id' => $userId ? null : $sessionId,
                'user_id' => $userId,
                'product_id' => $productId,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_image' => $product->image,
                'quantity' => $request->input('quantity', 1)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier',
            'cart_count' => $this->getCartCount()
        ]);
    }

    // Afficher le panier
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $cartItems->sum(function($item) {
            return $item->subtotal;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Mettre à jour la quantité
    public function update(Request $request, $cartItemId)    {
        $cartItem = $this->findCartItem($cartItemId);
        
        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Article non trouvé']);
        }

        $quantity = $request->input('quantity', 1);
        
        if ($quantity <= 0) {
            $cartItem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Article supprimé du panier',
                'cart_count' => $this->getCartCount()
            ]);
        }

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'message' => 'Quantité mise à jour',
            'cart_count' => $this->getCartCount(),
            'subtotal' => $cartItem->subtotal
        ]);
    }

    // Supprimer un article du panier
    public function remove($cartItemId)
    {
        $cartItem = $this->findCartItem($cartItemId);
        
        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Article non trouvé']);
        }

        $cartItem->delete();
        return response()->json([
            'success' => true,
            'message' => 'Article supprimé du panier',
            'cart_count' => $this->getCartCount()
        ]);
    }

    // Vider le panier
    public function clear()
    {
        $sessionId = Session::getId();
        $userId = Auth::id();

        CartItem::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();

        return response()->json([
            'success' => true,
            'message' => 'Panier vidé',
            'cart_count' => 0
        ]);
    }

    // Obtenir le nombre d'articles dans le panier
    public function getCartCount()
    {
        $cartItems = $this->getCartItems();
        $count = $cartItems->sum('quantity');
        
        // Si c'est une requête AJAX, retourner JSON avec la propriété 'count'
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['count' => $count]);
        }
        
        return $count;
    }

    // Méthodes utilitaires privées    
    private function getCartItems()
    {
        $sessionId = Session::getId();
        $userId = Auth::id();

        return CartItem::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with('product')->get();
    }

    private function findCartItem($cartItemId)
    {
        $sessionId = Session::getId();
        $userId = Auth::id();

        return CartItem::where('id', $cartItemId)
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->first();
    }
    // Page de paiement (protégée par authentification)
    public function checkout()
    {
        $cartItems = $this->getCartItems();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $total = $cartItems->sum(function($item) {
            return $item->subtotal;
        });

        return view('cart.checkout', compact('cartItems', 'total'));
    }

}