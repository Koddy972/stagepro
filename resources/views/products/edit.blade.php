@extends('layouts.app')

@section('title', 'Modifier le Produit')

@push('styles')
<style>
    .form-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .form-card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
    }

    .form-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--dark-blue);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--dark-blue);
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.1);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-check-input {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
        font-weight: 500;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #e0e0e0;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--gold);
        color: var(--white);
    }

    .btn-primary:hover {
        background: var(--dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
        background: var(--light-blue);
        color: var(--white);
    }

    .btn-secondary:hover {
        background: var(--medium-blue);
        transform: translateY(-2px);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }

    select.form-control {
        cursor: pointer;
    }

    .current-image {
        margin-top: 10px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        display: inline-block;
    }

    .current-image img {
        max-width: 200px;
        border-radius: 5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .current-image-label {
        display: block;
        font-size: 12px;
        color: #666;
        margin-bottom: 8px;
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">✏️ Modifier le produit</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0;padding-left:20px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name" class="form-label">Nom du produit *</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $product->name) }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Catégorie *</label>
                <select class="form-control @error('category_id') is-invalid @enderror" 
                        id="category_id" 
                        name="category_id" 
                        required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description" class="form-label">Description *</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" 
                          name="description" 
                          rows="4" 
                          required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="price" class="form-label">Prix (€) *</label>
                <input type="number" 
                       step="0.01" 
                       min="0" 
                       class="form-control @error('price') is-invalid @enderror" 
                       id="price" 
                       name="price" 
                       value="{{ old('price', $product->price) }}"
                       required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" 
                           type="checkbox" 
                           id="in_stock" 
                           name="in_stock" 
                           value="1" 
                           {{ old('in_stock', $product->in_stock) ? 'checked' : '' }}>
                    <label class="form-check-label" for="in_stock">
                        Produit en stock
                    </label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="image" class="form-label">Image du produit</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*">
                <small style="color:#666;display:block;margin-top:5px">
                    Laissez vide pour conserver l'image actuelle. Formats acceptés: JPEG, PNG, JPG, GIF (Max: 2MB)
                </small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                @if($product->image)
                    <div class="current-image">
                        <span class="current-image-label">Image actuelle:</span>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                @endif
            </div>
            
            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    ← Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    ✓ Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
