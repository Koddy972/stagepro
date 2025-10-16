@extends('layouts.app')

@section('title', 'Boutique - Caraïbes Voiles Manutention')

@push('styles')
<style>
    /* Hero spécifique à la boutique */
    .boutique-hero {
        background: linear-gradient(rgba(13, 47, 79, 0.9), rgba(13, 47, 79, 0.8)), url('{{ asset("images/hero-boutique3.jpg") }}');
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        text-align: center;
        color: var(--white);
        margin-bottom: 40px;
    }
    
    .boutique-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        margin-bottom: 10px;
    }
    
    .boutique-hero p {
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
        opacity: 0.9;
    }

    /* Barre latérale de filtres */
    .boutique-content {
        display: flex;
        gap: 40px;
        padding: 40px 0 80px;
        align-items: flex-start;
    }

    .sidebar {
        flex: 0 0 250px;
        background: var(--white);
        padding: 25px;
        border-radius: 8px;        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 120px;
    }
    
    .sidebar h3 {
        font-size: 1.4rem;
        color: var(--dark-blue);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--light-blue);
    }

    .filter-group {
        margin-bottom: 25px;
    }
    
    .filter-group h4 {
        font-size: 1.1rem;
        color: var(--dark-blue);
        margin-bottom: 12px;
        font-weight: 600;
    }
    
    .category-filter {
        display: block;
        padding: 10px 12px;
        color: var(--text-gray);
        text-decoration: none;
        transition: all 0.3s;
        border-radius: 6px;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-filter:hover,
    .category-filter.active {
        background: var(--light-blue);
        color: var(--gold);
        font-weight: 600;
        padding-left: 16px;
    }

    .category-count {
        background: var(--light-blue);
        color: var(--dark-blue);
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    /* Grille de Produits */
    .products-section {
        flex-grow: 1;
    }
    
    .products-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    .products-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--dark-blue);
    }

    .products-header select {
        padding: 10px 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-family: 'Montserrat', sans-serif;
        color: var(--dark-blue);
        cursor: pointer;
        transition: border-color 0.3s;
    }

    .products-header select:focus {
        outline: none;
        border-color: var(--gold);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }
    
    .product-card {
        background: var(--white);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        text-align: center;
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f1f1;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        width: 100%;
        height: 220px;
        background-color: var(--light-blue);
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
        font-size: 1.4rem;
        margin-bottom: 8px;
    }
    
    .product-content .category-tag {
        font-size: 0.85rem;
        color: var(--white);
        background: var(--medium-blue);
        padding: 4px 12px;
        border-radius: 12px;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 15px;
    }

    .product-price {
        font-weight: 700;
        color: var(--gold);
        font-size: 1.8rem;
        margin: 15px 0 20px;
    }

    .product-btn {
        display: block;
        background-color: var(--medium-blue);
        color: var(--white);
        padding: 12px 25px;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s;
        border: 1px solid var(--medium-blue);
        text-align: center;
        font-weight: 600;
    }

    .product-btn:hover {
        background-color: var(--gold);
        color: var(--dark-blue);
        border-color: var(--gold);
        transform: translateY(-2px);
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--text-gray);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--dark-blue);
        margin-bottom: 10px;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: var(--text-gray);
    }

    .reset-filter-btn {
        background: var(--gold);
        color: var(--white);
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        margin-top: 20px;
        transition: all 0.3s;
    }

    .reset-filter-btn:hover {
        background: var(--dark-blue);
        transform: translateY(-2px);
    }

    @media (max-width: 992px) {
        .boutique-content {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            margin-bottom: 30px;
            position: static;
        }
        
        .products-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }

    @media (max-width: 768px) {
        .boutique-hero h1 {
            font-size: 2.2rem;
        }
        
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<section class="boutique-hero">
    <div class="container">
        <h1>Découvrez nos Produits Essentiels</h1>
        <p>Accessoires de voilerie, matériel et produits d'entretien professionnels pour bateaux et véhicules.</p>
    </div>
</section>

<section class="main-boutique">
    <div class="container boutique-content">
        <aside class="sidebar">
            <h3>📋 Catégories</h3>
            <div class="filter-group">
                <a href="{{ route('boutique') }}" 
                   class="category-filter {{ !request('category') ? 'active' : '' }}">
                    <span>🔹 Tous les produits</span>
                    <span class="category-count">{{ $products->count() }}</span>
                </a>
                
                @foreach($categories as $category)
                    <a href="{{ route('boutique', ['category' => $category->id]) }}" 
                       class="category-filter {{ request('category') == $category->id ? 'active' : '' }}">
                        <span>{{ $category->name }}</span>
                        <span class="category-count">{{ $category->products()->where('in_stock', true)->count() }}</span>
                    </a>
                @endforeach
            </div>
        </aside>

        <div class="products-section">
            <div class="products-header">
                <h2>
                    @if(request('category'))
                        @php
                            $selectedCategory = $categories->firstWhere('id', request('category'));
                        @endphp
                        {{ $selectedCategory ? $selectedCategory->name : 'Catégorie' }} - 
                    @endif
                    {{ $products->count() }} Article(s)
                </h2>
                <form method="GET" action="{{ route('boutique') }}" id="sortForm">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <select name="sort" id="sort-by" onchange="document.getElementById('sortForm').submit()">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Trier par Nom (A-Z)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix : Croissant</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix : Décroissant</option>
                    </select>
                </form>
            </div>
            
            <div class="products-grid">
                @forelse($products as $product)
                    <div class="product-card" onclick="window.location.href='{{ route('products.show', $product) }}'">
                        <div class="product-image">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://placehold.co/400x220/1a4f7a/ffffff?text={{ urlencode(Str::limit($product->name, 20)) }}" 
                                     alt="{{ $product->name }}">
                            @endif
                        </div>
                        <div class="product-content">
                            <div>
                                <h3>{{ Str::limit($product->name, 40) }}</h3>
                                @if($product->category)
                                    <span class="category-tag">{{ $product->category->name }}</span>
                                @endif
                            </div>
                            <div>
                                <div class="product-price">{{ number_format($product->price, 2) }} €</div>
                                <a href="{{ route('products.show', $product) }}" 
                                   class="product-btn" 
                                   onclick="event.stopPropagation();">
                                    Voir le produit
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <h3>Aucun produit trouvé</h3>
                        <p>
                            @if(request('category'))
                                Aucun produit disponible dans cette catégorie pour le moment.
                                <br>
                                <button onclick="window.location.href='{{ route('boutique') }}'" class="reset-filter-btn">
                                    Voir tous les produits
                                </button>
                            @else
                                Nos produits seront bientôt disponibles. Revenez plus tard !
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection