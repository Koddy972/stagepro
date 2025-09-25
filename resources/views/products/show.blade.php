@extends('layouts.app')

@section('title', $product->name . ' - Détails du Produit')

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
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Image 1" class="active">
                    @else
                        <img src="https://placehold.co/80x80/1a4f7a/ffffff?text=Image+1" alt="Image 1" class="active">
                    @endif
                    <!-- Vous pouvez ajouter d'autres images ici si vous avez un système de galerie multiple -->
                    <img src="https://placehold.co/80x80/de419a/ffffff?text=Image+2" alt="Thumbnail 2">
                    <img src="https://placehold.co/80x80/0d2f4f/ffffff?text=Image+3" alt="Thumbnail 3">
                </div>
            </div>
            <div class="product-details">
                <h1>{{ $product->name }}</h1>
                <div class="product-price">{{ number_format($product->price, 2) }}€</div>
                <div class="product-description">
                    <p>{{ $product->description }}</p>
                </div>
                
                @if($product->in_stock)
                    <div class="product-features">
                        <h3>Caractéristiques Principales :</h3>
                        <ul>
                            <li>Produit de qualité supérieure</li>
                            <li>Livraison rapide</li>
                            <li>Garantie satisfaction</li>
                            <li>Service client disponible</li>
                        </ul>
                    </div>
                @else
                    <div class="out-of-stock">
                        <p style="color: #e74c3c; font-weight: bold;">Produit actuellement en rupture de stock</p>
                    </div>
                @endif

                <div class="product-options">
                    <div class="quantity-selector">
                        <span>Quantité:</span>
                        <input type="number" id="quantity" value="1" min="1" {{ !$product->in_stock ? 'disabled' : '' }}>
                    </div>
                </div>

                @if($product->in_stock)
                    <button type="button" class="add-to-cart-btn" id="add-to-cart-btn" data-product-id="{{ $product->id }}">
                        <span class="btn-text">Ajouter au panier</span>
                        <span class="btn-loading" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Ajout en cours...
                        </span>
                    </button>
                @else
                    <button class="add-to-cart-btn" disabled style="opacity: 0.5; cursor: not-allowed;">
                        Produit indisponible
                    </button>
                @endif

                <div style="margin-top: 20px;">
                    <a href="{{ route('boutique') }}" style="color: var(--dark-blue); text-decoration: none;">
                        <i class="fas fa-arrow-left"></i> Retour à la boutique
                    </a>
                </div>
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
                    ->limit(3)
                    ->get();
            @endphp

            @forelse($relatedProducts as $relatedProduct)
                <div class="product-card">
                    <div class="product-image">
                        @if($relatedProduct->image)
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}">
                        @else
                            <img src="https://placehold.co/400x400/de419a/ffffff?text={{ urlencode($relatedProduct->name) }}" alt="{{ $relatedProduct->name }}">
                        @endif
                    </div>
                    <div class="product-content">
                        <h3>{{ Str::limit($relatedProduct->name, 30) }}</h3>
                        <p>{{ Str::limit($relatedProduct->description, 80) }}</p>
                        <div class="product-price">{{ number_format($relatedProduct->price, 2) }}€</div>
                        <a href="{{ route('products.show', $relatedProduct) }}" class="product-btn">Voir le produit</a>
                    </div>
                </div>
            @empty
                <p>Aucun produit similaire disponible pour le moment.</p>
            @endforelse
        </div>
    </div>
</section>

<style>
    /* Variables CSS pour les couleurs */
    :root {
        --dark-blue: #0d2f4f;
        --medium-blue: #1a4f7a;
        --light-blue: #e9f1f7;
        --gold: #de419a;
        --dark-gold: #a98b56;
        --white: #ffffff;
        --light-gray: #f8f9fa;
        --dark-gray: #2d3436;
        --text-gray: #5c5c5c;
    }

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
        content: "\f00c"; /* Font Awesome check icon */
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

    .add-to-cart-btn:hover:not(:disabled) {
        background-color: var(--dark-blue);
        color: var(--gold);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .add-to-cart-btn.loading {
        opacity: 0.7;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Message de notification */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 5px;
        color: white;
        font-weight: 600;
        z-index: 1000;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease-in-out;
    }

    .notification.show {
        opacity: 1;
        transform: translateX(0);
    }

    .notification.success {
        background-color: #27ae60;
    }

    .notification.error {
        background-color: #e74c3c;
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

    /* Styles responsifs */
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

        .product-details h1 {
            font-size: 2rem;
        }

        .product-price {
            font-size: 1.5rem;
        }
    }
</style>

<script>
    // Script pour changer l'image principale au clic sur les vignettes
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.product-thumbnails img');
        const quantityInput = document.getElementById('quantity');
        const addToCartBtn = document.getElementById('add-to-cart-btn');

        // Gestion des vignettes
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                thumbnails.forEach(img => img.classList.remove('active'));
                this.classList.add('active');
                mainImage.src = this.src;
            });
        });

        // Gestion de l'ajout au panier avec AJAX
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const quantity = quantityInput ? quantityInput.value : 1;
                const btnText = this.querySelector('.btn-text');
                const btnLoading = this.querySelector('.btn-loading');
                
                // Désactiver le bouton et afficher le loading
                this.classList.add('loading');
                btnText.style.display = 'none';
                btnLoading.style.display = 'inline';
                
                // Préparer les données
                const formData = new FormData();
                formData.append('quantity', quantity);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                // Envoyer la requête AJAX
                fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Restaurer le bouton
                    this.classList.remove('loading');
                    btnText.style.display = 'inline';
                    btnLoading.style.display = 'none';
                    
                    if (data.success) {
                        // Afficher un message de succès
                        if (typeof window.showNotification === 'function') {
                            window.showNotification(data.message);
                        } else {
                            showNotification(data.message, 'success');
                        }
                        
                        // Mettre à jour le compteur du panier
                        if (typeof window.updateCartCount === 'function') {
                            window.updateCartCount();
                        } else {
                            updateCartCount(data.cart_count);
                        }
                        
                        // Animation de succès sur le bouton
                        const originalText = btnText.textContent;
                        btnText.textContent = '✓ Ajouté !';
                        btnText.style.color = '#27ae60';
                        
                        setTimeout(() => {
                            btnText.textContent = originalText;
                            btnText.style.color = '';
                        }, 2000);
                        
                    } else {
                        const message = data.message || 'Erreur lors de l\'ajout au panier';
                        if (typeof window.showNotification === 'function') {
                            window.showNotification(message, 'error');
                        } else {
                            showNotification(message, 'error');
                        }
                    }
                })
                .catch(error => {
                    // Restaurer le bouton
                    this.classList.remove('loading');
                    btnText.style.display = 'inline';
                    btnLoading.style.display = 'none';
                    
                    console.error('Erreur:', error);
                    showNotification('Erreur lors de l\'ajout au panier', 'error');
                });
            });
        }

        // Fonction pour afficher les notifications
        function showNotification(message, type) {
            // Supprimer les anciennes notifications
            const oldNotifications = document.querySelectorAll('.notification');
            oldNotifications.forEach(notif => notif.remove());
            
            // Créer la nouvelle notification
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            
            // Ajouter au DOM
            document.body.appendChild(notification);
            
            // Afficher la notification
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Masquer après 3 secondes
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Fonction pour mettre à jour le compteur du panier
        function updateCartCount(count) {
            const cartCountElements = document.querySelectorAll('.cart-count, [data-cart-count]');
            cartCountElements.forEach(element => {
                element.textContent = count;
                if (count > 0) {
                    element.style.display = 'inline';
                } else {
                    element.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection