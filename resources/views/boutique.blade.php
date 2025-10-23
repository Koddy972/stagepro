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
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
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
        margin-bottom: 30px;
    }
    
    .filter-group h4 {
        font-size: 1.1rem;
        color: var(--dark-blue);
        margin-bottom: 10px;
        font-weight: 600;
    }
    
    .filter-group ul {
        list-style: none;
        padding: 0;
    }
    
    .filter-group ul li a {
        display: block;
        padding: 8px 0;
        color: var(--text-gray);
        text-decoration: none;
        transition: color 0.2s, padding-left 0.2s;
        border-radius: 4px;
    }

    .filter-group ul li a:hover,
    .filter-group ul li a.active-filter {
        color: var(--gold);
        font-weight: 500;
        padding-left: 5px;
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
        border-radius: 4px;
        border: 1px solid #ccc;
        font-family: 'Montserrat', sans-serif;
        color: var(--dark-blue);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 320px));
        gap: 30px;
        justify-content: start;
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
        width: 100%;
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
        font-size: 0.8rem;
        color: var(--text-gray);
        font-weight: 500;
        margin-bottom: 15px;
        display: block;
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
        transition: background-color 0.3s;
        border: 1px solid var(--medium-blue);
        text-align: center;
        font-weight: 600;
        cursor: pointer;
    }

    .product-btn:hover {
        background-color: var(--gold);
        color: var(--dark-blue);
        border-color: var(--gold);
    }
    
    /* Responsive */
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

<!-- Hero Section spécifique à la Boutique -->
<section class="boutique-hero">
    <div class="container">
        <h1>Découvrez nos Produits Essentiels</h1>
        <p>Accessoires de voilerie, matériel de réparation et produits d'entretien professionnels pour bateaux et véhicules.</p>
    </div>
</section>

<!-- Contenu Principal de la Boutique -->
<section class="main-boutique">
    <div class="container boutique-content">
        
        <!-- Colonne latérale de filtres/catégories -->
        <aside class="sidebar">
            <h3>Catégories de Produits</h3>

            <div class="filter-group">
                <h4>Voilerie & Accastillage</h4>
                <ul>
                    <li><a href="#" class="active-filter">Toutes les Voiles</a></li>
                    <li><a href="#">Cordages & Écoutes</a></li>
                    <li><a href="#">Mousquetons & Cosses</a></li>
                </ul>
            </div>

            <div class="filter-group">
                <h4>Matériel de Couture</h4>
                <ul>
                    <li><a href="#">Fils et Aiguilles</a></li>
                    <li><a href="#">Tissus Techniques</a></li>
                    <li><a href="#">Kits de Réparation</a></li>
                </ul>
            </div>

            <div class="filter-group">
                <h4>Protection & Entretien</h4>
                <ul>
                    <li><a href="#">Produits Imperméabilisants</a></li>
                    <li><a href="#">Nettoyants Professionnels</a></li>
                    <li><a href="#">Accessoires Bâches</a></li>
                </ul>
            </div>
            
            <a href="#" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Voir les Promos</a>
        </aside>

        <!-- Grille des Produits -->
        <div class="products-section">
            <div class="products-header">
                <h2>{{ $products->count() }} Articles trouvés</h2>
                <select name="sort" id="sort-by" class="form-select" style="max-width: 300px;">
                    <option value="pop">Trier par Popularité</option>
                    <option value="price-asc">Prix : du moins cher au plus cher</option>
                    <option value="price-desc">Prix : du plus cher au moins cher</option>
                    <option value="new">Nouveautés</option>
                </select>
            </div>
