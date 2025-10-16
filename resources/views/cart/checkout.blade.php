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
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 40px;
        align-items: flex-start;
    }

    .checkout-form {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 40px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section h3 {
        color: #0d2f4f;
        font-size: 1.3rem;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #0d2f4f;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #de419a;
        box-shadow: 0 0 0 3px rgba(222, 65, 154, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .order-summary {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 30px;
        position: sticky;
        top: 120px;
    }

    .order-summary h3 {
        color: #0d2f4f;
        font-size: 1.5rem;
        margin-bottom: 25px;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }

    .order-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-item-image {
        width: 60px;
        height: 60px;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .order-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .order-item-details {
        flex-grow: 1;
    }

    .order-item-details h4 {
        font-size: 0.95rem;
        color: #0d2f4f;
        margin-bottom: 5px;
    }

    .order-item-details p {
        font-size: 0.85rem;
        color: #5c5c5c;
    }

    .order-item-price {
        font-weight: 600;
        color: #0d2f4f;
        text-align: right;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .summary-row:last-of-type {
        border-bottom: none;
        font-weight: 700;
        font-size: 1.2rem;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #0d2f4f;
    }

    .btn-place-order {
        display: block;
        width: 100%;
        background-color: #de419a;
        color: #ffffff;
        padding: 15px;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 30px;
    }

    .btn-place-order:hover {
        background-color: #0d2f4f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .alert-info {
        background-color: #e8f4f8;
        color: #0c5460;
        border-left: 4px solid #0d2f4f;
    }

    @media (max-width: 992px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .order-summary {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .checkout-section {
            padding: 60px 0;
        }

        .checkout-form {
            padding: 25px;
        }

        .order-summary {
            padding: 20px;
        }
    }
</style>

<section class="checkout-section">
    <div class="container">
        <div class="section-title">
            <h2>Finaliser votre commande</h2>
        </div>

        <div class="alert alert-info">
            <i class="fas fa-user"></i> Connecté en tant que: <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})
        </div>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="checkout-grid">
                <div class="checkout-form">
                    <div class="form-section">
                        <h3><i class="fas fa-store"></i> Informations de retrait</h3>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> <strong>Retrait en magasin uniquement</strong><br>
                            Votre commande sera à retirer directement à notre atelier. Nous vous contacterons dès qu'elle sera prête.
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone de contact *</label>
                            <input type="tel" name="phone" id="phone" class="form-control" required 
                                placeholder="Ex: +596 696 00 00 00">
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes supplémentaires (optionnel)</label>
                            <textarea name="notes" id="notes" class="form-control" 
                                placeholder="Instructions ou questions concernant votre commande..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="order-summary">
                    <h3>Résumé de la commande</h3>
                    
                    @foreach($cartItems as $item)
                        <div class="order-item">
                            <div class="order-item-image">
                                @if($item->product_image)
                                    <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}">
                                @else
                                    <img src="https://placehold.co/60x60/1a4f7a/ffffff?text=P" alt="{{ $item->product_name }}">
                                @endif
                            </div>
                            <div class="order-item-details">
                                <h4>{{ $item->product_name }}</h4>
                                <p>Quantité: {{ $item->quantity }}</p>
                            </div>
                            <div class="order-item-price">
                                {{ number_format($item->subtotal, 2, ',', ' ') }}€
                            </div>
                        </div>
                    @endforeach

                    <div class="summary-row">
                        <div>Sous-total</div>
                        <div>{{ number_format($total, 2, ',', ' ') }}€</div>
                    </div>
                    <div class="summary-row">
                        <div>Total</div>
                        <div>{{ number_format($total, 2, ',', ' ') }}€</div>
                    </div>

                    <button type="submit" class="btn-place-order">
                        <i class="fas fa-check-circle"></i> Confirmer la commande
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
