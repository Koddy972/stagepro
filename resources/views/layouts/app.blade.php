<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Caraïbes Voiles Manutention')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS (optionnel) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Styles fixes de la navbar - Chargé en priorité -->
    <link rel="stylesheet" href="{{ asset('css/navbar-fixed.css') }}">
    
    <!-- Animations des boutons hero -->
    <link rel="stylesheet" href="{{ asset('css/hero-buttons.css') }}">
    
    <style>
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
            scroll-padding-top: 120px;
        }
        
        /* Protection des styles de navigation - Ne peut pas être surchargé */
        header, header *, 
        .header-top, .header-top *, 
        .main-header, .main-header *,
        nav, nav *, 
        .logo, .logo *,
        .cart-icon, .cart-icon *,
        .admin-btn {
            box-sizing: border-box !important;
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

        /* Header professionnel - Proportions fixes */
        header {
            background: var(--white) !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08) !important;
            position: sticky !important;
            top: 0 !important;
            z-index: 1000 !important;
            width: 100% !important;
        }
        
        .header-top {
            background: var(--dark-blue) !important;
            padding: 8px 0 !important;
            font-size: 0.85rem !important;
        }
        
        .header-top-container {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
            max-width: 1200px !important;
            margin: 0 auto !important;
            padding: 0 20px !important;
        }
        
        .header-contact {
            display: flex !important;
            gap: 25px !important;
        }
        
        .header-contact a {
            color: var(--white) !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            transition: opacity 0.3s ease !important;
            font-size: 0.85rem !important;
        }        
        .header-contact a:hover {
            opacity: 0.85 !important;
        }
        
        .header-contact i {
            color: var(--gold) !important;
            font-size: 0.85rem !important;
        }
        
        .social-links {
            display: flex !important;
            gap: 15px !important;
        }
        
        .social-links a {
            color: var(--white) !important;
            text-decoration: none !important;
            transition: color 0.3s ease !important;
            font-size: 1rem !important;
        }
        
        .social-links a:hover {
            color: var(--gold) !important;
        }
        
        .main-header {
            padding: 12px 0 !important;
        }
        
        .header-content {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
            max-width: 1200px !important;
            margin: 0 auto !important;
            padding: 0 20px !important;
            overflow: visible !important;
        }
        
        .logo {
            display: flex !important;
            align-items: center !important;
            gap: 15px !important;
            text-decoration: none !important;
        }        
        .logo-icon {
            width: 65px !important;
            height: 65px !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: var(--gold) !important;
            font-size: 2rem !important;
            background: transparent !important;
            flex-shrink: 0 !important;
        }
        
        .logo-icon img {
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
        }

        .logo-text {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 5px !important;
        }
        
        .logo-main {
            font-family: 'Playfair Display', serif !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: var(--dark-blue) !important;
            line-height: 1 !important;
            white-space: nowrap !important;
        }
        
        .logo-subtitle {
            font-size: 0.75rem !important;
            color: var(--gold) !important;
            font-weight: 500 !important;
            letter-spacing: 0.5px !important;
            white-space: nowrap !important;
            border-left: 2px solid var(--gold) !important;
            padding-left: 10px !important;
        }        
        nav ul {
            display: flex !important;
            list-style: none !important;
            gap: 25px !important;
            align-items: center !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
        }
        
        nav ul li {
            margin: 0 !important;
            padding: 0 !important;
            position: relative !important;
            overflow: visible !important;
        }
        
        nav ul li a {
            color: var(--dark-blue) !important;
            text-decoration: none !important;
            font-weight: 500 !important;
            font-size: 0.95rem !important;
            transition: color 0.3s ease !important;
            position: relative !important;
            padding: 8px 0 !important;
            display: inline-block !important;
            white-space: nowrap !important;
        }
        
        nav ul li a:after {
            content: '' !important;
            position: absolute !important;
            width: 0 !important;
            height: 2px !important;
            bottom: 0 !important;
            left: 0 !important;
            background-color: var(--gold) !important;
            transition: width 0.3s ease !important;
            opacity: 0 !important;
        }
        
        nav ul li a:hover {
            color: var(--gold) !important;
        }
        
        nav ul li a:hover:after {
            width: 100% !important;
            opacity: 1 !important;
        }
        
        nav ul li a.active {
            color: var(--gold) !important;
        }
        
        nav ul li a.active:after {
            width: 100% !important;
            opacity: 1 !important;
        }
        
        /* Désactiver la ligne de soulignement pour les boutons spéciaux */
        .cart-icon a:after,
        .client-login-btn:after,
        .client-account-btn:after,
        .admin-btn:after,
        .client-dropdown-menu a:after,
        .client-dropdown-menu button:after {
            display: none !important;
        }        
        /* Styles pour le panier dans le header - Design moderne */
        .cart-icon {
            position: relative !important;
            display: inline-block !important;
            margin-left: 20px !important;
            overflow: visible !important;
        }
        
        .cart-icon a {
            background: linear-gradient(135deg, var(--gold) 0%, #c73584 100%) !important;
            color: var(--white) !important;
            padding: 10px 20px !important;
            border-radius: 25px !important;
            font-weight: 600 !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            box-shadow: 0 2px 8px rgba(222, 65, 154, 0.3) !important;
            position: relative !important;
            overflow: hidden !important;
        }
        
        .cart-icon a:before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent) !important;
            transition: left 0.5s ease !important;
            z-index: 1 !important;
        }
        
        .cart-icon a:hover:before {
            left: 100% !important;
        }
        
        .cart-icon a span,
        .cart-icon a i {
            position: relative !important;
            z-index: 2 !important;
        }
        
        .cart-icon a:hover {
            background: linear-gradient(135deg, #c73584 0%, var(--dark-blue) 100%) !important;
            color: var(--white) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 15px rgba(222, 65, 154, 0.4) !important;
        }
        
        .cart-icon a i {
            transition: transform 0.3s ease !important;
        }
        
        .cart-icon a:hover i {
            transform: scale(1.1) !important;
        }
        
        .cart-count {
            position: absolute !important;
            top: -8px !important;
            right: -10px !important;
            background-color: #ff0000 !important;
            color: white !important;
            border-radius: 50% !important;
            min-width: 22px !important;
            height: 22px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            padding: 0 5px !important;
            border: 2px solid white !important;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3) !important;
            z-index: 10 !important;
        }
        
        /* Styles pour le bouton admin - Design moderne */
        .admin-btn {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%) !important;
            color: var(--white) !important;
            padding: 10px 20px !important;
            border-radius: 25px !important;
            font-weight: 600 !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            box-shadow: 0 2px 8px rgba(13, 47, 79, 0.3) !important;
            position: relative !important;
            overflow: hidden !important;
        }
        
        .admin-btn:before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%) !important;
            transition: left 0.5s ease !important;
        }
        
        .admin-btn:hover:before {
            left: 100% !important;
        }
        
        .admin-btn:hover {
            background: linear-gradient(135deg, var(--gold) 0%, #c73584 100%) !important;
            color: var(--white) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 15px rgba(222, 65, 154, 0.4) !important;
        }
        
        .admin-btn i {
            transition: transform 0.3s ease !important;
        }
        
        .admin-btn:hover i {
            transform: scale(1.1) !important;
        }
        
        /* Styles pour les boutons client - Design moderne et élégant */
        .client-login-btn {
            background: linear-gradient(135deg, var(--gold) 0%, #c73584 100%) !important;
            color: var(--white) !important;
            padding: 10px 20px !important;
            border-radius: 25px !important;
            font-weight: 600 !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            box-shadow: 0 2px 8px rgba(222, 65, 154, 0.3) !important;
            border: none !important;
            position: relative !important;
            overflow: hidden !important;
        }
        
        .client-login-btn:before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent) !important;
            transition: left 0.5s ease !important;
            z-index: 1 !important;
        }
        
        .client-login-btn:hover:before {
            left: 100% !important;
        }
        
        .client-login-btn span,
        .client-login-btn i {
            position: relative !important;
            z-index: 2 !important;
        }
        
        .client-login-btn:hover {
            background: linear-gradient(135deg, #c73584 0%, var(--dark-blue) 100%) !important;
            color: var(--white) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 15px rgba(222, 65, 154, 0.4) !important;
        }
        
        .client-login-btn i {
            font-size: 1rem !important;
            transition: transform 0.3s ease !important;
        }
        
        .client-login-btn:hover i {
            transform: scale(1.1) !important;
        }
        
        .client-account-btn {
            background: linear-gradient(135deg, rgba(222, 65, 154, 0.1) 0%, rgba(199, 53, 132, 0.1) 100%) !important;
            color: var(--dark-blue) !important;
            padding: 10px 18px !important;
            border-radius: 25px !important;
            font-weight: 600 !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            border: 2px solid var(--gold) !important;
            cursor: pointer !important;
            box-shadow: 0 2px 8px rgba(222, 65, 154, 0.2) !important;
            position: relative !important;
            overflow: hidden !important;
        }
        
        .client-account-btn:before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.2), transparent) !important;
            transition: left 0.5s ease !important;
            z-index: 1 !important;
        }
        
        .client-account-btn:hover:before {
            left: 100% !important;
        }
        
        .client-account-btn span,
        .client-account-btn i {
            position: relative !important;
            z-index: 2 !important;
        }
        
        .client-account-btn i {
            font-size: 1rem !important;
            color: var(--gold) !important;
            transition: all 0.3s ease !important;
        }
        
        .client-account-btn:hover {
            background: linear-gradient(135deg, var(--gold) 0%, #c73584 100%) !important;
            color: var(--white) !important;
            border-color: var(--gold) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 15px rgba(222, 65, 154, 0.3) !important;
        }
        
        .client-account-btn:hover i {
            color: var(--white) !important;
            transform: scale(1.1) !important;
        }
        
        /* Menu déroulant du profil client */
        .client-dropdown {
            position: relative !important;
        }
        
        .client-dropdown-menu {
            position: absolute !important;
            top: 100% !important;
            right: 0 !important;
            margin-top: 10px !important;
            background: var(--white) !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
            min-width: 200px !important;
            opacity: 0 !important;
            visibility: hidden !important;
            transform: translateY(-10px) !important;
            transition: all 0.3s ease !important;
            z-index: 1000 !important;
            padding: 10px 0 !important;
        }
        
        .client-dropdown-menu.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
        }
        
        .client-dropdown-menu::before {
            content: '' !important;
            position: absolute !important;
            top: -8px !important;
            right: 20px !important;
            width: 0 !important;
            height: 0 !important;
            border-left: 8px solid transparent !important;
            border-right: 8px solid transparent !important;
            border-bottom: 8px solid var(--white) !important;
        }
        
        .client-dropdown-menu a,
        .client-dropdown-menu button {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            padding: 12px 20px !important;
            color: var(--dark-blue) !important;
            text-decoration: none !important;
            transition: background-color 0.3s ease !important;
            width: 100% !important;
            text-align: left !important;
            border: none !important;
            background: transparent !important;
            font-size: 0.9rem !important;
            font-weight: 500 !important;
            cursor: pointer !important;
        }
        
        .client-dropdown-menu a:hover,
        .client-dropdown-menu button:hover {
            background-color: var(--light-blue) !important;
        }
        
        .client-dropdown-menu i {
            color: var(--gold) !important;
            font-size: 1rem !important;
            width: 20px !important;
        }
        
        .client-dropdown-menu .divider {
            height: 1px !important;
            background-color: #e0e0e0 !important;
            margin: 5px 0 !important;
        }
        
        .logout-form {
            display: inline !important;
            margin: 0 !important;
        }
        
        .logout-form button {
            background: none !important;
            border: none !important;
            color: var(--dark-blue) !important;
            font: inherit !important;
            cursor: pointer !important;
            padding: 8px 0 !important;
            font-weight: 500 !important;
            font-size: 0.95rem !important;
            transition: color 0.3s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        
        .logout-form button i {
            font-size: 0.9rem !important;
        }
        
        .logout-form button:hover {
            color: var(--gold) !important;
        }
        
        /* Styles utilitaires */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }        
        .btn-primary {
            background-color: var(--dark-blue);
            color: var(--white);
        }
        
        .btn-primary:hover {
            background-color: var(--gold);
            color: var(--dark-blue);
        }
        
        .btn-success {
            background-color: #28a745;
            color: var(--white);
        }
        
        .btn-success:hover {
            background-color: #218838;
        }
        
        /* Footer */
        footer {
            background: var(--dark-blue);
            color: var(--white);
            padding: 40px 0 20px;
            margin-top: 50px;
        }
        
        .footer-content {
            text-align: center;
        }
        
        .footer-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .footer-logo .logo-main {
            color: var(--white);
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            white-space: nowrap;
        }
        
        .footer-logo .logo-subtitle {
            color: var(--gold);
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            white-space: nowrap;
            border-left: 2px solid var(--gold);
            padding-left: 12px;
        }
        
        /* Mobile responsive - Maintien des proportions */
        @media (max-width: 768px) {
            .header-top-container {
                flex-direction: column !important;
                gap: 10px !important;
            }
            
            .header-content {
                flex-direction: column !important;
                gap: 20px !important;
                text-align: center !important;
            }
            
            .logo {
                flex-direction: column !important;
            }
            
            .logo-text {
                flex-direction: column !important;
                gap: 3px !important;
            }
            
            .logo-icon {
                width: 70px !important;
                height: 70px !important;
            }
            
            .logo-main {
                font-size: 1.3rem !important;
            }
            
            .logo-subtitle {
                font-size: 0.7rem !important;
                border-left: none !important;
                padding-left: 0 !important;
            }
            
            nav ul {
                flex-direction: column !important;
                gap: 15px !important;
                margin-top: 20px !important;
            }
            
            .cart-icon {
                margin-left: 0 !important;
                margin-top: 10px !important;
            }
            
            /* Footer responsive */
            .footer-logo {
                flex-direction: column !important;
                gap: 5px !important;
            }
            
            .footer-logo .logo-main {
                font-size: 1.3rem !important;
            }
            
            .footer-logo .logo-subtitle {
                font-size: 0.7rem !important;
                border-left: none !important;
                padding-left: 0 !important;
            }
        }
        
        /* Ajustements pour navbar avec utilisateur connecté */
        @media (max-width: 1200px) {
            nav ul {
                gap: 18px !important;
            }
            
            nav ul li a {
                font-size: 0.9rem !important;
            }
            
            .client-account-btn {
                padding: 6px 10px !important;
                font-size: 0.85rem !important;
            }
            
            .logout-form button {
                font-size: 0.9rem !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Header -->
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
                <a href="{{ route('accueil') }}" class="logo">
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo-caraibes-voiles.png') }}" alt="Logo Caraïbes Voiles">
                    </div>
                    <div class="logo-text">
                        <div class="logo-main">CARAÏBES VOILES</div>
                        <div class="logo-subtitle">MANUTENTION & CONFECTION</div>
                    </div>
                </a>
                
                <nav>
                    <ul>
                        <li><a href="{{ route('accueil') }}">Accueil</a></li>
                        <li><a href="{{ route('accueil') }}#services">Services</a></li>
                        <li><a href="{{ route('boutique') }}">Boutique</a></li>
                        <li><a href="{{ route('galerie') }}">Galerie</a></li>
                        <li><a href="{{ route('accueil') }}#about">À Propos</a></li>
                        <li><a href="{{ route('accueil') }}#contact">Contact</a></li>
                        
                        @if(session('admin_authenticated'))
                            <li>
                                <a href="{{ route('products.index') }}" class="admin-btn">
                                    <i class="fas fa-cog"></i>
                                    Gestion
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                                    @csrf
                                    <button type="submit">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Déconnexion
                                    </button>
                                </form>
                            </li>
                        @endif
                        
                        @auth
                            @if(Auth::user()->isClient())
                                <li class="client-dropdown">
                                    <a href="#" class="client-account-btn" id="clientDropdownBtn">
                                        <i class="fas fa-user-circle"></i>
                                        {{ explode(' ', Auth::user()->name)[0] }}
                                        <i class="fas fa-chevron-down" style="font-size: 0.7rem;"></i>
                                    </a>
                                    <div class="client-dropdown-menu" id="clientDropdownMenu">
                                        <a href="{{ route('my.orders') }}">
                                            <i class="fas fa-shopping-bag"></i>
                                            Mes commandes
                                        </a>
                                        <div class="divider"></div>
                                        <form action="{{ route('client.logout') }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <button type="submit">
                                                <i class="fas fa-sign-out-alt"></i>
                                                Déconnexion
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @else
                            <li>
                                <a href="{{ route('client.login') }}" class="client-login-btn">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Connexion
                                </a>
                            </li>
                        @endauth
                        
                        <li class="cart-icon">
                            <a href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                Panier
                                <span class="cart-count" id="cart-count">0</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <div class="logo-main">CARAÏBES VOILES</div>
                    <div class="logo-subtitle">MANUTENTION & CONFECTION</div>
                </div>
                <p>Expert en confection et réparation de voiles, bâches et articles de capitonnage.</p>
                <p>&copy; 2024 Caraïbes Voiles Manutention - Tous droits réservés</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script de protection de la navbar - Chargé en priorité -->
    <script src="{{ asset('js/navbar-protection.js') }}"></script>
    
    <!-- Script de navigation -->
    <script src="{{ asset('js/navigation.js') }}"></script>
    
    <!-- Script pour mettre à jour le compteur du panier -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            handleAnchorNavigation();
        });

        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const count = data.count || data || 0;
                    const cartCountElement = document.getElementById('cart-count');
                    if (cartCountElement) {
                        cartCountElement.textContent = count;
                        // Toujours afficher le badge, même quand c'est 0
                        cartCountElement.style.display = 'flex';
                    }
                })
                .catch(error => console.error('Erreur lors de la mise à jour du compteur:', error));
        }

        // Fonction utilitaire pour les notifications
        function showNotification(message, type = 'success') {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
            alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alert);
            
            setTimeout(() => {
                if (alert && alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        }

        // Gérer la navigation vers les ancres depuis n'importe quelle page
        function handleAnchorNavigation() {
            // Si on arrive sur la page avec une ancre dans l'URL
            if (window.location.hash) {
                setTimeout(function() {
                    const targetId = window.location.hash;
                    const targetSection = document.querySelector(targetId);
                    
                    if (targetSection) {
                        const headerHeight = document.querySelector('header').offsetHeight;
                        const targetPosition = targetSection.offsetTop - headerHeight - 20;
                        
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            }
        }

        // Rendre les fonctions globales pour les autres scripts
        window.updateCartCount = updateCartCount;
        window.showNotification = showNotification;
        
        // Gestion du lien actif dans la navigation
        function setActiveNavLink() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('nav ul li a:not(.admin-btn):not(.cart-icon a)');
            
            // Retire la classe active de tous les liens
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
            
            // Ajoute la classe active au lien correspondant
            navLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                
                // Ignore les liens avec ancres pour la page actuelle
                if (linkHref && linkHref.includes('#')) {
                    const linkPath = linkHref.split('#')[0];
                    // Si c'est un lien ancre vers la page actuelle
                    if (linkPath === '' || linkPath === currentPath || linkPath.endsWith('accueil')) {
                        if (currentPath === '/' || currentPath === '/accueil' || currentPath.includes('accueil')) {
                            // Active seulement "Accueil" ou le lien ancre si on est sur la section
                            if (window.location.hash && linkHref.includes(window.location.hash)) {
                                link.classList.add('active');
                            } else if (!window.location.hash && link.textContent.trim() === 'Accueil') {
                                link.classList.add('active');
                            }
                        }
                    }
                } else {
                    // Pour les liens normaux
                    const linkURL = new URL(link.href, window.location.origin);
                    const linkPath = linkURL.pathname;
                    
                    // Active le lien si le chemin correspond
                    if (linkPath === currentPath) {
                        link.classList.add('active');
                    } else if (currentPath === '/' && linkPath.includes('accueil')) {
                        link.classList.add('active');
                    } else if (linkPath !== '/' && currentPath.includes(linkPath) && linkPath.length > 1) {
                        link.classList.add('active');
                    }
                }
            });
        }
        
        // Appeler au chargement
        setActiveNavLink();
        
        // Mettre à jour si l'URL change (navigation avec ancres)
        window.addEventListener('hashchange', setActiveNavLink);
        
        // Gestion du menu déroulant du profil client
        const clientDropdownBtn = document.getElementById('clientDropdownBtn');
        const clientDropdownMenu = document.getElementById('clientDropdownMenu');
        
        if (clientDropdownBtn && clientDropdownMenu) {
            // Toggle menu au clic sur le bouton
            clientDropdownBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                clientDropdownMenu.classList.toggle('show');
            });
            
            // Fermer le menu si on clique ailleurs
            document.addEventListener('click', function(e) {
                if (!clientDropdownBtn.contains(e.target) && !clientDropdownMenu.contains(e.target)) {
                    clientDropdownMenu.classList.remove('show');
                }
            });
            
            // Empêcher la fermeture si on clique dans le menu
            clientDropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>