<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique - Caraïbes Voiles Manutention</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root{--dark-blue:#0d2f4f;--medium-blue:#1a4f7a;--light-blue:#e9f1f7;--gold:#de419a;--dark-gold:#a98b56;--white:#fff;--light-gray:#f8f9fa;--dark-gray:#2d3436;--text-gray:#5c5c5c}*{margin:0;padding:0;box-sizing:border-box}body{background-color:var(--light-gray);color:var(--text-gray);line-height:1.6;font-family:Montserrat,sans-serif}.container{width:100%;max-width:1200px;margin:0 auto;padding:0 20px}header{background:var(--white);box-shadow:0 2px 15px rgba(0,0,0,.08);position:sticky;top:0;z-index:1000}.header-top{background:var(--dark-blue);padding:8px 0;font-size:.85rem}.header-top-container{display:flex;justify-content:space-between;align-items:center}.header-contact{display:flex;gap:25px}.header-contact a{color:var(--white);text-decoration:none;display:flex;align-items:center;gap:8px;transition:opacity .3s}.header-contact i{color:var(--gold)}.social-links{display:flex;gap:15px}.social-links a{color:var(--white);transition:color .3s}.social-links a:hover{color:var(--gold)}.main-header{padding:15px 0}.header-content{display:flex;justify-content:space-between;align-items:center}.logo{display:flex;align-items:center;gap:15px;text-decoration:none}.logo-icon{width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:2.5rem;background-color:var(--light-blue);overflow:hidden}.logo-icon img{width:100%;height:100%;object-fit:contain}.logo-text{display:flex;flex-direction:column}.logo-main{font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:700;color:var(--dark-blue);line-height:1.1}.logo-subtitle{font-size:.95rem;color:var(--gold);font-weight:500;letter-spacing:1px;margin-top:3px}nav ul{display:flex;list-style:none;gap:35px}nav ul li a{color:var(--dark-blue);text-decoration:none;font-weight:500;font-size:.95rem;transition:color .3s;position:relative;padding:8px 0}nav ul li a:after{content:'';position:absolute;width:0;height:2px;bottom:0;left:0;background-color:var(--gold);transition:width .3s ease}nav ul li a:hover{color:var(--gold)}nav ul li a.active-link{color:var(--gold)}nav ul li a.active-link:after,nav ul li a:hover:after{width:100%}.nav-cta{background-color:var(--gold)!important;color:var(--dark-blue)!important;padding:10px 22px!important;border-radius:4px;font-weight:600!important;transition:all .3s!important;margin-left:20px;box-shadow:0 4px 8px rgba(0,0,0,.1)}.nav-cta:hover{background-color:var(--dark-blue)!important;color:var(--gold)!important;transform:translateY(-2px);box-shadow:0 6px 12px rgba(0,0,0,.2)}.nav-cta:after{display:none}.mobile-menu-btn{display:none;background:0 0;border:none;color:var(--dark-blue);font-size:1.5rem;cursor:pointer}.btn{display:inline-block;background-color:var(--gold);color:var(--dark-blue);padding:14px 32px;text-decoration:none;border-radius:4px;font-weight:600;transition:all .3s;border:1px solid var(--gold);box-shadow:0 4px 12px rgba(0,0,0,.15)}.btn:hover{background-color:var(--dark-blue);color:var(--gold);transform:translateY(-2px);box-shadow:0 6px 15px rgba(0,0,0,.2)}.boutique-hero{background:linear-gradient(rgba(13,47,79,.9),rgba(13,47,79,.8)),url(https://placehold.co/1920x400/0d2f4f/e9f1f7?text=Boutique+Caraïbes+Voiles);background-size:cover;background-position:center;padding:80px 0;text-align:center;color:var(--white);margin-bottom:40px}.boutique-hero h1{font-family:'Playfair Display',serif;font-size:2.8rem;margin-bottom:10px}.boutique-hero p{font-size:1.1rem;max-width:700px;margin:0 auto;opacity:.9}.boutique-content{display:flex;gap:40px;padding:40px 0 80px;align-items:flex-start}.sidebar{flex:0 0 250px;background:var(--white);padding:25px;border-radius:8px;box-shadow:0 4px 15px rgba(0,0,0,.05);position:sticky;top:120px}.sidebar h3{font-size:1.4rem;color:var(--dark-blue);margin-bottom:20px;padding-bottom:10px;border-bottom:2px solid var(--light-blue)}.filter-group{margin-bottom:30px}.filter-group h4{font-size:1.1rem;color:var(--dark-blue);margin-bottom:10px;font-weight:600}.filter-group ul{list-style:none}.filter-group ul li a{display:block;padding:8px 0;color:var(--text-gray);text-decoration:none;transition:color .2s,padding-left .2s;border-radius:4px}.filter-group ul li a.active-filter,.filter-group ul li a:hover{color:var(--gold);font-weight:500;padding-left:5px}.products-section{flex-grow:1}.products-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;padding-bottom:15px;border-bottom:1px solid #ddd}.products-header h2{font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--dark-blue)}.products-header select{padding:10px 15px;border-radius:4px;border:1px solid #ccc;font-family:Montserrat,sans-serif;color:var(--dark-blue)}.products-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:30px}.product-card{background:var(--white);border-radius:8px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,.08);transition:transform .3s,box-shadow .3s;text-align:center;display:flex;flex-direction:column;border:1px solid #f1f1f1}.product-card:hover{transform:translateY(-5px);box-shadow:0 12px 25px rgba(0,0,0,.15)}.product-image{width:100%;height:220px;background-color:var(--light-blue);display:flex;align-items:center;justify-content:center;overflow:hidden}.product-image img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease-in-out}.product-card:hover .product-image img{transform:scale(1.05)}.product-content{padding:20px;flex-grow:1;display:flex;flex-direction:column;justify-content:space-between}.product-content h3{color:var(--dark-blue);font-family:'Playfair Display',serif;font-size:1.4rem;margin-bottom:8px}.product-content .category-tag{font-size:.8rem;color:var(--text-gray);font-weight:500;margin-bottom:15px;display:block}.product-price{font-weight:700;color:var(--gold);font-size:1.8rem;margin:15px 0 20px}.product-btn{display:block;background-color:var(--medium-blue);color:var(--white);padding:12px 25px;text-decoration:none;border-radius:4px;transition:background-color .3s;border:1px solid var(--medium-blue);text-align:center;font-weight:600}.product-btn:hover{background-color:var(--gold);color:var(--dark-blue);border-color:var(--gold)}footer{background:var(--dark-blue);color:var(--white);padding:60px 0 25px}.footer-content{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:40px;margin-bottom:40px}.footer-about{margin-bottom:20px}.footer-logo .logo-main{color:var(--white)}.footer-about p{margin-bottom:20px;line-height:1.7;opacity:.85}.footer-heading{font-size:1.1rem;margin-bottom:20px;color:var(--gold);font-weight:600}.footer-links ul{list-style:none}.footer-links ul li{margin-bottom:12px}.footer-links ul li a{color:var(--white);text-decoration:none;opacity:.85;transition:opacity .3s}.footer-links ul li a:hover{opacity:1;color:var(--gold)}.footer-contact-details p{margin-bottom:15px;display:flex;align-items:center;gap:12px;opacity:.85}.footer-contact-details i{color:var(--gold);font-size:1.1rem;width:25px}.footer-social{display:flex;gap:15px;margin-top:20px}.footer-social a{display:flex;align-items:center;justify-content:center;width:36px;height:36px;background-color:rgba(255,255,255,.1);color:var(--white);border-radius:4px;text-decoration:none;transition:all .3s}.footer-social a:hover{background-color:var(--gold);color:var(--dark-blue);transform:translateY(-3px)}.copyright{padding-top:25px;border-top:1px solid rgba(255,255,255,.1);font-size:.9rem;text-align:center;opacity:.7}@media (max-width:992px){nav ul{gap:20px}.logo-main{font-size:1.8rem}.boutique-content{flex-direction:column}.sidebar{width:100%;margin-bottom:30px;position:static}.products-header{flex-direction:column;align-items:flex-start;gap:15px}}@media (max-width:768px){.header-top-container{flex-direction:column;gap:10px}.header-content{flex-direction:column;gap:20px;text-align:center}.mobile-menu-btn{display:block;position:absolute;top:20px;right:20px}nav{width:100%;display:none}nav.active{display:block}nav ul{flex-direction:column;gap:15px;margin-top:20px}.nav-cta{margin-left:0;margin-top:10px;display:inline-block}.boutique-hero h1{font-size:2.2rem}.products-grid{grid-template-columns:1fr}.logo-main{font-size:1.6rem}.logo-icon{width:60px;height:60px}.footer-content{grid-template-columns:1fr}}
    </style>
    <style>
        /* Style spécifique pour le bouton panier */
        .cart-nav-btn {
            position: relative;
            display: inline-flex !important;
            align-items: center;
            gap: 8px;
        }
        
        .cart-count-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="container header-top-container">
                <div class="header-contact">
                    <a href="tel:0696097806"><i class="fas fa-phone"></i> <span>0696097806</span></a>
                    <a href="mailto:cvmanutention@gmail.com"><i class="fas fa-envelope"></i> <span>cvmanutention@gmail.com</span></a>
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
                        <img src="{{ asset('images/logo-caraibes-voiles.png') }}" alt="Logo Caraïbes Voiles" onerror="this.src='https://placehold.co/80x80/0d2f4f/de419a?text=CVM'">
                    </div>
                    <div class="logo-text">
                        <div class="logo-main">CARAÏBES VOILES</div>
                        <div class="logo-subtitle">MANUTENTION & CONFECTION</div>
                    </div>
                </a>
                <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
                <nav id="main-nav">
                    <ul>
                        <li><a href="{{ route('accueil') }}">Accueil</a></li>
                        <li><a href="{{ route('accueil') }}#services">Services</a></li>
                        <li><a href="{{ route('boutique') }}" class="active-link">Boutique</a></li>
                        <li><a href="{{ route('accueil') }}#about">À Propos</a></li>
                        <li><a href="{{ route('accueil') }}#contact">Contact</a></li>
                        <li><a href="{{ route('cart.index') }}" class="nav-cta" style="background-color: var(--medium-blue) !important;">
                            <i class="fas fa-shopping-cart"></i> Panier
                        </a></li>
                        <li><a href="{{ route('accueil') }}#devis" class="nav-cta">Devis</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <section class="boutique-hero">
        <div class="container">
            <h1>Découvrez nos Produits Essentiels</h1>
            <p>Accessoires de voilerie, matériel de réparation et produits d'entretien professionnels pour bateaux et véhicules.</p>
        </div>
    </section>

    <section class="main-boutique">
        <div class="container boutique-content">
            <aside class="sidebar">
                <h3>Catégories de Produits</h3>
                <div class="filter-group">
                    <h4>Voilerie & Accastillage</h4>
                    <ul>
                        <li><a href="#" class="active-filter">Toutes les Voiles</a></li>
                        <li><a href="#">Cordages & Écoutes</a></li>
                        <li><a href="#">Mousquetons & Cosses</a></li>
                    </ul>
                </div>
                <div class="filter-group">
                    <h4>Matériel de Couture</h4>
                    <ul>
                        <li><a href="#">Fils et Aiguilles</a></li>
                        <li><a href="#">Tissus Techniques</a></li>
                        <li><a href="#">Kits de Réparation</a></li>
                    </ul>
                </div>
                <div class="filter-group">
                    <h4>Protection & Entretien</h4>
                    <ul>
                        <li><a href="#">Produits Imperméabilisants</a></li>
                        <li><a href="#">Nettoyants Professionnels</a></li>
                        <li><a href="#">Accessoires Bâches</a></li>
                    </ul>
                </div>
                <a href="#" class="btn" style="width:100%;margin-top:15px">Voir les Promos</a>
            </aside>

            <div class="products-section">
                <div class="products-header">
                    <h2>{{ $products->count() }} Article(s) trouvé(s)</h2>
                    <select name="sort" id="sort-by">
                        <option value="pop">Trier par Popularité</option>
                        <option value="price-asc">Prix : du moins cher au plus cher</option>
                        <option value="price-desc">Prix : du plus cher au moins cher</option>
                        <option value="new">Nouveautés</option>
                    </select>
                </div>
                
                <div class="products-grid">
                    @forelse($products as $product)
                        <div class="product-card" onclick="window.location.href='{{ route('products.show', $product) }}'" style="cursor: pointer;">
                            <div class="product-image">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <img src="https://placehold.co/400x220/1a4f7a/ffffff?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
                                @endif
                            </div>
                            <div class="product-content">
                                <div>
                                    <h3>{{ Str::limit($product->name, 40) }}</h3>
                                    <span class="category-tag">{{ $product->category ?? 'Produit' }}</span>
                                </div>
                                <div class="price-action">
                                    <div class="product-price">€{{ number_format($product->price, 2) }}</div>
                                    <a href="{{ route('products.show', $product) }}" class="product-btn" onclick="event.stopPropagation();">
                                        Voir le produit <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                            <i class="fas fa-box-open" style="font-size: 4rem; color: var(--text-gray); margin-bottom: 20px;"></i>
                            <h3 style="color: var(--dark-blue); margin-bottom: 10px;">Aucun produit disponible</h3>
                            <p style="color: var(--text-gray);">Nos produits seront bientôt disponibles. Revenez plus tard !</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <a href="{{ route('accueil') }}" class="logo footer-logo">
                        <div class="logo-text">
                            <div class="logo-main">CARAÏBES VOILES</div>
                            <div class="logo-subtitle">MANUTENTION & CONFECTION</div>
                        </div>
                    </a>
                    <p>Votre spécialiste en voilerie, bâches et capitonnage aux Antilles. Qualité et durabilité garanties pour tous vos projets marins et terrestres.</p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="footer-links">
                    <h4 class="footer-heading">Navigation</h4>
                    <ul>
                        <li><a href="{{ route('accueil') }}">Accueil</a></li>
                        <li><a href="{{ route('accueil') }}#services">Services</a></li>
                        <li><a href="{{ route('boutique') }}">Boutique</a></li>
                        <li><a href="{{ route('accueil') }}#about">À Propos</a></li>
                        <li><a href="{{ route('accueil') }}#contact">Contact</a></li>
                        <li><a href="{{ route('accueil') }}#devis">Demande de Devis</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4 class="footer-heading">Nos Services</h4>
                    <ul>
                        <li><a href="{{ route('accueil') }}#services">Tauds et Voiles</a></li>
                        <li><a href="{{ route('accueil') }}#services">Bâches</a></li>
                        <li><a href="{{ route('accueil') }}#services">Capitonnage</a></li>
                        <li><a href="{{ route('accueil') }}#services">Biminis</a></li>
                        <li><a href="{{ route('accueil') }}#services">Sièges et Coussins</a></li>
                    </ul>
                </div>

                <div class="footer-contact-details">
                    <h4 class="footer-heading">Contactez-nous</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Adresse factice, 97200 Fort-de-France, Martinique</p>
                    <p><i class="fas fa-phone"></i> 0696097806</p>
                    <p><i class="fas fa-envelope"></i> cvmanutention@gmail.com</p>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 Caraïbes Voiles Manutention - Tous droits réservés - Siret: 91915140700021</p>
            </div>
        </div>
    </footer>

    <script>
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('main-nav').classList.toggle('active');
        });
        
        document.querySelectorAll('.filter-group ul li a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.filter-group ul li a').forEach(l => l.classList.remove('active-filter'));
                this.classList.add('active-filter');
                console.log('Filtre appliqué:', this.textContent);
            });
        });
    </script>
</body>
</html>
