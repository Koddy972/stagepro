<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caraïbes Voiles Manutention - Confection et Réparation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        /* [COLLER TOUT LE CSS DE VOTRE FICHIER ICI] */
    :root {
            --dark-blue: #0d2f4f;
            --medium-blue: #1a4f7a;
            --light-blue: #e9f1f7;
            --gold: #de419a;
            --dark-gold: #a98b56;
            --white: #ffffff;
            --light-gray: #f8f9fa;
            --dark-gray: #2d3436;
            --text-gray: #5c5c5c;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 120px; /* Compense la hauteur du header fixe */
        }
        
        body {
            background-color: var(--light-gray);
            color: var(--text-gray);
            line-height: 1.6;
            font-family: 'Montserrat', sans-serif;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header professionnel */
        header {
            background: var(--white);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-top {
            background: var(--dark-blue);
            padding: 8px 0;
            font-size: 0.85rem;
        }
        
        .header-top-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-contact {
            display: flex;
            gap: 25px;
        }
        
        .header-contact a {
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.3s;
        }
        
        .header-contact a:hover {
            opacity: 0.85;
        }
        
        .header-contact i {
            color: var(--gold);
        }
        
        .social-links {
            display: flex;
            gap: 15px;
        }
        
        .social-links a {
            color: var(--white);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: var(--gold);
        }
        
        .main-header {
            padding: 15px 0;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }
        
        .logo-icon {
            width: 80px; /* Agrandissement du logo */
            height: 80px; /* Agrandissement du logo */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 2.5rem;
            background: transparent; /* Fond transparent pour le nouveau logo */
        }
        
        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }
        
        .logo-main {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem; /* Agrandissement du texte */
            font-weight: 700;
            color: var(--dark-blue);
            line-height: 1.1;
        }
        
        .logo-subtitle {
            font-size: 0.95rem; /* Agrandissement du texte */
            color: var(--gold);
            font-weight: 500;
            letter-spacing: 1px;
            margin-top: 3px;
        }
        
        nav ul {
            display: flex;
            list-style: none;
            gap: 35px;
        }
        
        nav ul li a {
            color: var(--dark-blue);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
            position: relative;
            padding: 8px 0;
        }
        
        nav ul li a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--gold);
            transition: width 0.3s ease;
        }
        
        nav ul li a:hover {
            color: var(--gold);
        }
        
        nav ul li a:hover:after {
            width: 100%;
        }
        
        nav ul li a.active {
            color: var(--gold);
        }
        
        nav ul li a.active:after {
            width: 100%;
        }
        
        .nav-cta {
            background-color: var(--gold);
            color: var(--dark-blue) !important;
            padding: 10px 22px !important;
            border-radius: 4px;
            font-weight: 600 !important;
            transition: all 0.3s !important;
            margin-left: 20px;
        }
        
        .nav-cta:hover {
            background-color: var(--dark-blue) !important;
            color: var(--gold) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .nav-cta:after {
            display: none;
        }
        
        /* Hero section */
        .hero {
            position:relative;
            width:100vw;
            left:50%;
            right:50%;
            margin-left:-50vw;
            margin-right:-50vw;
            min-height:100vh;
            padding:0;
            overflow:hidden;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        
        .hero img {
            width:100vw;
            height:100vh;
            object-fit:cover;
            display:block;
            position:absolute;
            top:0;
            left:0;
            z-index:1;
        }
        
        .hero-content {
            position:relative;
            z-index:2;
            width:100vw;
            height:100vh;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
        
        .hero h1 {
            color:white;
            font-size:3rem;
            text-shadow:0 2px 8px #000;
            font-weight:700;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero p {
            color:white;
            font-size:1.3rem;
            margin-bottom:35px;
            text-shadow:0 2px 8px #000;
            max-width:700px;
            text-align:center;
            font-weight: 300;
        }
        
        .btn {
            display: inline-block;
            background-color: var(--gold);
            color: var(--dark-blue);
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid var(--gold);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn:hover {
            background-color: transparent;
            color: var(--gold);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-light {
            background-color: transparent;
            color: var(--white);
            border: 1px solid var(--white);
            margin-left: 15px;
        }
        
        .btn-light:hover {
            background-color: var(--white);
            color: var(--dark-blue);
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

        /* Boutique Section */
        .boutique {
            padding: 90px 0;
            background-color: var(--light-blue);
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: var(--white);
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            border: 1px solid #f1f1f1;
            /* Changement pour que les cartes aient la même hauteur */
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Amélioration pour un meilleur rendu visuel */
        .product-image {
            width: 100%;
            height: 250px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease-in-out;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-content {
            padding: 20px;
            /* Assure que le contenu prend l'espace restant pour uniformiser les cartes */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-content h3 {
            color: var(--dark-blue);
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .product-content p {
            color: var(--text-gray);
            font-size: 1rem;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .product-price {
            font-weight: 700;
            color: var(--gold);
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .product-btn {
            display: block;
            background-color: var(--dark-blue);
            color: var(--white);
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            border: 1px solid var(--dark-blue);
            text-align: center;
        }

        .product-btn:hover {
            background-color: var(--gold);
            color: var(--dark-blue);
            border-color: var(--gold);
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
        
        /* Footer */
        footer {
            background: var(--dark-blue);
            color: var(--white);
            padding: 60px 0 25px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-about {
            margin-bottom: 20px;
        }
        
        .footer-logo .logo-main {
            color: var(--white);
        }
        
        .footer-about p {
            margin-bottom: 20px;
            line-height: 1.7;
            opacity: 0.85;
        }
        
        .footer-heading {
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: var(--gold);
            font-weight: 600;
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links ul li {
            margin-bottom: 12px;
        }
        
        .footer-links ul li a {
            color: var(--white);
            text-decoration: none;
            opacity: 0.85;
            transition: opacity 0.3s;
        }
        
        .footer-links ul li a:hover {
            opacity: 1;
            color: var(--gold);
        }
        
        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .footer-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .footer-social a:hover {
            background-color: var(--gold);
            color: var(--dark-blue);
            transform: translateY(-3px);
        }
        
        .copyright {
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            text-align: center;
            opacity: 0.7;
        }
        
        /* Mobile menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--dark-blue);
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            nav ul {
                gap: 20px;
            }
            
            .logo-main {
                font-size: 1.4rem;
            }
        }
        
        @media (max-width: 768px) {
            .header-top-container {
                flex-direction: column;
                gap: 10px;
            }
            
            .header-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            
            .mobile-menu-btn {
                display: block;
                position: absolute;
                top: 20px;
                right: 20px;
            }
            
            nav {
                width: 100%;
                display: none;
            }
            
            nav.active {
                display: block;
            }
            
            nav ul {
                flex-direction: column;
                gap: 15px;
                margin-top: 20px;
            }
            
            .nav-cta {
                margin-left: 0;
                margin-top: 10px;
                display: inline-block;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1.05rem;
            }
            
            .services-grid, .products-grid {
                grid-template-columns: 1fr;
            }
            
            .contact-wrapper {
                grid-template-columns: 1fr;
            }
            
            .btn-light {
                margin-left: 0;
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header professionnel -->
    <header>
        <!-- [COLLER LE HEADER DE VOTRE FICHIER ICI] -->
        <header>
        <div class="header-top">
            <div class="container header-top-container">
                <div class="header-contact">
                    <a href="tel:0696097806">
                        <i class="fas fa-phone"></i>
                        <span>0696097806</span>
                    </a>
                    <a href="mailto:cvmanutention@gmail.com">
                        <i class="fas fa-envelope"></i>
                        <span>cvmanutention@gmail.com</span>
                    </a>
                </div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        
        <div class="container main-header">
            <div class="header-content">
                <a href="#" class="logo">
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo-caraibes-voiles.png') }}" alt="Logo Caraïbes Voiles">
                    </div>
                    <div class="logo-text">
                        <div class="logo-main">CARAÏBES VOILES</div>
                        <div class="logo-subtitle">MANUTENTION & CONFECTION</div>
                    </div>
                </a>
                
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
                
                <nav id="main-nav">
                    <ul>
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#boutique">Boutique</a></li>
                        <li><a href="#about">À Propos</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#devis" class="nav-cta">Devis</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="accueil" class="hero" style="position:relative; width:100vw; left:50%; right:50%; margin-left:-50vw; margin-right:-50vw; min-height:100vh; padding:0; overflow:hidden; display:flex; align-items:center; justify-content:center;">
        <!-- Image hero qui remplit tout l'écran -->
        <img src="{{ asset('images/hero-boutique.jpg') }}" alt="Boutique Caraïbes Voiles"
             style="width:100vw; height:100vh; object-fit:cover; display:block; position:absolute; top:0; left:0; z-index:1;">
        <!-- Texte positionné sur l'image, SANS box/fond -->
        <div style="position:relative; z-index:2; width:100vw; height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center;">
            <h1 style="color:white; font-size:3rem; text-shadow:0 2px 8px #000; font-weight:700;">Expert en Confection & Réparation de Voiles</h1>
            <p style="color:white; font-size:1.3rem; margin-bottom:35px; text-shadow:0 2px 8px #000; max-width:700px; text-align:center;">Spécialistes en fabrication et réparation de voiles, bâches, biminis et capitonnage pour auto, moto, bateau et ameublement</p>
            <div style="text-align:center;">
                <a href="#contact" class="btn">Demander un devis</a>
                <a href="#services" class="btn btn-light">Découvrir nos services</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <!-- [COLLER LA SECTION SERVICES ICI] -->
        
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

    <!-- Boutique Section -->
    <section id="boutique" class="boutique">
        <div class="container">
            <div class="section-title">
                <h2>Boutique</h2>
                <p>Découvrez notre sélection d'accessoires de qualité pour l'entretien et la protection de vos voiles et équipements</p>
            </div>
            <div class="products-grid">
                @php
                    $products = App\Models\Product::where('in_stock', true)->limit(6)->get();
                @endphp

                @forelse($products as $product)
                    <div class="product-card" onclick="window.location.href='{{ route('products.show', $product) }}'" style="cursor: pointer;">
                        <div class="product-image">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://placehold.co/400x400/1a4f7a/ffffff?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
                            @endif
                        </div>
                        <div class="product-content">
                            <h3>{{ Str::limit($product->name, 30) }}</h3>
                            <p>{{ Str::limit($product->description, 80) }}</p>
                            <div class="product-price">{{ number_format($product->price, 2) }}€</div>
                            <a href="{{ route('products.show', $product) }}" class="product-btn" onclick="event.stopPropagation();">Voir le produit</a>
                        </div>
                    </div>
                @empty
                    <!-- Produits par défaut si pas de produits en base -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://placehold.co/400x400/1a4f7a/ffffff?text=Accessoire+1" alt="Accessoire 1">
                        </div>
                        <div class="product-content">
                            <h3>Kit de Réparation de Voile</h3>
                            <p>Tout le nécessaire pour les petites réparations sur place.</p>
                            <div class="product-price">29,99€</div>
                            <a href="#" class="product-btn">Ajouter au panier</a>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://placehold.co/400x400/de419a/ffffff?text=Accessoire+2" alt="Accessoire 2">
                        </div>
                        <div class="product-content">
                            <h3>Nettoyant de Toile Marine</h3>
                            <p>Nettoyant puissant et sûr pour toutes les toiles et voiles.</p>
                            <div class="product-price">19,50€</div>
                            <a href="#" class="product-btn">Ajouter au panier</a>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://placehold.co/400x400/0d2f4f/ffffff?text=Accessoire+3" alt="Accessoire 3">
                        </div>
                        <div class="product-content">
                            <h3>Housse de Protection</h3>
                            <p>Housse universelle et durable pour protéger votre matériel.</p>
                            <div class="product-price">45,00€</div>
                            <a href="#" class="product-btn">Ajouter au panier</a>
                        </div>
                    </div>
                @endforelse

                @if($products->count() >= 6)
                    <div class="product-card" style="background: linear-gradient(135deg, var(--dark-blue), var(--medium-blue)); color: white; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                        <a href="{{ route('products.index') }}" style="color: white; text-decoration: none; text-align: center;">
                            <i class="fas fa-plus" style="font-size: 3rem; margin-bottom: 20px; color: var(--gold);"></i>
                            <h3>Voir tous nos produits</h3>
                            <p>Découvrez notre gamme complète</p>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <!-- [COLLER LA SECTION ABOUT ICI] -->
         
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
        <!-- [COLLER LA SECTION CONTACT ICI] --><div class="container">
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3861.3779534897167!2d-60.9887804248942!3d14.577526685906111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTTCsDM0JzM5LjEiTiA2MMKwNTknMTAuMyJX!5e0!3m2!1sfr!2sfr!4v1757351477554!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

        
    
    <!-- Footer -->
    <footer>
        <!-- [COLLER LE FOOTER ICI] -->
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <div class="footer-logo">
                        <div class="logo-main">CARAÏBES VOILES</div>
                        <div class="logo-subtitle">MANUTENTION & CONFECTION</div>
                    </div>
                    <p>Expert en confection et réparation de voiles, bâches et articles de capitonnage depuis plus de 10 ans.</p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="footer-links">
                    <h4 class="footer-heading">Liens Rapides</h4>
                    <ul>
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">À Propos</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#devis">Demande de Devis</a></li>
                    </ul>
                </div>
                
                <div class="footer-links">
                    <h4 class="footer-heading">Nos Services</h4>
                    <ul>
                        <li><a href="#services">Tauds et Voiles</a></li>
                        <li><a href="#services">Bâches</a></li>
                        <li><a href="#services">Capitonnage</a></li>
                        <li><a href="#services">Biminis</a></li>
                        <li><a href="#services">Sièges et Coussins</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 Caraïbes Voiles Manutention - Tous droits réservés - Siret: 91915140700021</p>
            </div>
        </div>
    </footer>

    <script>
        // Script pour le menu mobile
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('main-nav').classList.toggle('active');
        });

        // Navigation fluide vers les sections
        document.addEventListener('DOMContentLoaded', function() {
            // Sélectionner tous les liens de navigation
            const navLinks = document.querySelectorAll('nav a[href^="#"]');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Récupérer l'ID de la section cible
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);
                    
                    if (targetSection) {
                        // Fermer le menu mobile si ouvert
                        const mobileNav = document.getElementById('main-nav');
                        if (mobileNav.classList.contains('active')) {
                            mobileNav.classList.remove('active');
                        }
                        
                        // Calculer l'offset pour compenser le header fixe
                        const headerHeight = document.querySelector('header').offsetHeight;
                        const targetPosition = targetSection.offsetTop - headerHeight - 20;
                        
                        // Navigation fluide
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Mise à jour de l'état actif du menu lors du scroll
            window.addEventListener('scroll', function() {
                const sections = document.querySelectorAll('section[id]');
                const headerHeight = document.querySelector('header').offsetHeight;
                let currentSection = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - headerHeight - 50;
                    const sectionBottom = sectionTop + section.offsetHeight;
                    const scrollPosition = window.scrollY;
                    
                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        currentSection = section.getAttribute('id');
                    }
                });
                
                // Mettre à jour les liens actifs
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + currentSection) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>
</html>