@extends('layouts.app')

@section('title', $product->name . ' - Caraïbes Voiles Manutention')

@push('styles')
<style>
    /* Section Produit */
    .product-section {
        padding: 80px 0;
        background-color: var(--white);
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        align-items: flex-start;
    }

    .product-image-gallery {
        flex: 1 1 500px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .main-image {
        width: 100%;
        height: 500px;
        background-color: #f0f0f0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
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
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        border: 2px solid transparent;
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
        padding: 20px;
    }

    .product-details h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--dark-blue);
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gold);
        margin-bottom: 20px;
    }

    .product-description {
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .product-features {
        margin-bottom: 30px;
    }

    .product-features h3 {
        font-size: 1.2rem;
        color: var(--dark-blue);
        margin-bottom: 10px;
    }

    .product-features ul {
        list-style: none;
    }

    .product-features li {
        margin-bottom: 8px;
        position: relative;
        padding-left: 25px;
    }

    .product-features li::before {
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        color: var(--gold);
        position: absolute;
        left: 0;
        top: 0;
    }

    .product-options {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        align-items: center;
    }

    .product-options select,
    .product-options input[type="number"] {
        padding: 10px 15px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-family: 'Montserrat', sans-serif;
    }

    .add-to-cart-btn {
        background-color: var(--gold);
        color: var(--dark-blue);
        padding: 15px 30px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s;
        border: 1px solid var(--gold);
        cursor: pointer;
    }

    .add-to-cart-btn:hover {
        background-color: var(--dark-blue);
        color: var(--gold);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .stock-status {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .in-stock {
        background: rgba(39, 174, 96, 0.1);
        color: #27ae60;
    }

    .out-stock {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
    }

    /* Section "Produits Similaires" */
    .related-products {
        padding: 80px 0;
        background-color: var(--light-blue);
    }

    .section-title {
        text-align: center;
        margin-bottom: 60px;
        color: var(--dark-blue);
        position: relative;
    }

    .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        margin-bottom: 15px;
    }

    .section-title:after {
        content: '';
        position: absolute;
        width: 60px;
        height: 3px;
        background-color: var(--gold);
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .product-card {
        background: var(--white);
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s, box-shadow 0.3s;
        text-align: center;
        border: 1px solid #f1f1f1;
        height: 100%;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        width: 100%;
        height: 250px;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
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
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-content h3 {
        color: var(--dark-blue);
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .product-content p {
        color: var(--text-gray);
        font-size: 1rem;
        margin-bottom: 15px;
        flex-grow: 1;
    }

    .product-btn {
        display: block;
        background-color: var(--dark-blue);
        color: var(--white);
        padding: 12px 25px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        border: 1px solid var(--dark-blue);
        text-align: center;
    }

    .product-btn:hover {
        background-color: var(--gold);
        color: var(--dark-blue);
        border-color: var(--gold);
    }

    @media (max-width: 768px) {
        .product-container {
            flex-direction: column;
            align-items: center;
        }
        
        .product-image-gallery, .product-details {
            flex: 1 1 100%;
            max-width: 100%;
        }
        
        .main-image {
            height: 400px;
        }
    }
</style>
@endpush

@section('content')

<!-- Section Produit -->
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
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Thumbnail 4">
                    @else
                        <img src="https://placehold.co/80x80/1a4f7a/ffffff?text=1" alt="Thumbnail 1" class="active">
                        <img src="https://placehold.co/80x80/de419a/ffffff?text=2" alt="Thumbnail 2">
                        <img src="https://placehold.co/80x80/0d2f4f/ffffff?text=3" alt="Thumbnail 3">
                        <img src="https://placehold.co/80x80/5c5c5c/ffffff?text=4" alt="Thumbnail 4">
                    @endif
                </div>
            </div>
            <div class="product-details">
                <h1>{{ $product->name }}</h1>
                
                @if($product->in_stock)
                    <span class="stock-status in-stock">
                        <i class="fas fa-check-circle"></i> En stock
                    </span>
                @else
                    <span class="stock-status out-stock">
                        <i class="fas fa-times-circle"></i> Rupture de stock
                    </span>
                @endif

                <div class="product-price">€{{ number_format($product->price, 2) }}</div>
                
                <div class="product-description">
                    <p>{{ $product->description }}</p>
                </div>

                @if($product->features && is_array($product->features) && count($product->features) > 0)
                    <div class="product-features">
                        <h3>Caractéristiques Principales :</h3>
                        <ul>
                            @foreach($product->features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($product->in_stock)
                    <div class="product-options">
                        <div class="quantity-selector">
                            <span>Quantité:</span>
                            <input type="number" id="quantity" value="1" min="1">
                        </div>
                    </div>
                    
                    <form action="{{ route('cart.add', $product) }}" method="POST" id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" class="add-to-cart-btn">
                            <i class="fas fa-shopping-cart"></i> Ajouter au panier
                        </button>
                    </form>
                @else
                    <button class="add-to-cart-btn" disabled>
                        <i class="fas fa-times-circle"></i> Produit indisponible
                    </button>
                @endif

                <a href="{{ route('boutique') }}" class="back-link" style="display: inline-flex; align-items: center; gap: 8px; color: var(--dark-blue); text-decoration: none; font-weight: 600; margin-top: 20px;">
                    <i class="fas fa-arrow-left"></i> Retour à la boutique
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Section Produits Similaires -->
<section class="related-products">
    <div class="container">
        <div class="section-title">
            <h2>Produits Similaires</h2>
        </div>
        <div class="products-grid">
            @php
                $relatedProducts = App\Models\Product::where('id', '!=', $product->id)
                    ->where('in_stock', true)
                    ->take(3)
                    ->get();
            @endphp
            
            @foreach($relatedProducts as $related)
                <div class="product-card" onclick="window.location.href='{{ route('products.show', $related) }}'">
                    <div class="product-image">
                        @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                        @else
                            <img src="https://placehold.co/400x400/1a4f7a/ffffff?text={{ urlencode(Str::limit($related->name, 20)) }}" alt="{{ $related->name }}">
                        @endif
                    </div>
                    <div class="product-content">
                        <h3>{{ Str::limit($related->name, 40) }}</h3>
                        <p>{{ Str::limit($related->description, 80) }}</p>
                        <div class="product-price">€{{ number_format($related->price, 2) }}</div>
                        <a href="{{ route('products.show', $related) }}" class="product-btn" onclick="event.stopPropagation();">Voir le produit</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Script pour changer l'image principale au clic sur les vignettes
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.product-thumbnails img');
        const quantityInput = document.getElementById('quantity');
        const formQuantity = document.getElementById('form-quantity');

        // Gestion des vignettes
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                thumbnails.forEach(img => img.classList.remove('active'));
                this.classList.add('active');
                mainImage.src = this.src.replace('/80x80/', '/800x800/');
            });
        });

        // Synchroniser la quantité avec le formulaire
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
                        // Afficher une notification de succès
                        showNotification('Produit ajouté au panier !', 'success');
                        
                        // Mettre à jour le compteur du panier
                        if (window.updateCartCount) {
                            window.updateCartCount();
                        } else {
                            updateCartCountLocal();
                        }
                    } else {
                        showNotification('Erreur lors de l\'ajout au panier', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Une erreur est survenue', 'error');
                });
            });
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
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
            
            // Retirer après 3 secondes
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
