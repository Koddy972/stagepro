@extends('layouts.app')

@section('title', $product->name . ' - Caraïbes Voiles Manutention')

@push('styles')
<style>
    /* Section Produit */
    .product-section {
        padding: 40px 0;
        background-color: var(--light-gray);
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        align-items: flex-start;
        background: var(--white);
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .product-image-gallery {
        flex: 1 1 450px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .main-image {
        width: 100%;
        height: 400px;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-thumbnails {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    
    .product-thumbnails img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 4px;
        border: 2px solid #ccc;
        cursor: pointer;
        transition: border-color 0.3s, transform 0.3s;
    }
    
    .product-thumbnails img:hover,
    .product-thumbnails img.active {
        border-color: var(--gold);
        transform: scale(1.05);
    }

    .product-details {
        flex: 1 1 400px;
    }

    .product-details h1 {
        font-size: 1.8rem;
        margin-bottom: 6px;
    }

    .product-details .product-category {
        font-size: 0.85rem;
        color: var(--text-gray);
        font-weight: 500;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .product-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-blue);
        margin-bottom: 20px;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--light-blue);
    }

    .stock-badge {
        font-size: 1rem;
        color: var(--gold);
        font-weight: 500;
        margin-left: 10px;
    }

    .out-of-stock {
        color: #e74c3c;
    }

    .product-description {
        line-height: 1.6;
        margin-bottom: 20px;
        background-color: var(--light-gray);
        padding: 12px;
        border-radius: 4px;
        border-left: 4px solid var(--gold);
        font-size: 0.95rem;
    }

    /* Liste simplifiée des caractéristiques */
    .product-features-list {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
        gap: 10px;
        margin-bottom: 20px;
    }

    .product-features-list li {
        position: relative;
        padding-left: 20px;
        font-size: 0.85rem;
        color: var(--dark-blue);
        font-weight: 500;
        flex: 0 0 calc(50% - 10px);
    }

    .product-features-list li::before {
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        color: var(--gold);
        position: absolute;
        left: 0;
        top: 2px;
        font-size: 0.8rem;
    }
    
    .product-action-group {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 20px;
        padding-top: 12px;
        border-top: 1px solid #eee;
    }

    .quantity-selector span {
        font-weight: 600;
        color: var(--dark-blue);
        margin-right: 10px;
    }

    .quantity-selector input[type="number"] {
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-family: 'Montserrat', sans-serif;
        width: 70px;
        text-align: center;
    }

    .add-to-cart-btn {
        background-color: var(--gold);
        color: var(--dark-blue);
        padding: 12px 30px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s;
        border: 1px solid var(--gold);
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 10px rgba(222, 65, 154, 0.3);
    }

    .add-to-cart-btn:hover {
        background-color: var(--dark-blue);
        color: var(--gold);
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .add-to-cart-btn:disabled {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
        box-shadow: none;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--dark-blue);
        text-decoration: none;
        font-weight: 600;
        margin-top: 15px;
        transition: color 0.3s;
        font-size: 0.9rem;
    }

    .back-link:hover {
        color: var(--gold);
    }

    /* Section Produits Similaires */
    .related-products {
        padding: 50px 0;
        background-color: var(--light-blue);
    }

    .section-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .section-title h2 {
        font-size: 1.8rem;
        margin-bottom: 8px;
    }

    .section-title:after {
        content: '';
        width: 50px;
        height: 3px;
        background-color: var(--gold);
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .product-card {
        background: var(--white);
        border-radius: 6px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        width: 100%;
        height: 160px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease-in-out;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-content {
        padding: 12px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-content h3 {
        font-size: 0.95rem;
        margin-bottom: 4px;
        color: var(--dark-blue);
    }

    .product-content p {
        font-size: 0.8rem;
        margin-bottom: 8px;
        color: var(--text-gray);
        flex-grow: 1;
    }

    .product-card .product-price {
        font-weight: 700;
        color: var(--gold);
        font-size: 1.1rem;
        margin-bottom: 8px;
        border-bottom: none;
        padding-bottom: 0;
    }

    .product-btn {
        display: block;
        background-color: var(--dark-blue);
        color: var(--white);
        padding: 6px 12px;
        font-size: 0.85rem;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s;
    }

    .product-btn:hover {
        background-color: var(--gold);
        color: var(--dark-blue);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .product-container {
            padding: 15px;
        }
        
        .main-image {
            height: 300px;
        }
        
        .product-features-list li {
            flex: 0 0 100%;
        }
        
        .product-action-group {
            flex-direction: column;
            align-items: stretch;
        }
        
        .add-to-cart-btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')

<!-- Section Produit PRINCIPALE -->
<section class="product-section">
    <div class="container">
        <div class="product-container">
            <div class="product-image-gallery">
                <div class="main-image">
                    @if($product->image)
                        <img id="main-product-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <img id="main-product-image" src="https://placehold.co/800x800/1a4f7a/ffffff?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
                    @endif
                </div>
                <div class="product-thumbnails">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Thumbnail 1" class="active">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Thumbnail 2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Thumbnail 3">
                    @else
                        <img src="https://placehold.co/80x80/1a4f7a/ffffff?text=Image+1" alt="Thumbnail 1" class="active">
                        <img src="https://placehold.co/80x80/de419a/ffffff?text=Image+2" alt="Thumbnail 2">
                        <img src="https://placehold.co/80x80/0d2f4f/ffffff?text=Image+3" alt="Thumbnail 3">
                    @endif
                </div>
            </div>
            <div class="product-details">
                <div class="product-category">{{ $product->category ?? 'Accessoires et Matériel' }}</div>
                <h1>{{ $product->name }}</h1>
                
                <div class="product-price">
                    €{{ number_format($product->price, 2) }} 
                    @if($product->in_stock)
                        <span class="stock-badge">(En Stock)</span>
                    @else
                        <span class="stock-badge out-of-stock">(Rupture de stock)</span>
                    @endif
                </div>

                <div class="product-description">
                    <p>{{ $product->description }}</p>
                </div>
                
                <!-- Liste des fonctionnalités -->
                @if($product->features && is_array($product->features) && count($product->features) > 0)
                    <ul class="product-features-list">
                        @foreach($product->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                @else
                    <ul class="product-features-list">
                        <li>Qualité professionnelle</li>
                        <li>Résistant et durable</li>
                        <li>Grade Marin</li>
                        <li>Facile à utiliser</li>
                    </ul>
                @endif
                
                @if($product->in_stock)
                    <div class="product-action-group">
                        <div class="quantity-selector">
                            <span>Quantité:</span>
                            <input type="number" id="quantity" value="1" min="1">
                        </div>
                        <form action="{{ route('cart.add', $product) }}" method="POST" id="add-to-cart-form" style="margin: 0;">
                            @csrf
                            <input type="hidden" name="quantity" id="form-quantity" value="1">
                            <button type="submit" class="add-to-cart-btn">
                                <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>
                                AJOUTER AU PANIER
                            </button>
                        </form>
                    </div>
                @else
                    <div class="product-action-group">
                        <button class="add-to-cart-btn" disabled>
                            <i class="fas fa-times-circle" style="margin-right: 8px;"></i>
                            PRODUIT INDISPONIBLE
                        </button>
                    </div>
                @endif

                <a href="{{ route('boutique') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Retour à la boutique
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Section Produits Connexes -->
<section class="related-products">
    <div class="container">
        <div class="section-title">
            <h2>Produits Connexes</h2>
        </div>
        <div class="products-grid">
            @php
                $relatedProducts = App\Models\Product::where('id', '!=', $product->id)
                    ->where('in_stock', true)
                    ->take(3)
                    ->get();
            @endphp
            
            @forelse($relatedProducts as $related)
                <div class="product-card" onclick="window.location.href='{{ route('products.show', $related) }}'">
                    <div class="product-image">
                        @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                        @else
                            <img src="https://placehold.co/400x400/de419a/ffffff?text={{ urlencode(Str::limit($related->name, 15)) }}" alt="{{ $related->name }}">
                        @endif
                    </div>
                    <div class="product-content">
                        <h3>{{ Str::limit($related->name, 40) }}</h3>
                        <p>{{ Str::limit($related->description, 80) }}</p>
                        <div class="product-price">€{{ number_format($related->price, 2) }}</div>
                        <a href="{{ route('products.show', $related) }}" class="product-btn" onclick="event.stopPropagation();">Détails</a>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1/-1; text-align: center; color: var(--text-gray);">Aucun produit connexe disponible pour le moment.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des vignettes d'images
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.product-thumbnails img');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                thumbnails.forEach(img => img.classList.remove('active'));
                this.classList.add('active');
                mainImage.src = this.src.replace('/80x80/', '/800x800/');
            });
        });

        // Synchronisation de la quantité
        const quantityInput = document.getElementById('quantity');
        const formQuantity = document.getElementById('form-quantity');

        if (quantityInput && formQuantity) {
            quantityInput.addEventListener('change', function() {
                formQuantity.value = this.value;
            });
        }

        // Gestion du formulaire d'ajout au panier
        const form = document.getElementById('add-to-cart-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Notification de succès
                        if (window.showNotification) {
                            window.showNotification('Produit ajouté au panier !', 'success');
                        } else {
                            showNotificationLocal('Produit ajouté au panier !', 'success');
                        }
                        
                        // Mise à jour du compteur
                        if (window.updateCartCount) {
                            window.updateCartCount();
                        } else {
                            updateCartCountLocal();
                        }
                    } else {
                        if (window.showNotification) {
                            window.showNotification('Erreur lors de l\'ajout au panier', 'error');
                        } else {
                            showNotificationLocal('Erreur lors de l\'ajout au panier', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (window.showNotification) {
                        window.showNotification('Une erreur est survenue', 'error');
                    } else {
                        showNotificationLocal('Une erreur est survenue', 'error');
                    }
                });
            });
        }

        function showNotificationLocal(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 2000;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 12px;
                animation: slideIn 0.3s ease-out;
                min-width: 300px;
            `;
            
            if (type === 'success') {
                notification.style.background = '#27ae60';
                notification.style.color = 'white';
                notification.innerHTML = '<i class="fas fa-check-circle"></i> ' + message;
            } else {
                notification.style.background = '#e74c3c';
                notification.style.color = 'white';
                notification.innerHTML = '<i class="fas fa-times-circle"></i> ' + message;
            }
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        function updateCartCountLocal() {
            fetch('{{ route("cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    const count = data.count || data || 0;
                    const cartBadge = document.querySelector('.cart-count, #cart-count');
                    if (cartBadge) {
                        cartBadge.textContent = count;
                        cartBadge.style.display = count > 0 ? 'flex' : 'none';
                    }
                })
                .catch(error => console.error('Erreur:', error));
        }
    });

    // Animations CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
