<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Créer une session de paiement Stripe Checkout
     *
     * @param array $items Les articles du panier
     * @param string $successUrl URL de redirection après succès
     * @param string $cancelUrl URL de redirection en cas d'annulation
     * @return Session
     * @throws ApiErrorException
     */
    public function createCheckoutSession(array $items, string $successUrl, string $cancelUrl): Session
    {
        \Log::info('=== DÉBUT CRÉATION SESSION STRIPE SERVICE ===');
        \Log::info('Nombre d\'items: ' . count($items));
        
        $lineItems = [];

        foreach ($items as $item) {
            \Log::info('Traitement item: ' . $item['name'] . ' - Prix: ' . $item['price'] . ' - Quantité: ' . $item['quantity']);
            
            $productData = [
                'name' => $item['name'],
            ];
            
            // Ajouter la description seulement si elle n'est pas vide
            if (!empty($item['description'])) {
                $productData['description'] = $item['description'];
            }
            
            // Ajouter l'image seulement si elle existe
            if (isset($item['image']) && $item['image']) {
                $productData['images'] = [$item['image']];
            }
            
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur', // ou 'usd' selon votre besoin
                    'product_data' => $productData,
                    'unit_amount' => (int)($item['price'] * 100), // Stripe utilise les centimes
                ],
                'quantity' => $item['quantity'],
            ];
        }
        
        \Log::info('Line items préparés: ' . count($lineItems));

        try {
            \Log::info('Appel API Stripe...');
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'locale' => 'fr', // Interface en français
            ]);
            
            \Log::info('Session Stripe créée avec succès: ' . $session->id);
            return $session;
            
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de la session Stripe: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Récupérer une session de paiement
     *
     * @param string $sessionId
     * @return Session
     * @throws ApiErrorException
     */
    public function retrieveSession(string $sessionId): Session
    {
        return Session::retrieve($sessionId);
    }

    /**
     * Vérifier si un paiement a été complété
     *
     * @param string $sessionId
     * @return bool
     */
    public function isPaymentComplete(string $sessionId): bool
    {
        try {
            $session = $this->retrieveSession($sessionId);
            return $session->payment_status === 'paid';
        } catch (ApiErrorException $e) {
            return false;
        }
    }
}
