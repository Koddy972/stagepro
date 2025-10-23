@extends('layouts.app')

@section('content')
<style>
    .checkout-section {
        padding: 90px 0;
        background-color: #f8f9fa;
        min-height: 70vh;
    }

    .section-title {
        text-align: center;
        margin-bottom: 60px;
        color: #0d2f4f;
        position: relative;
    }
    
    .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        margin-bottom: 15px;
        font-weight: 700;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        width: 60px;
        height: 3px;
        background-color: #de419a;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
    }

    .checkout-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        padding: 40px;
        margin-bottom: 30px;
    }

    .order-summary-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .order-total {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0d2f4f;
        padding-top: 20px;
    }

    .btn-payment {
        background: linear-gradient(135deg, #de419a 0%, #c73584 100%);
        color: white;
        border: none;
        padding: 18px 40px;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(222, 65, 154, 0.4);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-payment:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
        z-index: 1;
    }

    .btn-payment:hover:not(:disabled):before {
        left: 100%;
    }

    .btn-payment:hover:not(:disabled) {
        background: linear-gradient(135deg, #c73584 0%, #0d2f4f 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(222, 65, 154, 0.6);
    }

    .btn-payment:disabled {
        opacity: 0.8;
        cursor: not-allowed;
    }

    .btn-payment i,
    .btn-payment span {
        position: relative;
        z-index: 2;
    }

    .btn-payment .spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.8s linear infinite;
        position: relative;
        z-index: 2;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .payment-icon {
        font-size: 1.3rem;
        position: relative;
        z-index: 2;
    }

    .product-checkout-item {
        display: flex;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .product-checkout-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 20px;
    }

    .product-checkout-details {
        flex: 1;
    }

    .product-checkout-name {
        font-weight: 600;
        color: #0d2f4f;
        margin-bottom: 5px;
    }

    .product-checkout-quantity {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .product-checkout-price {
        font-weight: 700;
        color: #de419a;
        font-size: 1.1rem;
    }

    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 15px;
        background: #e8f5e9;
        border-radius: 10px;
        margin-top: 20px;
        color: #2e7d32;
    }
</style>

<div class="checkout-section">
    <div class="container">
        <div class="section-title">
            <h2>Finaliser ma commande</h2>
        </div>

        <div class="row">
            <!-- Récapitulatif de la commande -->
            <div class="col-lg-8">
                <div class="checkout-card">
                    <h4 class="mb-4">Récapitulatif du panier</h4>
                    
                    @php
                        $total = 0;
                    @endphp

                    @forelse($cartItems as $item)
                        <div class="product-checkout-item">
                            <div>
                                @if($item->product_image)
                                    <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}" class="product-checkout-img">
                                @else
                                    <img src="https://placehold.co/400x400/1a4f7a/ffffff?text=Produit" alt="{{ $item->product_name }}" class="product-checkout-img">
                                @endif
                            </div>
                            <div class="product-checkout-details">
                                <div class="product-checkout-name">{{ $item->product_name }}</div>
                                <div class="product-checkout-quantity">Quantité: {{ $item->quantity }}</div>
                            </div>
                            <div class="product-checkout-price">
                                {{ number_format($item->subtotal, 2, ',', ' ') }}€
                            </div>
                        </div>
                        @php
                            $total += $item->subtotal;
                        @endphp
                    @empty
                        <p class="text-center text-muted">Votre panier est vide</p>
                    @endforelse
                </div>
            </div>

            <!-- Résumé et paiement -->
            <div class="col-lg-4">
                <div class="checkout-card">
                    <h4 class="mb-4">Résumé de la commande</h4>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-store"></i> <strong>Retrait en magasin</strong><br>
                        <small>Les commandes sont à retirer à notre atelier</small>
                    </div>
                    
                    <div class="order-summary-item">
                        <span>Sous-total</span>
                        <span>{{ number_format($total, 2, ',', ' ') }}€</span>
                    </div>
                    
                    <div class="order-summary-item order-total">
                        <span>Total à payer</span>
                        <span>{{ number_format($total, 2, ',', ' ') }}€</span>
                    </div>

                    <!-- Formulaire de paiement Stripe -->
                    <form action="{{ route('payment.checkout') }}" method="POST" id="payment-form">
                        @csrf
                        <button type="submit" class="btn-payment" id="checkout-button">
                            <i class="fas fa-lock payment-icon"></i>
                            <span>Payer avec Stripe</span>
                        </button>
                    </form>

                    <div class="secure-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Paiement 100% sécurisé</span>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Propulsé par <strong>Stripe</strong> - Vos informations de paiement sont protégées
                        </small>
                    </div>
                </div>

                <!-- Retour au panier -->
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-3">
                    <i class="fas fa-arrow-left"></i> Retour au panier
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('payment-form').addEventListener('submit', function(e) {
    const button = document.getElementById('checkout-button');
    
    // Créer le spinner
    const spinner = document.createElement('span');
    spinner.className = 'spinner';
    
    // Modifier le contenu du bouton
    button.disabled = true;
    button.innerHTML = '';
    button.appendChild(spinner);
    
    const text = document.createElement('span');
    text.textContent = ' Redirection vers Stripe...';
    button.appendChild(text);
});
</script>
@endpush
