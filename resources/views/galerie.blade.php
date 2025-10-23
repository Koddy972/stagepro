@extends('layouts.app')

@section('title', 'Galerie - Caraïbes Voiles Manutention')

@push('styles')
<style>
    .galerie-hero {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%);
        padding: 80px 0 60px;
        text-align: center;
        color: var(--white);
    }
    
    .galerie-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        margin-bottom: 15px;
        color: var(--white);
    }
    
    .galerie-hero p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 700px;
        margin: 0 auto;
    }
    
    .galerie-container {
        padding: 60px 0;
    }
    
    .galerie-filters {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .filter-btn {
        background-color: var(--white);
        color: var(--dark-blue);
        border: 2px solid var(--dark-blue);
        padding: 10px 25px;
        margin: 5px;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .filter-btn:hover,
    .filter-btn.active {
        background-color: var(--gold);
        color: var(--white);
        border-color: var(--gold);
    }
    
    .galerie-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }
    
    .galerie-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
        background-color: var(--white);
    }
    
    .galerie-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .galerie-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s;
    }
    
    .galerie-item:hover img {
        transform: scale(1.1);
    }
    
    .galerie-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(13, 47, 79, 0.9), transparent);
        padding: 20px;
        transform: translateY(100%);
        transition: transform 0.3s;
    }
    
    .galerie-item:hover .galerie-overlay {
        transform: translateY(0);
    }
    
    .galerie-overlay h3 {
        color: var(--white);
        font-size: 1.3rem;
        margin-bottom: 5px;
    }
    
    .galerie-overlay p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
    }
    
    /* Modal Lightbox */
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        justify-content: center;
        align-items: center;
    }
    
    .lightbox.active {
        display: flex;
    }
    
    .lightbox-content {
        max-width: 90%;
        max-height: 90%;
        position: relative;
    }
    
    .lightbox-content img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
    }
    
    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 40px;
        color: var(--white);
        font-size: 40px;
        cursor: pointer;
        transition: color 0.3s;
        z-index: 10000;
    }
    
    .lightbox-close:hover {
        color: var(--gold);
    }
    
    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: var(--white);
        font-size: 50px;
        cursor: pointer;
        padding: 20px;
        transition: color 0.3s;
        user-select: none;
    }
    
    .lightbox-nav:hover {
        color: var(--gold);
    }
    
    .lightbox-prev {
        left: 20px;
    }
    
    .lightbox-next {
        right: 20px;
    }
    
    @media (max-width: 768px) {
        .galerie-hero h1 {
            font-size: 2rem;
        }
        
        .galerie-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .lightbox-close {
            right: 20px;
            font-size: 30px;
        }
        
        .lightbox-nav {
            font-size: 30px;
            padding: 10px;
        }
    }
</style>
@endpush

@section('content')
<!-- Section Hero -->
<section class="galerie-hero">
    <div class="container">
        <h1>Notre Galerie</h1>
        <p>Découvrez nos réalisations en confection de voiles, bâches et articles de capitonnage</p>
    </div>
</section>

<!-- Section Galerie -->
<section class="galerie-container">
    <div class="container">
        <!-- Filtres -->
        <div class="galerie-filters">
            <button class="filter-btn {{ !$selectedCategory ? 'active' : '' }}" data-filter="all">Tout</button>
            @foreach($categories as $category)
                @if($category->is_active && $category->images->count() > 0)
                    <button class="filter-btn {{ $selectedCategory == $category->slug ? 'active' : '' }}" data-filter="{{ $category->slug }}">{{ $category->name }}</button>
                @endif
            @endforeach
        </div>
        
        <!-- Grille de la galerie -->
        <div class="galerie-grid" id="galerieGrid">
            @forelse($images as $image)
                <div class="galerie-item" data-category="{{ $image->galleryCategory ? $image->galleryCategory->slug : 'non-categorise' }}">
                    <img src="{{ asset($image->image_path) }}" alt="{{ $image->title }}">
                    <div class="galerie-overlay">
                        <h3>{{ $image->title }}</h3>
                        @if($image->description)
                            <p>{{ $image->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                    <i class="fas fa-images" style="font-size: 4rem; color: var(--medium-blue); margin-bottom: 20px;"></i>
                    <h3 style="color: var(--dark-blue); margin-bottom: 10px;">Aucune image dans la galerie</h3>
                    <p style="color: var(--text-gray);">Les images ajoutées apparaîtront ici</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="lightbox" id="lightbox">
    <span class="lightbox-close" id="lightboxClose">&times;</span>
    <span class="lightbox-nav lightbox-prev" id="lightboxPrev">&#10094;</span>
    <span class="lightbox-nav lightbox-next" id="lightboxNext">&#10095;</span>
    <div class="lightbox-content">
        <img src="" alt="" id="lightboxImg">
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Système de filtres
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galerieItems = document.querySelectorAll('.galerie-item');
    
    // Au chargement de la page, filtrer selon le paramètre URL
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const categoryParam = urlParams.get('category');
        
        if (categoryParam) {
            // Trouver et activer le bon filtre
            const targetBtn = document.querySelector(`[data-filter="${categoryParam}"]`);
            if (targetBtn) {
                // Désactiver tous les boutons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Activer le bon bouton
                targetBtn.classList.add('active');
                
                // Filtrer les images
                galerieItems.forEach(item => {
                    const category = item.getAttribute('data-category');
                    if (category === categoryParam) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        }
    });
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Retirer la classe active de tous les boutons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Ajouter la classe active au bouton cliqué
            btn.classList.add('active');
            
            const filterValue = btn.getAttribute('data-filter');
            
            // Mettre à jour l'URL sans recharger la page
            const url = new URL(window.location);
            if (filterValue === 'all') {
                url.searchParams.delete('category');
            } else {
                url.searchParams.set('category', filterValue);
            }
            window.history.pushState({}, '', url);
            
            galerieItems.forEach(item => {
                if (filterValue === 'all') {
                    item.style.display = 'block';
                } else {
                    const category = item.getAttribute('data-category');
                    if (category === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
            
            // Mettre à jour les images visibles pour le lightbox
            updateVisibleImages();
        });
    });
    
    // Système Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');
    
    let currentImageIndex = 0;
    let visibleImages = [];
    
    // Fonction pour mettre à jour les images visibles
    function updateVisibleImages() {
        visibleImages = Array.from(galerieItems).filter(item => {
            return item.style.display !== 'none';
        });
    }
    
    // Ouvrir le lightbox
    galerieItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            updateVisibleImages();
            currentImageIndex = visibleImages.indexOf(item);
            const imgSrc = item.querySelector('img').src;
            lightboxImg.src = imgSrc;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Fermer le lightbox
    lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });
    
    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    
    // Navigation précédent
    lightboxPrev.addEventListener('click', (e) => {
        e.stopPropagation();
        currentImageIndex = (currentImageIndex - 1 + visibleImages.length) % visibleImages.length;
        lightboxImg.src = visibleImages[currentImageIndex].querySelector('img').src;
    });
    
    // Navigation suivant
    lightboxNext.addEventListener('click', (e) => {
        e.stopPropagation();
        currentImageIndex = (currentImageIndex + 1) % visibleImages.length;
        lightboxImg.src = visibleImages[currentImageIndex].querySelector('img').src;
    });
    
    // Navigation au clavier
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            lightboxPrev.click();
        } else if (e.key === 'ArrowRight') {
            lightboxNext.click();
        }
    });
    
    // Initialiser les images visibles au chargement
    updateVisibleImages();
</script>
@endpush
