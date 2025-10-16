@extends('layouts.app')

@section('title', 'Gestion de la Galerie - Admin')

@push('styles')
<style>
    .admin-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 3px solid var(--gold);
    }

    .admin-header h1 {
        color: var(--dark-blue);
        font-size: 2rem;
        margin: 0;
    }

    .btn-group {
        display: flex;
        gap: 10px;
    }

    .btn-add {
        background-color: var(--gold);
        color: var(--white);
        padding: 12px 25px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add:hover {
        background-color: var(--dark-blue);
        transform: translateY(-2px);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Formulaire d'ajout */
    .add-form-container {
        background: var(--white);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
        display: none;
    }

    .add-form-container.active {
        display: block;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--dark-blue);
        font-weight: 600;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--gold);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .preview-image {
        max-width: 200px;
        max-height: 200px;
        margin-top: 10px;
        border-radius: 5px;
        display: none;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    /* Grille des images */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .gallery-card {
        background: var(--white);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .gallery-card-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .gallery-card-body {
        padding: 20px;
    }

    .gallery-card-title {
        font-size: 1.2rem;
        color: var(--dark-blue);
        margin-bottom: 5px;
        font-weight: 600;
    }

    .gallery-card-category {
        display: inline-block;
        background-color: var(--gold);
        color: var(--white);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-bottom: 10px;
    }

    .gallery-card-description {
        color: var(--text-gray);
        font-size: 0.95rem;
        margin-bottom: 15px;
    }

    .gallery-card-order {
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .gallery-card-actions {
        display: flex;
        gap: 10px;
    }

    .btn-edit,
    .btn-delete {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-edit {
        background-color: var(--dark-blue);
        color: var(--white);
    }

    .btn-edit:hover {
        background-color: var(--gold);
    }

    .btn-delete {
        background-color: #dc3545;
        color: var(--white);
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow-y: auto;
    }

    .modal.active {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .modal-content {
        background-color: var(--white);
        padding: 30px;
        border-radius: 10px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-header h2 {
        color: var(--dark-blue);
        margin: 0;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 2rem;
        cursor: pointer;
        color: var(--text-gray);
        transition: color 0.3s;
    }

    .modal-close:hover {
        color: var(--gold);
    }

    @media (max-width: 768px) {
        .admin-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .gallery-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="admin-container">
    <!-- Header -->
    <div class="admin-header">
        <h1><i class="fas fa-images"></i> Gestion de la Galerie</h1>
        <div class="btn-group">
            <a href="{{ route('products.index') }}" class="btn-add" style="background-color: var(--dark-blue);">
                <i class="fas fa-box"></i> Gestion Produits
            </a>
            <button id="toggleAddForm" class="btn-add">
                <i class="fas fa-plus"></i> Ajouter une Image
            </button>
        </div>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Formulaire d'ajout -->
    <div class="add-form-container" id="addFormContainer">
        <h2 style="color: var(--dark-blue); margin-bottom: 20px;">
            <i class="fas fa-image"></i> Nouvelle Image
        </h2>
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Titre *</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description de l'image (optionnel)"></textarea>
            </div>

            <div class="form-group">
                <label for="category">Catégorie *</label>
                <select id="category" name="category" required>
                    <option value="">Sélectionner une catégorie</option>
                    <option value="voiles">Voiles</option>
                    <option value="baches">Bâches</option>
                    <option value="capitonnage">Capitonnage</option>
                    <option value="reparation">Réparation</option>
                </select>
            </div>

            <div class="form-group">
                <label for="order">Ordre d'affichage</label>
                <input type="number" id="order" name="order" value="0" min="0">
                <small style="color: var(--text-gray);">Plus le nombre est petit, plus l'image apparaît en premier</small>
            </div>

            <div class="form-group">
                <label for="image">Image * (Max 5MB)</label>
                <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                <img id="imagePreview" class="preview-image" alt="Aperçu">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <button type="button" class="btn" style="background-color: #6c757d; color: white;" onclick="toggleAddForm()">
                    <i class="fas fa-times"></i> Annuler
                </button>
            </div>
        </form>
    </div>

    <!-- Liste des images -->
    <div class="gallery-grid">
        @forelse($images as $image)
            <div class="gallery-card">
                <img src="{{ asset($image->image_path) }}" alt="{{ $image->title }}" class="gallery-card-image">
                <div class="gallery-card-body">
                    <span class="gallery-card-category">{{ ucfirst($image->category) }}</span>
                    <h3 class="gallery-card-title">{{ $image->title }}</h3>
                    @if($image->description)
                        <p class="gallery-card-description">{{ $image->description }}</p>
                    @endif
                    <p class="gallery-card-order">
                        <i class="fas fa-sort"></i> Ordre: {{ $image->order }}
                    </p>
                    <div class="gallery-card-actions">
                        <button class="btn-edit" onclick="openEditModal({{ $image->id }})">
                            <i class="fas fa-edit"></i> Modifier
                        </button>

                        <button class="btn-delete" onclick="deleteImage({{ $image->id }})">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <p>Aucune image dans la galerie</p>
            </div>
        @endforelse
    </div>
</div>

<script>
function toggleAddForm() {
    const form = document.getElementById('addImageForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

function deleteImage(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
        fetch(`/admin/gallery/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de la suppression');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de la suppression');
        });
    }
}

</script>

@endsection
