@extends('layouts.app')

@section('content')
<style>
    .cart-section {
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

    .cart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        align-items: flex-start;
    }

    .cart-items {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 20px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px 0;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.3s;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item:hover {
        background-color: #fafafa;
    }

    .item-image {
        width: 100px;
        height: 100px;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex-grow: 1;
    }

    .item-details h3 {
        font-size: 1.2rem;
        color: #0d2f4f;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .item-details p {
        color: #5c5c5c;
        font-size: 0.9rem;
    }

    .item-controls {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }

    .quantity-btn {
        background: none;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 1rem;
        color: #0d2f4f;
        transition: background-color 0.3s;
    }

    .quantity-btn:hover {
        background-color: #e9f1f7;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        border: none;
        outline: none;
        font-size: 1rem;
        -moz-appearance: textfield;
        padding: 5px;
    }
    
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .item-subtotal {
        font-weight: 600;
        color: #0d2f4f;
        font-size: 1.1rem;
        min-width: 80px;
        text-align: right;
    }

    .remove-btn {
        background: none;
        border: none;
        color: #d63031;
        font-size: 1.2rem;
        cursor: pointer;
        transition: color 0.3s;
        padding: 5px;
    }
    
    .remove-btn:hover {
        color: #ff4757;
    }

    .cart-summary {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 30px;
        position: sticky;
        top: 120px;
    }

    .cart-summary h3 {
        font-size: 1.5rem;
        color: #0d2f4f;
        margin-bottom: 25px;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    .summary-label {
        color: #5c5c5c;
    }

    .summary-value {
        color: #0d2f4f;
        font-weight: 600;
    }

    .btn-checkout {
        display: block;
        width: 100%;
        background-color: #de419a;
        color: #ffffff;
        padding: 15px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s;
        border: none;
        margin-top: 30px;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-checkout:hover {
        background-color: #0d2f4f;
        color: #de419a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-shop {
        display: block;
        width: 100%;
        background-color: transparent;
        color: #0d2f4f;
        padding: 12px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s;
        border: 2px solid #0d2f4f;
        margin-top: 15px;
    }

    .btn-shop:hover {
        background-color: #0d2f4f;
        color: #ffffff;
    }

    .clear-cart-btn {
        background-color: transparent;
        color: #d63031;
        padding: 10px 20px;
        border: 2px solid #d63031;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 20px;
        width: 100%;
    }

    .clear-cart-btn:hover {
        background-color: #d63031;
        color: #ffffff;
    }

    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-cart i {
        color: #de419a;
        margin-bottom: 20px;
    }

    .empty-cart h3 {
        color: #0d2f4f;
        margin-bottom: 15px;
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
    }

    .empty-cart p {
        color: #5c5c5c;
        margin-bottom: 30px;
        font-size: 1.1rem;
    }

    /* Notification Toast */
    .toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #ffffff;
        padding: 20px 25px;
        border-radius: 8px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
        z-index: 9999;
        display: none;
        align-items: center;
        gap: 15px;
        min-width: 300px;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .toast.success {
        border-left: 4px solid #00b894;
    }

    .toast.error {
        border-left: 4px solid #d63031;
    }

    .toast i {
        font-size: 1.5rem;
    }

    .toast.success i {
        color: #00b894;
    }

    .toast.error i {
        color: #d63031;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }

        .cart-summary {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .section-title h2 {
            font-size: 1.8rem;
        }

        .cart-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .item-controls {
            width: 100%;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .item-image {
            width: 80px;
            height: 80px;
        }

        .item-details h3 {
            font-size: 1rem;
        }

        .cart-section {
            padding: 60px 0;
        }

        .toast {
            right: 15px;
            left: 15px;
            min-width: auto;
        }
    }
</style>

<section class="cart-section">
    <div class="container">
        <div class="section-title">
            <h2>Votre Panier d'Achat</h2>
        </div>
        
        @if($cartItems->count() > 0)
            <div class="cart-grid">
                <div class="cart-items">
                    @foreach($cartItems as $item)
                        <div class="cart-item" data-item-id="{{ $item->id }}">
                            <div class="item-image">
                                @if($item->product_image)
                                    <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}">
                                @else
                                    <img src="https://placehold.co/400x400/1a4f7a/ffffff?text=Produit" alt="{{ $item->product_name }}">
                                @endif
                            </div>
                            <div class="item-details">
                                <h3>{{ $item->product_name }}</h3>
                                <p>Prix unitaire: {{ number_format($item->product_price, 2, ',', ' ') }}€</p>
                            </div>
                            <div class="item-controls">
                                <div class="quantity-control">
                                    <button class="quantity-btn" data-action="decrease">-</button>
                                    <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="1">
                                    <button class="quantity-btn" data-action="increase">+</button>
                                </div>
                                <div class="item-subtotal">{{ number_format($item->subtotal, 2, ',', ' ') }}€</div>
                                <button class="remove-btn remove-item" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                    
                    <button type="button" class="clear-cart-btn" id="clear-cart">
                        <i class="fas fa-trash-alt"></i> Vider le panier
                    </button>
                </div>

                <div class="cart-summary">
                    <h3>Résumé de la commande</h3>
                    <div class="alert alert-info" style="margin-bottom: 20px; padding: 12px; background-color: #e8f4f8; border-left: 4px solid #0d2f4f; color: #0c5460; border-radius: 4px;">
                        <i class="fas fa-store"></i> <strong>Retrait en magasin uniquement</strong><br>
                        <small>Les commandes sont à retirer à notre atelier.</small>
                    </div>
                    <div class="summary-row">
                        <div class="summary-label">Sous-total</div>
                        <div class="summary-value" id="cart-subtotal">{{ number_format($total, 2, ',', ' ') }}€</div>
                    </div>
                    <div class="summary-row">
                        <div class="summary-label">Total</div>
                        <div class="summary-value" id="cart-total">{{ number_format($total, 2, ',', ' ') }}€</div>
                    </div>
                    @auth
                        <a href="{{ route('cart.checkout') }}" class="btn-checkout">
                            <i class="fas fa-credit-card"></i> Procéder au paiement
                        </a>
                    @else
                        <a href="{{ route('client.login') }}" class="btn-checkout">
                            <i class="fas fa-sign-in-alt"></i> Se connecter pour payer
                        </a>
                        <p style="text-align: center; margin-top: 15px; color: #5c5c5c; font-size: 0.9rem;">
                            Pas encore de compte ? 
                            <a href="{{ route('client.register') }}" style="color: #de419a; font-weight: 600; text-decoration: none;">
                                Créer un compte
                            </a>
                        </p>
                    @endauth
                    <a href="{{ route('boutique') }}" class="btn-shop">
                        <i class="fas fa-arrow-left"></i> Continuer mes achats
                    </a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <i class="fas fa-shopping-cart fa-5x"></i>
                <h3>Votre panier est vide</h3>
                <p>Découvrez nos produits et ajoutez-les à votre panier</p>
                <a href="{{ route('boutique') }}" class="btn-shop" style="display: inline-block; width: auto; padding: 12px 40px;">
                    <i class="fas fa-store"></i> Voir la boutique
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Toast notification -->
<div class="toast" id="toast">
    <i class="fas fa-check-circle"></i>
    <span id="toast-message"></span>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des quantités avec les boutons +/-
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            const itemId = cartItem.dataset.itemId;
            const input = cartItem.querySelector('.quantity-input');
            const action = this.dataset.action;
            
            let quantity = parseInt(input.value);
            
            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }
            
            input.value = quantity;
            updateQuantity(itemId, quantity, cartItem);
        });
    });
    
    // Gestion du changement direct dans l'input
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const cartItem = this.closest('.cart-item');
            const itemId = cartItem.dataset.itemId;
            const quantity = Math.max(1, parseInt(this.value) || 1);
            
            this.value = quantity;
            updateQuantity(itemId, quantity, cartItem);
        });
    });
    
    // Supprimer un article
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            const itemId = cartItem.dataset.itemId;
            
            if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
                removeItem(itemId, cartItem);
            }
        });
    });
    
    // Vider le panier
    document.getElementById('clear-cart')?.addEventListener('click', function() {
        if (confirm('Êtes-vous sûr de vouloir vider votre panier ?')) {
            clearCart();
        }
    });
    
    // Fonction pour mettre à jour la quantité
    function updateQuantity(itemId, quantity, cartItem) {
        fetch(`/cart/update/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mettre à jour le sous-total de l'article
                const subtotal = data.subtotal.toFixed(2).replace('.', ',');
                cartItem.querySelector('.item-subtotal').textContent = subtotal + '€';
                updateCartTotals();
                updateCartCount(data.cart_count);
                showNotification(data.message || 'Quantité mise à jour', 'success');
            } else {
                showNotification(data.message || 'Erreur lors de la mise à jour', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Une erreur s\'est produite', 'error');
        });
    }
    
    // Fonction pour supprimer un article
    function removeItem(itemId, cartItem) {
        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cartItem.remove();
                updateCartTotals();
                updateCartCount(data.cart_count);
                showNotification(data.message || 'Article supprimé', 'success');
                
                // Si le panier est vide, recharger la page
                if (data.cart_count === 0) {
                    setTimeout(() => location.reload(), 1000);
                }
            } else {
                showNotification(data.message || 'Erreur lors de la suppression', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Une erreur s\'est produite', 'error');
        });
    }
    
    // Fonction pour vider le panier
    function clearCart() {
        fetch('/cart/clear', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message || 'Panier vidé', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showNotification(data.message || 'Erreur', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Une erreur s\'est produite', 'error');
        });
    }
    
    // Fonction pour mettre à jour les totaux
    function updateCartTotals() {
        let subtotal = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const subtotalElement = item.querySelector('.item-subtotal');
            const amount = parseFloat(subtotalElement.textContent.replace('€', '').replace(',', '.').replace(' ', '').trim());
            subtotal += amount;
        });
        
        const formattedSubtotal = subtotal.toFixed(2).replace('.', ',');
        document.getElementById('cart-subtotal').textContent = formattedSubtotal + '€';
        document.getElementById('cart-total').textContent = formattedSubtotal + '€';
    }
    
    // Fonction pour mettre à jour le compteur du panier dans le header
    function updateCartCount(count) {
        const cartCount = document.querySelector('.cart-count');
        if (cartCount) {
            cartCount.textContent = count;
            if (count === 0) {
                cartCount.style.display = 'none';
            }
        }
    }
    
    // Fonction pour afficher les notifications
    function showNotification(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        const icon = toast.querySelector('i');
        
        // Mise à jour du contenu
        toastMessage.textContent = message;
        
        // Mise à jour du style
        toast.className = 'toast ' + type;
        icon.className = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
        
        // Affichage
        toast.style.display = 'flex';
        
        // Masquage automatique après 3 secondes
        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000);
    }
});
</script>
@endpush
