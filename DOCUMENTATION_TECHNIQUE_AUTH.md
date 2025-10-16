# Documentation technique - Gestion de l'authentification navbar

## Architecture de l'authentification

### Système dual d'authentification

Le projet utilise deux systèmes d'authentification distincts :

1. **Authentification Admin** : Via session PHP
2. **Authentification Client** : Via Laravel Auth Guard

---

## Logique de la navbar

### Code final implémenté

```php
@if(session('admin_authenticated'))
    <!-- Boutons admin -->
@elseif(Auth::check() && Auth::user()->isClient())
    <!-- Menu client -->
@else
    <!-- Bouton connexion -->
@endif
```

### Pourquoi cette approche ?

#### ❌ Approche incorrecte (avant)
```php
@if(session('admin_authenticated'))
    <!-- Admin -->
@endif

@auth
    @if(Auth::user()->isClient())
        <!-- Client -->
    @endif
@else
    <!-- Connexion -->
@endauth
```

**Problème** : Les blocs `@if(session)` et `@auth` sont indépendants. 
Même si l'admin est connecté via session, le bloc `@else` de `@auth` 
s'exécute car `Auth::check()` retourne false.

#### ✅ Approche correcte (après)
```php
@if(session('admin_authenticated'))
    <!-- Admin uniquement -->
@elseif(Auth::check() && Auth::user()->isClient())
    <!-- Client uniquement -->
@else
    <!-- Connexion seulement si personne n'est connecté -->
@endif
```

**Avantage** : Structure en cascade. Dès qu'une condition est vraie, 
les autres sont ignorées. Plus de conflits d'affichage.

---

## Flux de décision

```
Utilisateur arrive sur le site
         |
         v
Session admin existe ?
         |
    Oui  |  Non
    |    |
    v    v
 [ADMIN] Auth::check() && isClient() ?
                |
           Oui  |  Non
           |    |
           v    v
        [CLIENT] [VISITEUR]
```

---

## Vérifications détaillées

### 1. Admin connecté
```php
session('admin_authenticated') === true
```
- Session créée lors du login admin
- Stockée côté serveur
- Pas d'utilisateur dans `Auth::user()`

### 2. Client connecté
```php
Auth::check() === true
Auth::user()->isClient() === true
```
- Utilisateur authentifié via Guard
- Accessible via `Auth::user()`
- Méthode `isClient()` dans le modèle User

### 3. Visiteur
```php
session('admin_authenticated') === false
Auth::check() === false
```
- Aucune session admin
- Aucun utilisateur authentifié

---

## Méthode isClient() dans le modèle User

```php
// app/Models/User.php

public function isClient()
{
    return $this->role === 'client';
}

public function isAdmin()
{
    return $this->role === 'admin';
}
```

**Important** : Ces méthodes sont définies dans le modèle User et 
permettent de vérifier le rôle sans dépendre des sessions.

---

## Middleware correspondant

### AdminMiddleware
```php
// app/Http/Middleware/AdminMiddleware.php

public function handle($request, Closure $next)
{
    if (!session('admin_authenticated')) {
        return redirect()->route('admin.login');
    }
    return $next($request);
}
```

### ClientMiddleware
```php
// app/Http/Middleware/ClientMiddleware.php

public function handle($request, Closure $next)
{
    if (!Auth::check() || !Auth::user()->isClient()) {
        return redirect()->route('client.login');
    }
    return $next($request);
}
```

---

## Gestion de la déconnexion

### Déconnexion Admin
```php
// AdminController.php
public function logout()
{
    session()->forget('admin_authenticated');
    session()->flush();
    return redirect()->route('accueil');
}
```

### Déconnexion Client
```php
// ClientAuthController.php
public function logout()
{
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('accueil');
}
```

**Différence clé** :
- Admin : Suppression de session spécifique
- Client : Utilisation de `Auth::logout()`

---

## Sécurité

### Prévention des conflits

1. **Ordre des conditions** : Admin vérifié en premier
2. **Exclusivité** : Un seul type d'authentification à la fois
3. **elseif** : Empêche l'exécution de plusieurs blocs

### Protection des routes

```php
// routes/web.php

// Routes admin
Route::middleware(['admin'])->group(function() {
    Route::resource('products', ProductController::class);
    Route::get('/admin/gallery', [GalleryController::class, 'manage']);
});

// Routes client
Route::middleware(['client'])->group(function() {
    Route::get('/cart/checkout', [CartController::class, 'checkout']);
    Route::get('/my-orders', [OrderController::class, 'myOrders']);
});
```

---

## Tests unitaires recommandés

### Test de la navbar

```php
/** @test */
public function navbar_shows_correct_buttons_for_admin()
{
    session(['admin_authenticated' => true]);
    
    $response = $this->get('/');
    
    $response->assertSee('Gestion');
    $response->assertDontSee('Connexion');
}

/** @test */
public function navbar_shows_correct_buttons_for_client()
{
    $client = User::factory()->create(['role' => 'client']);
    $this->actingAs($client);
    
    $response = $this->get('/');
    
    $response->assertSee($client->name);
    $response->assertDontSee('Connexion');
    $response->assertDontSee('Gestion');
}

/** @test */
public function navbar_shows_login_for_guest()
{
    $response = $this->get('/');
    
    $response->assertSee('Connexion');
    $response->assertDontSee('Gestion');
}
```

---

## Problèmes potentiels et solutions

### Problème 1 : Bouton Connexion toujours visible
**Cause** : Utilisation de `@auth @else @endauth` avec session admin  
**Solution** : Utiliser `@elseif` pour ordre de priorité

### Problème 2 : Plusieurs boutons affichés simultanément
**Cause** : Blocs conditionnels indépendants  
**Solution** : Structure en cascade avec elseif

### Problème 3 : Session admin et Auth en conflit
**Cause** : Auth::check() ne détecte pas les sessions  
**Solution** : Vérifier d'abord session('admin_authenticated')

### Problème 4 : isClient() undefined
**Cause** : Méthode pas définie dans le modèle User  
**Solution** : Ajouter la méthode dans app/Models/User.php

---

## Bonnes pratiques

### ✅ À faire
- Toujours vérifier l'admin en premier
- Utiliser `@elseif` pour exclusivité
- Vérifier `Auth::check()` avant `Auth::user()`
- Ajouter des méthodes helper dans le modèle User

### ❌ À éviter
- Ne pas mélanger session() et Auth dans des blocs séparés
- Ne pas utiliser `Auth::user()` sans vérifier `Auth::check()`
- Ne pas dupliquer les boutons de connexion
- Ne pas oublier la déconnexion côté serveur

---

## Évolutions futures

### Suggestions d'amélioration

1. **Unifier l'authentification**
   - Utiliser Laravel Auth pour admin et client
   - Différencier via les rôles uniquement

2. **Améliorer les redirections**
   - Rediriger l'admin vers le dashboard après login
   - Rediriger le client vers son profil

3. **Ajouter des rôles intermédiaires**
   - Gestionnaire de stock
   - Modérateur
   - Support client

4. **Améliorer la sécurité**
   - Rate limiting sur les connexions
   - 2FA pour les admins
   - Logs d'authentification

---

## Diagramme de flux complet

```
┌─────────────────────────────────────┐
│   Utilisateur accède au site        │
└──────────────┬──────────────────────┘
               │
               v
    ┌──────────────────────┐
    │ session('admin_      │ Oui
    │  authenticated') ?   ├──────────┐
    └──────────────────────┘          │
               │ Non                  │
               v                      v
    ┌──────────────────────┐   ┌────────────────┐
    │ Auth::check() &&     │   │ Afficher:      │
    │ isClient() ?         │   │ - Gestion      │
    └──────────────────────┘   │ - Déconnexion  │
               │ Oui            │ - Panier       │
               │                └────────────────┘
               v                      
    ┌──────────────────────┐          
    │ Afficher:            │          
    │ - Profil (prénom)    │          
    │ - Menu dropdown      │          
    │ - Panier             │          
    └──────────────────────┘          
               │ Non
               v
    ┌──────────────────────┐
    │ Afficher:            │
    │ - Connexion          │
    │ - Panier             │
    └──────────────────────┘
```

---

## Code source complet de la navbar

```blade
<nav>
    <ul>
        <li><a href="{{ route('accueil') }}">Accueil</a></li>
        <li><a href="{{ route('accueil') }}#services">Services</a></li>
        <li><a href="{{ route('boutique') }}">Boutique</a></li>
        <li><a href="{{ route('galerie') }}">Galerie</a></li>
        <li><a href="{{ route('accueil') }}#about">À Propos</a></li>
        <li><a href="{{ route('accueil') }}#contact">Contact</a></li>
        
        @if(session('admin_authenticated'))
            <!-- ADMIN CONNECTÉ -->
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
        @elseif(Auth::check() && Auth::user()->isClient())
            <!-- CLIENT CONNECTÉ -->
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
        @else
            <!-- VISITEUR NON CONNECTÉ -->
            <li>
                <a href="{{ route('client.login') }}" class="client-login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Connexion
                </a>
            </li>
        @endif
        
        <!-- PANIER (toujours visible) -->
        <li class="cart-icon">
            <a href="{{ route('cart.index') }}">
                <i class="fas fa-shopping-cart"></i>
                Panier
                <span class="cart-count" id="cart-count">0</span>
            </a>
        </li>
    </ul>
</nav>
```

---

## Variables de session utilisées

### Session Admin
- `admin_authenticated` : Boolean indiquant si l'admin est connecté
- Définie dans : `AdminController@login`
- Supprimée dans : `AdminController@logout`

### Session Laravel (Client)
- Gérée automatiquement par Laravel Auth
- Token CSRF
- Session ID

---

## Points d'attention

### Cache des vues Blade
Après modification des vues, toujours exécuter :
```bash
php artisan view:clear
```

### Cache de configuration
Si problème de session :
```bash
php artisan config:clear
php artisan cache:clear
```

### Permissions fichiers
Vérifier que `storage/` et `bootstrap/cache/` sont accessibles en écriture

---

## Support et maintenance

### Logs utiles
```php
// Pour déboguer l'authentification
\Log::info('Admin auth check', [
    'session' => session('admin_authenticated'),
    'auth_check' => Auth::check(),
    'user' => Auth::user()
]);
```

### Commandes artisan utiles
```bash
# Voir les routes
php artisan route:list

# Voir les middlewares
php artisan route:list --columns=uri,name,middleware

# Tester une route
php artisan route:cache
```

---

## Conclusion

La séparation stricte entre authentification admin (session) et client (Auth) 
nécessite une gestion précise de l'affichage conditionnel dans la navbar.

L'utilisation de `@elseif` garantit qu'un seul type de bouton s'affiche à la fois,
évitant les conflits et améliorant l'expérience utilisateur.

---

**Dernière mise à jour** : 16 Octobre 2024  
**Version** : 1.0  
**Statut** : ✅ Implémenté et testé
