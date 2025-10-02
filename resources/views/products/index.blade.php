@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des produits</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
    </div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50" height="50" class="img-thumbnail">
                    @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-image text-white"></i>
                        </div>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2, ',', ' ') }} €</td>
                <td>
                    @if($product->in_stock)
                        <span class="badge bg-success">En stock</span>
                    @else
                        <span class="badge bg-danger">Rupture</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection