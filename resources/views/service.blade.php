@extends('layouts.app')

@section('title', 'Nos Services - Caraïbes Voiles Manutention')

@push('styles')
<style>
    .services-page {
        padding: 60px 0;
        background-color: var(--light-gray);
    }
    
    .page-header {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%);
        color: var(--white);
        padding: 80px 0 60px;
        text-align: center;
        margin-bottom: 60px;
    }
    
    .page-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        margin-bottom: 20px;
    }
    
    .page-header p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto;
        opacity: 0.9;
    }
    
    .service-detail {
        background: var(--white);
        border-radius: 8px;
        padding: 40px;
        margin-bottom: 40px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .service-detail:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .service-detail h2 {
        color: var(--dark-blue);
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .service-detail h2 i {
        color: var(--gold);
        font-size: 2.5rem;
    }
    
    .service-detail p {
        line-height: 1.8;
        margin-bottom: 15px;
    }
    
    .service-detail ul {
        list-style: none;
        padding-left: 0;
    }
    
    .service-detail ul li {
        padding: 10px 0;
        padding-left: 30px;
        position: relative;
    }
    
    .service-detail ul li:before {
        content: '\f00c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        color: var(--gold);
    }

    /* Gallery Hover System */
    .service-gallery-preview {
        position: absolute;
        top: 0;
        right: -350px;
        width: 320px;
        height: 100%;
        background: rgba(255, 255, 255, 0.98);
        box-shadow: -5px 0 20px rgba(0, 0, 0, 0.1);
        transition: right 0.4s ease;
        z-index: 10;
        overflow-y: auto;
        padding: 20px;
    }

    .service-detail:hover .service-gallery-preview {
        right: 0;
    }

    .gallery-preview-header {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark-blue);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--gold);
    }

    .gallery-preview-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .gallery-preview-item {
        position: relative;
        padding-bottom: 100%;
        overflow: hidden;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .gallery-preview-item:hover {
        transform: scale(1.05);
    }

    .gallery-preview-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-preview-loading {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }

    .gallery-preview-empty {
        text-align: center;
        padding: 40px 20px;
        color: #999;
        font-size: 0.9rem;
    }

    .view-all-gallery {
        display: block;
        text-align: center;
        margin-top: 15px;
        padding: 10px;
        background: var(--dark-blue);
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 0.9rem;
        transition: background 0.3s ease;
    }

    .view-all-gallery:hover {
        background: var(--medium-blue);
    }
    
    .cta-section {
        background: var(--dark-blue);
        color: var(--white);
        padding: 60px 40px;
        border-radius: 8px;
        text-align: center;
        margin-top: 60px;
    }
    
    .cta-section h2 {
        font-family: 'Playfair Display', serif;
        margin-bottom: 20px;
        color: var(--white);
    }
    
    .cta-section p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .service-gallery-preview {
            display: none; /* Masquer le hover sur tablette/mobile */
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Nos Services</h1>
        <p>Des solutions professionnelles sur mesure pour tous vos besoins en voilerie, bâches et capitonnage</p>
    </div>
</div>

<div class="services-page">
    <div class="container">
        <!-- Service 1: Tauds et Voiles -->
        <div class="service-detail" data-category="tauds-voiles">
            <h2><i class="fas fa-sailboat"></i> Tauds et Voiles</h2>
            <p>Expert en fabrication et réparation de voiles sur mesure, nous offrons des solutions adaptées à tous types d'embarcations. Notre savoir-faire garantit des produits durables et performants.</p>
            <ul>
                <li>Fabrication de voiles neuves sur mesure</li>
                <li>Réparation et renforcement de voiles existantes</li>
                <li>Confection de tauds de soleil et de protection</li>
                <li>Adaptation et modification de voilure</li>
                <li>Conseils techniques personnalisés</li>
            </ul>
            
            <!-- Gallery Preview -->
            <div class="service-gallery-preview">
                <div class="gallery-preview-header">
                    <i class="fas fa-images"></i> Nos Réalisations
                </div>
                <div class="gallery-preview-content">
                    <div class="gallery-preview-loading">
                        <i class="fas fa-spinner fa-spin"></i> Chargement...
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 2: Bâches -->
        <div class="service-detail" data-category="baches-protection">
            <h2><i class="fas fa-umbrella-beach"></i> Bâches de Protection</h2>
            <p>Nous concevons des bâches sur mesure pour protéger vos équipements, véhicules et bateaux contre les intempéries. Matériaux de qualité et finitions soignées garanties.</p>
            <ul>
                <li>Bâches de protection pour bateaux</li>
                <li>Bâches de camionnage</li>
                <li>Bâches pour terrasses et extérieurs</li>
                <li>Couvertures industrielles</li>
                <li>Solutions sur mesure selon vos besoins</li>
            </ul>
            
            <!-- Gallery Preview -->
            <div class="service-gallery-preview">
                <div class="gallery-preview-header">
                    <i class="fas fa-images"></i> Nos Réalisations
                </div>
                <div class="gallery-preview-content">
                    <div class="gallery-preview-loading">
                        <i class="fas fa-spinner fa-spin"></i> Chargement...
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 3: Capitonnage -->
        <div class="service-detail" data-category="capitonnage">
            <h2><i class="fas fa-chair"></i> Capitonnage</h2>
            <p>Notre atelier de capitonnage redonne vie à vos sièges et ameublements. Nous intervenons sur tous types de supports : auto, moto, bateau et mobilier intérieur.</p>
            <ul>
                <li>Réfection de sièges automobiles</li>
                <li>Capitonnage de selles de moto</li>
                <li>Banquettes et coussins de bateau</li>
                <li>Rénovation de fauteuils et canapés</li>
                <li>Large choix de matériaux et finitions</li>
            </ul>
            
            <!-- Gallery Preview -->
            <div class="service-gallery-preview">
                <div class="gallery-preview-header">
                    <i class="fas fa-images"></i> Nos Réalisations
                </div>
                <div class="gallery-preview-content">
                    <div class="gallery-preview-loading">
                        <i class="fas fa-spinner fa-spin"></i> Chargement...
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 4: Biminis -->
        <div class="service-detail" data-category="biminis">
            <h2><i class="fas fa-car"></i> Biminis</h2>
            <p>Conception et installation de biminis sur mesure pour protéger efficacement votre cockpit du soleil et de la pluie. Structures robustes et toiles résistantes.</p>
            <ul>
                <li>Biminis fixes et amovibles</li>
                <li>Structures en inox marine</li>
                <li>Toiles anti-UV haute qualité</li>
                <li>Installation professionnelle</li>
                <li>Extension et modification de biminis existants</li>
            </ul>
            
            <!-- Gallery Preview -->
            <div class="service-gallery-preview">
                <div class="gallery-preview-header">
                    <i class="fas fa-images"></i> Nos Réalisations
                </div>
                <div class="gallery-preview-content">
                    <div class="gallery-preview-loading">
                        <i class="fas fa-spinner fa-spin"></i> Chargement...
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 5: Sièges et Coussins -->
        <div class="service-detail" data-category="sieges-coussins">
            <h2><i class="fas fa-couch"></i> Sièges et Coussins</h2>
            <p>Création et rénovation de sièges et coussins pour tous usages. Confort et durabilité sont nos priorités.</p>
            <ul>
                <li>Coussins nautiques sur mesure</li>
                <li>Sièges de pilotage renforcés</li>
                <li>Coussins d'extérieur résistants</li>
                <li>Matelas de pont</li>
                <li>Housses et protections</li>
            </ul>
            
            <!-- Gallery Preview -->
            <div class="service-gallery-preview">
                <div class="gallery-preview-header">
                    <i class="fas fa-images"></i> Nos Réalisations
                </div>
                <div class="gallery-preview-content">
                    <div class="gallery-preview-loading">
                        <i class="fas fa-spinner fa-spin"></i> Chargement...
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 6: Solutions Sur Mesure -->
        <div class="service-detail" data-category="solutions-sur-mesure">
            <h2><i class="fas fa-tools"></i> Solutions Sur Mesure</h2>
            <p>Chaque projet est unique. Nous étudions vos besoins spécifiques pour vous proposer des solutions adaptées et personnalisées.</p>
            <ul>
                <li>Étude et conception sur mesure</li>
                <li>Devis détaillé gratuit</li>
                <li>Conseils techniques professionnels</li>
                <li>Intervention sur site possible</li>
                <li>Garantie sur tous nos travaux</li>
            </ul>
            
            <!-- Gallery Preview -->
            <div class="service-gallery-preview">
                <div class="gallery-preview-header">
                    <i class="fas fa-images"></i> Nos Réalisations
                </div>
                <div class="gallery-preview-content">
                    <div class="gallery-preview-loading">
                        <i class="fas fa-spinner fa-spin"></i> Chargement...
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section">
            <h2>Besoin d'un Devis ?</h2>
            <p>Contactez-nous dès maintenant pour discuter de votre projet et obtenir un devis personnalisé gratuit.</p>
            <a href="{{ route('quote.create') }}" class="btn btn-primary">
                <i class="fas fa-file-alt"></i> Demander un Devis
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceCards = document.querySelectorAll('.service-detail[data-category]');
    const loadedCategories = new Set();

    serviceCards.forEach(card => {
        let hoverTimeout;
        
        card.addEventListener('mouseenter', function() {
            const category = this.dataset.category;
            const previewContent = this.querySelector('.gallery-preview-content');
            
            // Attendre 500ms avant de charger (évite les chargements inutiles)
            hoverTimeout = setTimeout(() => {
                // Charger seulement si pas déjà chargé
                if (!loadedCategories.has(category)) {
                    loadImages(category, previewContent);
                    loadedCategories.add(category);
                }
            }, 500);
        });

        card.addEventListener('mouseleave', function() {
            clearTimeout(hoverTimeout);
        });
    });

    function loadImages(categorySlug, container) {
        fetch(`/gallery/category/${categorySlug}/images`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.images.length > 0) {
                    displayImages(data.images, container, categorySlug);
                } else {
                    container.innerHTML = `
                        <div class="gallery-preview-empty">
                            <i class="fas fa-image"></i><br>
                            Aucune image disponible pour cette catégorie
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Erreur chargement images:', error);
                container.innerHTML = `
                    <div class="gallery-preview-empty">
                        <i class="fas fa-exclamation-triangle"></i><br>
                        Erreur de chargement
                    </div>
                `;
            });
    }

    function displayImages(images, container, categorySlug) {
        let html = '<div class="gallery-preview-grid">';
        
        images.forEach(image => {
            html += `
                <div class="gallery-preview-item">
                    <img src="${image.image_url}" alt="${image.title}" loading="lazy">
                </div>
            `;
        });
        
        html += '</div>';
        html += `<a href="/galerie?category=${categorySlug}" class="view-all-gallery">
            <i class="fas fa-arrow-right"></i> Voir toute la galerie
        </a>`;
        
        container.innerHTML = html;
    }
});
</script>
@endpush
@endsection
