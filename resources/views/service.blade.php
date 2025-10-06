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
        <div class="service-detail">
            <h2><i class="fas fa-sailboat"></i> Tauds et Voiles</h2>
            <p>Expert en fabrication et réparation de voiles sur mesure, nous offrons des solutions adaptées à tous types d'embarcations. Notre savoir-faire garantit des produits durables et performants.</p>
            <ul>
                <li>Fabrication de voiles neuves sur mesure</li>
                <li>Réparation et renforcement de voiles existantes</li>
                <li>Confection de tauds de soleil et de protection</li>
                <li>Adaptation et modification de voilure</li>
                <li>Conseils techniques personnalisés</li>
            </ul>
        </div>

        <!-- Service 2: Bâches -->
        <div class="service-detail">
            <h2><i class="fas fa-umbrella-beach"></i> Bâches de Protection</h2>
            <p>Nous concevons des bâches sur mesure pour protéger vos équipements, véhicules et bateaux contre les intempéries. Matériaux de qualité et finitions soignées garanties.</p>
            <ul>
                <li>Bâches de protection pour bateaux</li>
                <li>Bâches de camionnage</li>
                <li>Bâches pour terrasses et extérieurs</li>
                <li>Couvertures industrielles</li>
                <li>Solutions sur mesure selon vos besoins</li>
            </ul>
        </div>

        <!-- Service 3: Capitonnage -->
        <div class="service-detail">
            <h2><i class="fas fa-chair"></i> Capitonnage</h2>
            <p>Notre atelier de capitonnage redonne vie à vos sièges et ameublements. Nous intervenons sur tous types de supports : auto, moto, bateau et mobilier intérieur.</p>
            <ul>
                <li>Réfection de sièges automobiles</li>
                <li>Capitonnage de selles de moto</li>
                <li>Banquettes et coussins de bateau</li>
                <li>Rénovation de fauteuils et canapés</li>
                <li>Large choix de matériaux et finitions</li>
            </ul>
        </div>

        <!-- Service 4: Biminis -->
        <div class="service-detail">
            <h2><i class="fas fa-car"></i> Biminis</h2>
            <p>Conception et installation de biminis sur mesure pour protéger efficacement votre cockpit du soleil et de la pluie. Structures robustes et toiles résistantes.</p>
            <ul>
                <li>Biminis fixes et amovibles</li>
                <li>Structures en inox marine</li>
                <li>Toiles anti-UV haute qualité</li>
                <li>Installation professionnelle</li>
                <li>Extension et modification de biminis existants</li>
            </ul>
        </div>

        <!-- Service 5: Sièges et Coussins -->
        <div class="service-detail">
            <h2><i class="fas fa-couch"></i> Sièges et Coussins</h2>
            <p>Création et rénovation de sièges et coussins pour tous usages. Confort et durabilité sont nos priorités.</p>
            <ul>
                <li>Coussins nautiques sur mesure</li>
                <li>Sièges de pilotage renforcés</li>
                <li>Coussins d'extérieur résistants</li>
                <li>Matelas de pont</li>
                <li>Housses et protections</li>
            </ul>
        </div>

        <!-- Service 6: Solutions Sur Mesure -->
        <div class="service-detail">
            <h2><i class="fas fa-tools"></i> Solutions Sur Mesure</h2>
            <p>Chaque projet est unique. Nous étudions vos besoins spécifiques pour vous proposer des solutions adaptées et personnalisées.</p>
            <ul>
                <li>Étude et conception sur mesure</li>
                <li>Devis détaillé gratuit</li>
                <li>Conseils techniques professionnels</li>
                <li>Intervention sur site possible</li>
                <li>Garantie sur tous nos travaux</li>
            </ul>
        </div>

        <!-- CTA Section -->
        <div class="cta-section">
            <h2>Besoin d'un Devis ?</h2>
            <p>Contactez-nous dès maintenant pour discuter de votre projet et obtenir un devis personnalisé gratuit.</p>
            <a href="{{ route('accueil') }}#contact" class="btn btn-primary">
                <i class="fas fa-envelope"></i> Nous Contacter
            </a>
        </div>
    </div>
</div>
@endsection
