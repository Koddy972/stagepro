@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Détails du produit</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height: 200px;">
                                <i class="fas fa-image fa-3x text-white"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3>{{ $product->name }}</h3>
                        <p class="text-muted">{{ number_format($product->price, 2, ',', ' ') }} €</p>
                        
                        <div class="mb-3">
                            @if($product->in_stock)
                                <span class="badge bg-success">En stock</span>
                            @else
                                <span class="badge bg-danger">Rupture de stock</span>
                            @endif
                        </div>
                        
                        <p>{{ $product->description }}</p>
                        
                        <div class="mt-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection