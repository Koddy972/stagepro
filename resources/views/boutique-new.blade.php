@extends('layouts.app')

@section('title', 'Boutique - Caraïbes Voiles Manutention')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5" style="color: var(--dark-blue); font-family: 'Playfair Display', serif;">
        Notre Boutique
    </h1>
    <p class="text-center mb-5" style="color: var(--text-gray); max-width: 600px; margin: 0 auto;">
        Découvrez notre sélection d'accessoires de qualité pour l'entretien et la protection de vos voiles et équipements
    </p>

    @if($products && $products->count() > 0)
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s; cursor: pointer;" onclick="window.location.href='{{ route('products.show', $product) }}'">
                        <div class="card-img-top" style="height: 250px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="fas fa-image" style="font-size: 3rem; color: #dee2e6;"></i>
                            @endif
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="color: var(--dark-blue); font-family: 'Playfair Display', serif;">
                                {{ $product->name }}
                            </h5>
                            <p class="card-text flex-grow-1" style="color: var(--text-gray);">
                                {{ Str::limit($product->description, 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="h4 mb-0" style="color: var(--gold); font-weight: 700;">
                                    {{ number_format($product->price, 2) }} €
                                </span>
                                <a href="{{ route('products.show', $product) }}" 
                                   class="btn btn-primary" 
                                   onclick="event.stopPropagation();"
                                   style="background-color: var(--dark-blue); border-color: var(--dark-blue);">
                                    <i class="fas fa-eye"></i> Voir le produit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination si nécessaire -->
        @if(method_exists($products, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="fas fa-store fa-5x text-muted mb-3"></i>
            <h3>Boutique en cours de mise à jour</h3>
            <p class="text-muted">Nos produits seront bientôt disponibles. Revenez nous voir !</p>
        </div>
    @endif
</div>
@endsection