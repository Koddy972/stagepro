@extends('layouts.app')

@section('title', 'Caraïbes Voiles Manutention - Confection et Réparation')

@push('styles')
<style>
    /* Hero section */
    .hero {
        position: relative;
        width: 100%;
        min-height: 85vh;
        padding: 0;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero img {
        width: 100vw;
        min-width: 100vw;
        max-width: 100vw;
        height: 86vh;
        object-fit: cover;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        height: 80vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center; /* Ajouté pour centrer tout le contenu */
        left: 0;
        right: 0;
        margin: 0 auto;
    }
    
    .hero h1 {
        color: white;
        font-size: 3rem;
        text-shadow: 0 2px 8px #000;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .hero p {
        color: white;
        font-size: 1.3rem;
        margin-bottom: 35px;
        text-shadow: 0 2px 8px #000;
        max-width: 700px;
        text-align: center;
        font-weight: 300;
    }
    
    .btn {
        background-color: #e84e9b;
        color: #fff;
        border: none;
        transition: background 0.3s, color 0.3s, box-shadow 0.3s;
        box-shadow: 0 2px 8px rgba(232, 78, 155, 0.08);
    }
    
    .btn:hover,
    .btn:focus {
        background-color: #fff;
        color: #e84e9b;
        box-shadow: 0 6px 24px rgba(232, 78, 155, 0.18);
        border: 1px solid #e84e9b;
    }

    /* Services section */
    .services {
        padding: 90px 0;
        background-color: var(--white);
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 60px;
        color: var(--dark-blue);
        position: relative;
    }
    
    .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        margin-bottom: 15px;
    }
    
    .section-title p {
        color: var(--text-gray);
        max-width: 600px;
        margin: 0 auto;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        width: 60px;
        height: 3px;
        background-color: var(--gold);
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }
    
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        align-items: stretch;
    }
    
    .service-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }
    
    .service-card {
        background: var(--white);
        border-radius: 6px;
        overflow: visible;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid #f1f1f1;
        cursor: pointer;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        z-index: 20;
    }
    
    /* Popup d'aperçu des photos */
    .service-card {
        position: relative;
    }
    
    .service-preview {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(255, 255, 255, 0.98), rgba(255, 255, 255, 0.95));
        backdrop-filter: blur(10px);
        border-radius: 0 0 6px 6px;
        box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.15);
        padding: 0 20px;
        z-index: 10;
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, opacity 0.3s ease, padding 0.4s ease;
    }
    
    .service-card:hover .service-preview {
        max-height: 500px;
        opacity: 1;
        padding: 20px;
    }
    
    .preview-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark-blue);
        margin-bottom: 12px;
        text-align: center;
        padding-top: 5px;
    }
    
    .preview-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .preview-image {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
        transition: transform 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .preview-image:hover {
        transform: scale(1.05);
    }
    
    .preview-more {
        grid-column: 1 / -1;
        text-align: center;
        margin-top: 10px;
        font-size: 0.85rem;
        color: var(--gold);
        font-weight: 600;
        padding-bottom: 5px;
    }
    
    .preview-empty {
        text-align: center;
        padding: 30px 20px;
        color: var(--text-gray);
        font-size: 0.9rem;
    }
    
    .preview-empty i {
        display: block;
        margin-bottom: 10px;
        font-size: 2rem;
        color: var(--medium-blue);
        opacity: 0.5;
    }
    
    .service-icon {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%);
        color: var(--white);
        font-size: 2.2rem;
        padding: 25px;
        text-align: center;
        flex-shrink: 0;
    }
    
    .service-content {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .service-content h3 {
        color: var(--dark-blue);
        margin-bottom: 15px;
        font-size: 1.3rem;
        font-family: 'Playfair Display', serif;
    }
    
    .service-content p {
        color: var(--text-gray);
        margin-bottom: 0;
        line-height: 1.7;
        flex: 1;
    }
    
    /* About section */
    .about {
        padding: 90px 0;
        background: var(--light-blue);
    }
    
    .about-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }
    
    .about-content h2 {
        margin-bottom: 30px;
        color: var(--dark-blue);
        font-family: 'Playfair Display', serif;
    }
    
    .about-content p {
        margin-bottom: 20px;
        font-size: 1.05rem;
        line-height: 1.8;
    }
    
    /* Contact section */
    .contact {
        padding: 90px 0;
        background-color: var(--white);
    }
    
    .contact-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
    }
    
    .contact-info {
        background: var(--dark-blue);
        color: var(--white);
        padding: 40px;
        border-radius: 6px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .contact-info h3 {
        margin-bottom: 25px;
        font-size: 1.5rem;
        color: var(--gold);
        font-family: 'Playfair Display', serif;
    }
    
    .contact-details {
        margin-bottom: 30px;
    }
    
    .contact-details p {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .contact-details i {
        color: var(--gold);
        font-size: 1.1rem;
        width: 25px;
    }
    
    .map {
        height: 300px;
        background-color: #ddd;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .map iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section id="accueil" class="hero">
    <img src="{{ asset('images/hero-boutique3.jpg') }}" alt="Boutique Caraïbes Voiles">
    <div class="hero-content">
        <h1>Expert en Confection & Réparation de Voiles</h1>
        <p>Spécialistes en fabrication et réparation de voiles, bâches, biminis et capitonnage pour auto, moto, bateau et ameublement</p>
        <div style="text-align:center; display:flex; gap:18px; justify-content:center;">
            <a href="{{ route('quote.create') }}" class="btn" style="background-color:#e84e9b; color:#fff; border:none;">
                Demander un devis
            </a>
            <a href="#services" class="btn btn-light">
                Découvrir nos services
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services">
    <div class="container">
        <div class="section-title">
            <h2>Nos Services</h2>
            <p>Des solutions sur mesure pour tous vos besoins en voilerie et protection</p>
        </div>
        <div class="services-grid">
            @php
            $servicesMap = [
                ['title' => 'Tauds et Voiles', 'icon' => 'fa-sailboat', 'description' => 'Fabrication et réparation sur mesure de tous types de tauds et voiles pour bateaux et autres applications.', 'category_slug' => 'tauds-voiles'],
                ['title' => 'Bâches', 'icon' => 'fa-umbrella-beach', 'description' => 'Conception de bâches de protection sur mesure pour tous vos besoins professionnels et personnels.', 'category_slug' => 'baches-protection'],
                ['title' => 'Capitonnage', 'icon' => 'fa-chair', 'description' => 'Services de capitonnage de qualité pour redonner une seconde vie à vos sièges et ameublements.', 'category_slug' => 'capitonnage'],
                ['title' => 'Biminis', 'icon' => 'fa-umbrella', 'description' => 'Réalisation de biminis sur mesure pour protéger votre pont des intempéries.', 'category_slug' => 'biminis'],
                ['title' => 'Sièges et Coussins', 'icon' => 'fa-couch', 'description' => 'Création et réparation de sièges et coussins pour auto, moto, bateaux et ameublement.', 'category_slug' => 'sieges-coussins'],
                ['title' => 'Solutions Sur Mesure', 'icon' => 'fa-tools', 'description' => 'Des solutions adaptées à vos besoins spécifiques avec un service personnalisé.', 'category_slug' => 'solutions-sur-mesure']
            ];
            @endphp

            @foreach($servicesMap as $service)
                @php
                $category = $galleryCategories->firstWhere('slug', $service['category_slug']);
                $galleryUrl = $service['category_slug'] ? route('galerie') . '?category=' . $service['category_slug'] : route('galerie');
                @endphp
                
                <a href="{{ $galleryUrl }}" class="service-card-link">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas {{ $service['icon'] }}"></i>
                        </div>
                        <div class="service-content">
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['description'] }}</p>
                        </div>
                        
                        @if($category && $category->images->count() > 0)
                            <div class="service-preview">
                                <div class="preview-title">Nos réalisations</div>
                                <div class="preview-grid">
                                    @foreach($category->images->take(4) as $image)
                                        <img src="{{ asset($image->image_path) }}" alt="{{ $image->title }}" class="preview-image">
                                    @endforeach
                                </div>
                                @if($category->images->count() > 4)
                                    <div class="preview-more">
                                        +{{ $category->images->count() - 4 }} autres photos
                                    </div>
                                @endif
                            </div>
                        @elseif($service['category_slug'])
                            <div class="service-preview">
                                <div class="preview-empty">
                                    <i class="fas fa-images" style="font-size: 2rem; color: var(--medium-blue); margin-bottom: 10px; display: block;"></i>
                                    Aucune réalisation pour le moment
                                </div>
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about">
    <div class="container">
        <div class="about-content">
            <h2>À Propos de Nous</h2>
            <p>Caraïbes Voiles Manutention est une entreprise spécialisée dans la confection et réparation de voiles, tauds, bâches et articles de capitonnage. Située à Ducos en Martinique, nous servons une clientèle exigeante depuis plusieurs années.</p>
            <p>Notre expertise couvre un large éventail de domaines incluant l'automobile, la moto, les bateaux et l'ameublement. Que vous ayez besoin de sièges, de coussins, de fauteuils ou de canapés, notre équipe de professionnels est à votre service.</p>
            <p>Nous combinons savoir-faire traditionnel et techniques modernes pour vous offrir des produits de qualité, durables et parfaitement adaptés à vos besoins.</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact">
    <div class="container">
        <div class="section-title">
            <h2>Contactez-Nous</h2>
            <p>N'hésitez pas à nous contacter pour toute demande de devis ou information</p>
        </div>
        <div class="contact-wrapper">
            <div class="contact-info">
                <h3>Informations de Contact</h3>
                <div class="contact-details">
                    <p><i class="fas fa-user"></i> <span>Francesca BORDES</span></p>
                    <p><i class="fas fa-map-marker-alt"></i> <span>Z.I Champigny, 97224 DUCOS</span></p>
                    <p><i class="fas fa-phone"></i> <span>0696097806</span></p>
                    <p><i class="fas fa-envelope"></i> <span>cvmanutention@gmail.com</span></p>
                    <p><i class="fas fa-id-card"></i> <span>Siret: 91915140700021</span></p>
                </div>
                <h3>Horaires d'ouverture</h3>
                <p><i class="fas fa-clock"></i> Lundi-Vendredi: 8h-17h</p>
                <p><i class="fas fa-clock"></i> Samedi: 9h-12h</p>
                <p><i class="fas fa-clock"></i> Dimanche: Fermé</p>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3861.3779534897167!2d-60.9887804248942!3d14.577526685906111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTTCsDM0JzM5LjEiTiA2MMKwNTknMTAuMyJX!5e0!3m2!1sfr!2sfr!4v1757351477554!5m2!1sfr!2sfr" 
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection

