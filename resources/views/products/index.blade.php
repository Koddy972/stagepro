@extends('layouts.app')

@section('title', 'Gestion des Produits et Catégories')

@push('styles')
<style>
    .admin-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Navigation Admin */
    .admin-nav {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%);
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .admin-nav-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .admin-nav-links {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .admin-nav-link {
        background: rgba(255, 255, 255, 0.1);
        color: var(--white);
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .admin-nav-link:hover,
    .admin-nav-link.active {
        background: var(--gold);
        color: var(--white);
        transform: translateY(-2px);
    }

    .admin-welcome {
        color: var(--white);
        font-weight: 600;
    }

    /* Onglets */
    .admin-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        border-bottom: 2px solid #e0e0e0;
    }

    .admin-tab {
        padding: 15px 30px;
        background: transparent;
        border: none;
        color: var(--text-gray);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border-bottom: 3px solid transparent;
        font-size: 16px;
    }

    .admin-tab.active {
        color: var(--gold);
        border-bottom-color: var(--gold);
    }

    .admin-tab:hover {
        color: var(--dark-blue);
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.3s;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Section Header */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--dark-blue);
    }

    /* Boutons */
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
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 14px;
    }

    /* Tables */
    .table-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: var(--light-blue);
    }

    th {
        padding: 15px;
        text-align: left;
        color: var(--white);
        font-weight: 600;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    tbody tr:hover {
        background: #f8f9fa;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s;
    }

    .modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 10px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--dark-blue);
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: var(--text-gray);
    }

    .close-modal:hover {
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
    }

    .form-control:focus {
        outline: none;
        border-color: var(--gold);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    /* Badge */
    .badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: #28a745;
        color: white;
    }

    .badge-warning {
        background: #ffc107;
        color: #000;
    }

    .badge-info {
        background: var(--light-blue);
        color: white;
    }

    /* Alert */
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .actions-cell {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')
<div class="admin-container">
    <!-- Navigation Admin -->
    <nav class="admin-nav">
        <div class="admin-nav-content">
            <div class="admin-nav-links">
                <a href="{{ route('products.index') }}" class="admin-nav-link active">
                    📦 Produits
                </a>
                <a href="{{ route('gallery.manage') }}" class="admin-nav-link">
                    🖼️ Galerie
                </a>
                <a href="{{ route('admin.orders') }}" class="admin-nav-link">
                    📋 Commandes
                </a>
            </div>
            <div class="admin-welcome">
                Bienvenue, {{ Auth::user()->name ?? 'Administrateur' }}
            </div>
        </div>
    </nav>

    <!-- Messages Flash -->
    @if(session('success'))
    <div class="alert alert-success">
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.style.display='none'" style="background:none;border:none;cursor:pointer;font-size:20px">&times;</button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
        <span>{{ session('error') }}</span>
        <button onclick="this.parentElement.style.display='none'" style="background:none;border:none;cursor:pointer;font-size:20px">&times;</button>
    </div>
    @endif

    <!-- Onglets -->
    <div class="admin-tabs">
        <button class="admin-tab active" onclick="switchTab('products', this)">
            📦 Gestion des Produits
        </button>
        <button class="admin-tab" onclick="switchTab('categories', this)">
            🏷️ Gestion des Catégories
        </button>
        <button class="admin-tab" onclick="switchTab('gallery-categories', this)">
            🖼️ Catégories Galerie
        </button>
    </div>

    <!-- Contenu Onglet Produits -->
    <div id="products-tab" class="tab-content active">
        <div class="section-header">
            <h2 class="section-title">Liste des Produits</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                ➕ Ajouter un Produit
            </a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                <div style="width:60px;height:60px;background:#e0e0e0;border-radius:8px;display:flex;align-items:center;justify-content:center">
                                    📦
                                </div>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if($product->category)
                                <span class="badge badge-info">{{ $product->category->name }}</span>
                            @else
                                <span class="badge badge-warning">Sans catégorie</span>
                            @endif
                        </td>
                        <td>{{ number_format($product->price, 2) }} €</td>
                        <td>
                            @if($product->in_stock)
                                <span class="badge badge-success">En stock</span>
                            @else
                                <span class="badge badge-warning">Rupture</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary btn-sm">
                                    ✏️ Modifier
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px">
                            <p style="color:var(--text-gray)">Aucun produit trouvé. Commencez par ajouter votre premier produit !</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Contenu Onglet Catégories -->
    <div id="categories-tab" class="tab-content">
        <div class="section-header">
            <h2 class="section-title">Liste des Catégories</h2>
            <button onclick="openCategoryModal()" class="btn btn-primary">
                ➕ Ajouter une Catégorie
            </button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Ordre</th>
                        <th>Nb Produits</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ Str::limit($category->description ?? 'Aucune description', 50) }}</td>
                        <td>{{ $category->order ?? 0 }}</td>
                        <td>
                            <span class="badge badge-info">{{ $category->products->count() }} produit(s)</span>
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-warning">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions-cell">
                                <button onclick="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}', {{ $category->order ?? 0 }}, {{ $category->is_active ? 'true' : 'false' }})" 
                                        class="btn btn-secondary btn-sm">
                                    ✏️ Modifier
                                </button>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline" 
                                      onsubmit="return confirm('Êtes-vous sûr ? Cette action est irréversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px">
                            <p style="color:var(--text-gray)">Aucune catégorie trouvée. Créez votre première catégorie !</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Contenu Onglet Catégories Galerie -->
    <div id="gallery-categories-tab" class="tab-content">
        <div class="section-header">
            <h2 class="section-title">Liste des Catégories de Galerie</h2>
            <button onclick="openGalleryCategoryModal()" class="btn btn-primary">
                ➕ Ajouter une Catégorie Galerie
            </button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Ordre</th>
                        <th>Nb Images</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleryCategories as $galleryCategory)
                    <tr>
                        <td><strong>{{ $galleryCategory->name }}</strong></td>
                        <td>{{ $galleryCategory->description ?? '-' }}</td>
                        <td>{{ $galleryCategory->order }}</td>
                        <td>{{ $galleryCategory->images->count() }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $galleryCategory->is_active ? '#28a745' : '#dc3545' }}">
                                {{ $galleryCategory->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex;gap:10px;justify-content:flex-start">
                                <button type="button" class="btn btn-info btn-sm" 
                                      onclick="editGalleryCategory({{ $galleryCategory->id }}, '{{ $galleryCategory->name }}', '{{ $galleryCategory->description }}', {{ $galleryCategory->order }}, {{ $galleryCategory->is_active ? 'true' : 'false' }})">
                                    ✏️ Modifier
                                </button>
                                
                                <form action="{{ route('gallery-categories.destroy', $galleryCategory) }}" 
                                      method="POST" 
                                      style="margin: 0"
                                      onsubmit="return confirm('Êtes-vous sûr ? Cette action est irréversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px">
                            <p style="color:var(--text-gray)">Aucune catégorie de galerie trouvée. Créez votre première catégorie !</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Catégorie -->
<div id="categoryModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitle">Ajouter une Catégorie</h3>
            <button type="button" class="close-modal" onclick="closeCategoryModal()">&times;</button>
        </div>
        <form id="categoryForm" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" id="categoryId">

            @if ($errors->any())
                <div class="alert alert-error" style="margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label class="form-label" for="name">Nom de la catégorie</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="order">Ordre d'affichage</label>
                <input type="number" class="form-control" id="order" name="order" min="0" value="{{ old('order', 0) }}">
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span>Catégorie active</span>
                </label>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end">
                <button type="button" class="btn btn-secondary" onclick="closeCategoryModal()">Annuler</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">Créer</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Catégorie Galerie -->
<div id="galleryCategoryModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="galleryModalTitle">Ajouter une Catégorie Galerie</h3>
            <button type="button" class="close-modal" onclick="closeGalleryCategoryModal()">&times;</button>
        </div>
        <form id="galleryCategoryForm" action="{{ route('gallery-categories.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_method" id="galleryFormMethod" value="POST">
            <input type="hidden" id="galleryCategoryId">

            <div class="form-group">
                <label class="form-label" for="gallery_name">Nom de la catégorie</label>
                <input type="text" class="form-control" id="gallery_name" name="name" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="gallery_description">Description</label>
                <textarea class="form-control" id="gallery_description" name="description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="gallery_order">Ordre d'affichage</label>
                <input type="number" class="form-control" id="gallery_order" name="order" min="0" value="0">
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_active" id="gallery_is_active" checked>
                    <span>Catégorie active</span>
                </label>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end">
                <button type="button" class="btn btn-secondary" onclick="closeGalleryCategoryModal()">Annuler</button>
                <button type="submit" class="btn btn-primary" id="gallerySubmitBtn">Créer</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Gestion des onglets
    function switchTab(tabName, element) {
        // Masquer tous les contenus
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Désactiver tous les boutons d'onglets
        document.querySelectorAll('.admin-tab').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Afficher le contenu sélectionné
        document.getElementById(tabName + '-tab').classList.add('active');
        
        // Activer le bouton correspondant
        if (element) {
            element.classList.add('active');
        }
    }

    // Gestion du modal de catégorie
    function openCategoryModal() {
        document.getElementById('modalTitle').textContent = 'Ajouter une Catégorie';
        document.getElementById('categoryForm').action = '{{ route("categories.store") }}';
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('submitBtn').textContent = 'Créer';
        
        // Réinitialiser le formulaire
        document.getElementById('categoryForm').reset();
        document.getElementById('categoryId').value = '';
        document.getElementById('is_active').checked = true;
        
        document.getElementById('categoryModal').classList.add('active');
    }

    function closeCategoryModal() {
        document.getElementById('categoryModal').classList.remove('active');
    }

    function editCategory(id, name, description, order, isActive) {
        document.getElementById('modalTitle').textContent = 'Modifier la Catégorie';
        document.getElementById('categoryForm').action = '/categories/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('submitBtn').textContent = 'Mettre à jour';
        
        // Remplir le formulaire
        document.getElementById('categoryId').value = id;
        document.getElementById('name').value = name;
        document.getElementById('description').value = description;
        document.getElementById('order').value = order;
        document.getElementById('is_active').checked = isActive;
        
        document.getElementById('categoryModal').classList.add('active');
    }

    // Fermer le modal en cliquant à l'extérieur
    document.getElementById('categoryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCategoryModal();
        }
    });

    // Gérer la soumission du formulaire
    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        console.log('Formulaire en cours de soumission...');
        console.log('Action:', this.action);
        console.log('Method:', this.method);
        console.log('Data:', new FormData(this));
        
        // Le formulaire se soumettra normalement
    });

    // Si des erreurs existent, ouvrir automatiquement le modal
    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            // Afficher l'onglet catégories
            switchTab('categories');
            // Ouvrir le modal
            openCategoryModal();
        });
    @endif

    // Gestion du modal de catégorie galerie
    function openGalleryCategoryModal() {
        document.getElementById('galleryModalTitle').textContent = 'Ajouter une Catégorie Galerie';
        document.getElementById('galleryCategoryForm').action = '{{ route("gallery-categories.store") }}';
        document.getElementById('galleryFormMethod').value = 'POST';
        document.getElementById('gallerySubmitBtn').textContent = 'Créer';
        
        // Réinitialiser le formulaire
        document.getElementById('galleryCategoryForm').reset();
        document.getElementById('galleryCategoryId').value = '';
        document.getElementById('gallery_is_active').checked = true;
        
        document.getElementById('galleryCategoryModal').classList.add('active');
    }

    function closeGalleryCategoryModal() {
        document.getElementById('galleryCategoryModal').classList.remove('active');
    }

    function editGalleryCategory(id, name, description, order, isActive) {
        document.getElementById('galleryModalTitle').textContent = 'Modifier la Catégorie Galerie';
        document.getElementById('galleryCategoryForm').action = '/gallery-categories/' + id;
        document.getElementById('galleryFormMethod').value = 'PUT';
        document.getElementById('gallerySubmitBtn').textContent = 'Mettre à jour';
        
        // Remplir le formulaire
        document.getElementById('galleryCategoryId').value = id;
        document.getElementById('gallery_name').value = name;
        document.getElementById('gallery_description').value = description || '';
        document.getElementById('gallery_order').value = order;
        document.getElementById('gallery_is_active').checked = isActive;
        
        document.getElementById('galleryCategoryModal').classList.add('active');
    }

    // Fermer le modal de galerie en cliquant à l'extérieur
    document.getElementById('galleryCategoryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeGalleryCategoryModal();
        }
    });
</script>
@endpush
