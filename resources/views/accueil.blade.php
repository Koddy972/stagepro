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
    }
    
    .service-card {
        background: var(--white);
        border-radius: 6px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid #f1f1f1;
    }
    
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .service-icon {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%);
        color: var(--white);
        font-size: 2.2rem;
        padding: 25px;
        text-align: center;
    }
    
    .service-content {
        padding: 25px;
    }
    
    .service-content h3 {
        color: var(--dark-blue);
        margin-bottom: 15px;
        font-size: 1.3rem;
        font-family: 'Playfair Display', serif;
    }
    
    .service-content p {
        color: var(--text-gray);
        margin-bottom: 20px;
        line-height: 1.7;
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
            <a href="#contact" class="btn" style="background-color:#e84e9b; color:#fff; border:none;">
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
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-sailboat"></i>
                </div>
                <div class="service-content">
                    <h3>Tauds et Voiles</h3>
                    <p>Fabrication et réparation sur mesure de tous types de tauds et voiles pour bateaux et autres applications.</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-umbrella-beach"></i>
                </div>
                <div class="service-content">
                    <h3>Bâches</h3>
                    <p>Conception de bâches de protection sur mesure pour tous vos besoins professionnels et personnels.</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-chair"></i>
                </div>
                <div class="service-content">
                    <h3>Capitonnage</h3>
                    <p>Services de capitonnage de qualité pour redonner une seconde vie à vos sièges et ameublements.</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="service-content">
                    <h3>Biminis</h3>
                    <p>Réalisation de biminis sur mesure pour protéger votre pont des intempéries.</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-couch"></i>
                </div>
                <div class="service-content">
                    <h3>Sièges et Coussins</h3>
                    <p>Création et réparation de sièges et coussins pour auto, moto, bateaux et ameublement.</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="service-content">
                    <h3>Solutions Sur Mesure</h3>
                    <p>Des solutions adaptées à vos besoins spécifiques avec un service personnalisé.</p>
                </div>
            </div>
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

