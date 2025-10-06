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
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 2.5rem;
            background: transparent;
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
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-blue);
            line-height: 1.1;
        }
        
        .logo-subtitle {
            font-size: 0.95rem;
            color: var(--gold);
            font-weight: 500;
            letter-spacing: 1px;
            margin-top: 3px;
        }        
        nav ul {
            display: flex;
            list-style: none;
            gap: 35px;
            align-items: center;
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
        /* Styles pour le panier dans le header */
        .cart-icon {
            position: relative;
            display: inline-block;
            margin-left: 20px;
        }
        
        .cart-icon a {
            background-color: var(--gold);
            color: var(--dark-blue) !important;
            padding: 10px 15px !important;
            border-radius: 4px;
            font-weight: 600 !important;
            transition: all 0.3s !important;
            text-decoration: none !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .cart-icon a:hover {
            background-color: var(--dark-blue) !important;
            color: var(--gold) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        /* Styles pour le bouton admin */
        .admin-btn {
            background-color: var(--dark-blue) !important;
            color: var(--white) !important;
            padding: 10px 15px !important;
            border-radius: 4px !important;
            font-weight: 600 !important;
            transition: all 0.3s !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        
        .admin-btn:hover {
            background-color: var(--gold) !important;
            color: var(--dark-blue) !important;
            transform: translateY(-2px);
        }
        
        .logout-form {
            display: inline;
        }
        
        .logout-form button {
            background: none;
            border: none;
            color: var(--dark-blue);
            font: inherit;
            cursor: pointer;
            padding: 0;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .logout-form button:hover {
            color: var(--gold);
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
        
        /* Mobile responsive */
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
            
            nav ul {
                flex-direction: column;
                gap: 15px;
                margin-top: 20px;
            }
            
            .cart-icon {
                margin-left: 0;
                margin-top: 10px;
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
    
    <!-- Script pour mettre à jour le compteur du panier -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
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

        // Rendre les fonctions globales pour les autres scripts
        window.updateCartCount = updateCartCount;
        window.showNotification = showNotification;
    </script>
    
    @stack('scripts')
</body>
</html>