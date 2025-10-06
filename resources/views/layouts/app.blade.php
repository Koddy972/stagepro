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
            padding: 15px 0 !important;
        }
        
        .header-content {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
            max-width: 1200px !important;
            margin: 0 auto !important;
            padding: 0 20px !important;
        }
        
        .logo {
            display: flex !important;
            align-items: center !important;
            gap: 15px !important;
            text-decoration: none !important;
        }        
        .logo-icon {
            width: 80px !important;
            height: 80px !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: var(--gold) !important;
            font-size: 2.5rem !important;
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
        }
        
        .logo-main {
            font-family: 'Playfair Display', serif !important;
            font-size: 2.2rem !important;
            font-weight: 700 !important;
            color: var(--dark-blue) !important;
            line-height: 1.1 !important;
        }
        
        .logo-subtitle {
            font-size: 0.95rem !important;
            color: var(--gold) !important;
            font-weight: 500 !important;
            letter-spacing: 1px !important;
            margin-top: 3px !important;
        }        
        nav ul {
            display: flex !important;
            list-style: none !important;
            gap: 35px !important;
            align-items: center !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        nav ul li {
            margin: 0 !important;
            padding: 0 !important;
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
        /* Styles pour le panier dans le header - Proportions fixes */
        .cart-icon {
            position: relative !important;
            display: inline-block !important;
            margin-left: 20px !important;
        }
        
        .cart-icon a {
            background-color: var(--gold) !important;
            color: var(--dark-blue) !important;
            padding: 10px 15px !important;
            border-radius: 4px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        
        .cart-icon a:hover {
            background-color: var(--dark-blue) !important;
            color: var(--gold) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        }
        
        .cart-count {
            position: absolute !important;
            top: -5px !important;
            right: -5px !important;
            background-color: #dc3545 !important;
            color: white !important;
            border-radius: 50% !important;
            width: 20px !important;
            height: 20px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 0.75rem !important;
            font-weight: bold !important;
        }
        
        /* Styles pour le bouton admin - Proportions fixes */
        .admin-btn {
            background-color: var(--dark-blue) !important;
            color: var(--white) !important;
            padding: 10px 15px !important;
            border-radius: 4px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        
        .admin-btn:hover {
            background-color: var(--gold) !important;
            color: var(--dark-blue) !important;
            transform: translateY(-2px) !important;
        }
        
        .logout-form {
            display: inline !important;
        }
        
        .logout-form button {
            background: none !important;
            border: none !important;
            color: var(--dark-blue) !important;
            font: inherit !important;
            cursor: pointer !important;
            padding: 0 !important;
            font-weight: 500 !important;
            transition: color 0.3s ease !important;
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
        
        .footer-logo .logo-main {
            color: var(--white);
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
            
            .logo-icon {
                width: 70px !important;
                height: 70px !important;
            }
            
            .logo-main {
                font-size: 1.8rem !important;
            }
            
            .logo-subtitle {
                font-size: 0.85rem !important;
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
        }    </style>

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
                        cartCountElement.style.display = count > 0 ? 'flex' : 'none';
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
    </script>
    
    @stack('scripts')
</body>
</html>