@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Mon Panier</h1>
    
    @if($cartItems->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Articles dans votre panier ({{ $cartItems->sum('quantity') }} articles)</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cartItems as $item)
                            <div class="row cart-item mb-3 pb-3 border-bottom" data-item-id="{{ $item->id }}">
                                <div class="col-md-2">
                                    @if($item->product_image)
                                        <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}" class="img-fluid rounded">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h6 class="product-name">{{ $item->product_name }}</h6>
                                    <small class="text-muted">Prix unitaire: {{ number_format($item->product_price, 2) }} €</small>
                                </div>
                                <div class="col-md-3">
                                    <div class="quantity-controls">
                                        <label class="form-label">Quantité:</label>
                                        <div class="input-group" style="max-width: 120px;">
                                            <button type="button" class="btn btn-outline-secondary btn-sm quantity-btn" data-action="decrease">-</button>                            <input type="number" class="form-control form-control-sm text-center quantity-input" value="{{ $item->quantity }}" min="1" max="99">
                                            <button type="button" class="btn btn-outline-secondary btn-sm quantity-btn" data-action="increase">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-end">
                                        <div class="fw-bold subtotal">{{ number_format($item->subtotal, 2) }} €</div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-outline-danger btn-sm remove-item" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-3">
                    <button type="button" class="btn btn-outline-warning" id="clear-cart">
                        <i class="fas fa-trash-alt"></i> Vider le panier
                    </button>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Récapitulatif de la commande</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sous-total:</span>
                            <span id="cart-subtotal">{{ number_format($total, 2) }} €</span>
                        </div>                        <div class="d-flex justify-content-between mb-2">
                            <span>Livraison:</span>
                            <span class="text-success">Gratuite</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong id="cart-total">{{ number_format($total, 2) }} €</strong>
                        </div>
                        
                        <button type="button" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-credit-card"></i> Passer la commande
                        </button>
                        
                        <a href="{{ route('accueil') }}#boutique" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left"></i> Continuer mes achats
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
            <h3>Votre panier est vide</h3>
            <p class="text-muted">Découvrez nos produits et ajoutez-les à votre panier</p>
            <a href="{{ route('accueil') }}#boutique" class="btn btn-primary">
                <i class="fas fa-store"></i> Voir la boutique
            </a>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des quantités    document.querySelectorAll('.quantity-btn').forEach(button => {
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
        });    });
    
    // Vider le panier
    document.getElementById('clear-cart')?.addEventListener('click', function() {
        if (confirm('Êtes-vous sûr de vouloir vider votre panier ?')) {
            clearCart();
        }
    });
    
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
                cartItem.querySelector('.subtotal').textContent = data.subtotal.toFixed(2) + ' €';
                updateCartTotals();
                updateCartCount(data.cart_count);
                showNotification(data.message, 'success');
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Une erreur s\'est produite', 'error');
        });
    }
    
    function removeItem(itemId, cartItem) {        fetch(`/cart/remove/${itemId}`, {
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
                showNotification(data.message, 'success');
                
                // Si le panier est vide, recharger la page pour afficher le message
                if (data.cart_count === 0) {
                    setTimeout(() => location.reload(), 1000);
                }
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Une erreur s\'est produite', 'error');
        });
    }
    
    function clearCart() {
        fetch('/cart/clear', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Une erreur s\'est produite', 'error');
        });
    }
    
    function updateCartTotals() {
        let subtotal = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const subtotalElement = item.querySelector('.subtotal');
            const amount = parseFloat(subtotalElement.textContent.replace(' €', '').replace(',', '.'));
            subtotal += amount;
        });
        
        document.getElementById('cart-subtotal').textContent = subtotal.toFixed(2) + ' €';
        document.getElementById('cart-total').textContent = subtotal.toFixed(2) + ' €';
    }
    
    function updateCartCount(count) {
        const cartCountElement = document.querySelector('.cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = count;
        }
    }
    
    function showNotification(message, type) {        // Créer et afficher une notification
        const alert = document.createElement('div');
        alert.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
        alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alert);
        
        // Supprimer automatiquement après 5 secondes
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    }
});
</script>
@endpush