<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    // Créer une commande
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ], [
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
        ]);

        $cartItems = $this->getCartItems();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $totalAmount = $cartItems->sum(function($item) {
            return $item->subtotal;
        });

        try {
            DB::beginTransaction();

            // Créer la commande
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'shipping_address' => null, // Pas de livraison - retrait en magasin
                'phone' => $validated['phone'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Créer les items de commande
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product_name,
                    'product_price' => $cartItem->product_price,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $cartItem->subtotal,
                ]);
            }

            // Vider le panier
            CartItem::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('order.confirmation', $order->id)
                ->with('success', 'Commande créée avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de la création de la commande.');
        }
    }

    // Page de confirmation
    public function confirmation($orderId)
    {
        $order = Order::with('items')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('cart.confirmation', compact('order'));
    }

    // Méthode utilitaire
    private function getCartItems()
    {
        return CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();
    }
    
    // Afficher les commandes du client
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.my-orders', compact('orders'));
    }
    
    // Afficher le détail d'une commande
    public function show($orderId)
    {
        $order = Order::with('items.product')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
