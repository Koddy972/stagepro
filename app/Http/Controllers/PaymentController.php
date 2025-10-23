<?php

namespace App\Http\Controllers;

use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Créer une session de paiement Stripe
     */
    public function createCheckoutSession(Request $request)
    {
        try {
            // Log du début
            Log::info('=== DÉBUT CRÉATION SESSION STRIPE ===');
            
            // Récupérer le panier depuis la base de données
            $sessionId = \Session::getId();
            $userId = \Auth::id();
            
            Log::info('Session ID: ' . $sessionId);
            Log::info('User ID: ' . ($userId ?? 'non connecté'));

            $cartItems = \App\Models\CartItem::where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->get();
            
            Log::info('Nombre d\'articles dans le panier: ' . $cartItems->count());

            if ($cartItems->isEmpty()) {
                Log::warning('Panier vide');
                return redirect()->route('cart.index')
                    ->with('error', 'Votre panier est vide.');
            }

            // Préparer les articles pour Stripe
            $items = [];
            foreach ($cartItems as $item) {
                $items[] = [
                    'name' => $item->product_name,
                    'description' => '',
                    'price' => $item->product_price,
                    'quantity' => $item->quantity,
                    'image' => $item->product_image ? asset('storage/' . $item->product_image) : null,
                ];
            }
            
            Log::info('Articles préparés pour Stripe: ', $items);

            // URLs de redirection
            $successUrl = route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl = route('payment.cancel');
            
            Log::info('Success URL: ' . $successUrl);
            Log::info('Cancel URL: ' . $cancelUrl);

            // Créer la session Stripe
            Log::info('Création de la session Stripe...');
            $session = $this->stripeService->createCheckoutSession(
                $items,
                $successUrl,
                $cancelUrl
            );
            
            Log::info('Session Stripe créée avec succès');
            Log::info('Session ID: ' . $session->id);
            Log::info('Session URL: ' . $session->url);

            // Rediriger vers Stripe Checkout
            Log::info('Redirection vers: ' . $session->url);
            return redirect($session->url);

        } catch (\Exception $e) {
            Log::error('=== ERREUR CRÉATION SESSION STRIPE ===');
            Log::error('Message: ' . $e->getMessage());
            Log::error('Fichier: ' . $e->getFile() . ':' . $e->getLine());
            Log::error('Trace: ' . $e->getTraceAsString());
            
            return redirect()->route('cart.index')
                ->with('error', 'Une erreur est survenue lors de la création du paiement: ' . $e->getMessage());
        }
    }

    /**
     * Page de succès après paiement
     */
    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect()->route('home')
                ->with('error', 'Session de paiement invalide.');
        }

        try {
            // Vérifier le paiement
            $isComplete = $this->stripeService->isPaymentComplete($sessionId);

            if ($isComplete) {
                // Sauvegarder la commande dans la base de données
                $this->saveOrder($sessionId);

                // Vider le panier depuis la base de données
                $sessionCartId = \Session::getId();
                $userId = \Auth::id();

                \App\Models\CartItem::where(function($query) use ($userId, $sessionCartId) {
                    if ($userId) {
                        $query->where('user_id', $userId);
                    } else {
                        $query->where('session_id', $sessionCartId);
                    }
                })->delete();

                return view('payment.success', [
                    'sessionId' => $sessionId
                ]);
            }

            return redirect()->route('cart.index')
                ->with('error', 'Le paiement n\'a pas été complété.');

        } catch (\Exception $e) {
            Log::error('Erreur vérification paiement: ' . $e->getMessage());
            
            return redirect()->route('cart.index')
                ->with('error', 'Une erreur est survenue lors de la vérification du paiement.');
        }
    }

    /**
     * Page d'annulation
     */
    public function cancel()
    {
        return view('payment.cancel');
    }

    /**
     * Sauvegarder la commande (à implémenter selon votre modèle)
     */
    protected function saveOrder($sessionId)
    {
        // TODO: Créer un modèle Order et sauvegarder les détails
        // de la commande avec les informations du panier et du paiement
        
        try {
            $session = $this->stripeService->retrieveSession($sessionId);
            
            // Exemple de log pour le moment
            Log::info('Commande complétée', [
                'session_id' => $sessionId,
                'amount' => $session->amount_total / 100,
                'currency' => $session->currency,
                'customer_email' => $session->customer_details->email ?? null,
            ]);

            // Ici vous pouvez créer votre enregistrement de commande
            // Order::create([...]);

        } catch (\Exception $e) {
            Log::error('Erreur sauvegarde commande: ' . $e->getMessage());
        }
    }

    /**
     * Webhook pour les événements Stripe (optionnel mais recommandé)
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $webhookSecret
            );

            // Gérer les différents types d'événements
            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;
                    $this->saveOrder($session->id);
                    break;

                case 'payment_intent.succeeded':
                    // Gérer le succès du paiement
                    break;

                case 'payment_intent.payment_failed':
                    // Gérer l'échec du paiement
                    break;
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Erreur webhook Stripe: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
