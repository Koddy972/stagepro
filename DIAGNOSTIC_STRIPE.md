# 🔍 DIAGNOSTIC STRIPE - GUIDE DE DÉBOGAGE

## 📋 Modifications apportées

✅ **PaymentController.php** - Logs détaillés ajoutés
✅ **StripeService.php** - Logs détaillés ajoutés
✅ **Récupération du panier** - Corrigée (maintenant depuis la BDD, pas la session)

---

## 🧪 ÉTAPES POUR TESTER ET DIAGNOSTIQUER

### 1. Vider les logs existants
```bash
cd C:\Users\koddy\laravel\stagepro
echo. > storage\logs\laravel.log
```

### 2. Démarrer le serveur
```bash
php artisan serve
```

### 3. Ouvrir un deuxième terminal pour voir les logs en temps réel
```bash
cd C:\Users\koddy\laravel\stagepro
Get-Content storage\logs\laravel.log -Wait
```

### 4. Tester le paiement
1. Ouvrir http://localhost:8000/boutique
2. Ajouter un produit au panier
3. Aller au panier : http://localhost:8000/cart
4. Se connecter si nécessaire
5. Cliquer sur "Procéder au paiement"
6. Cliquer sur "Payer avec Stripe"

### 5. Observer les logs

Vous devriez voir apparaître :
```
[timestamp] local.INFO: === DÉBUT CRÉATION SESSION STRIPE ===
[timestamp] local.INFO: Session ID: xxxxx
[timestamp] local.INFO: User ID: xxxx
[timestamp] local.INFO: Nombre d'articles dans le panier: X
[timestamp] local.INFO: Articles préparés pour Stripe: [...]
[timestamp] local.INFO: Success URL: http://localhost:8000/payment/success?session_id={CHECKOUT_SESSION_ID}
[timestamp] local.INFO: Cancel URL: http://localhost:8000/payment/cancel
[timestamp] local.INFO: Création de la session Stripe...
[timestamp] local.INFO: === DÉBUT CRÉATION SESSION STRIPE SERVICE ===
[timestamp] local.INFO: Nombre d'items: X
[timestamp] local.INFO: Traitement item: [nom] - Prix: [prix] - Quantité: [qty]
[timestamp] local.INFO: Line items préparés: X
[timestamp] local.INFO: Appel API Stripe...
[timestamp] local.INFO: Session Stripe créée avec succès: cs_test_xxxxx
[timestamp] local.INFO: Session Stripe créée avec succès
[timestamp] local.INFO: Session ID: cs_test_xxxxx
[timestamp] local.INFO: Session URL: https://checkout.stripe.com/c/pay/cs_test_xxxxx
[timestamp] local.INFO: Redirection vers: https://checkout.stripe.com/c/pay/cs_test_xxxxx
```

---

## ❌ ERREURS POSSIBLES ET SOLUTIONS

### Erreur 1 : "Panier vide"
**Log :**
```
[timestamp] local.WARNING: Panier vide
```

**Cause :** Aucun article dans le panier en base de données

**Solution :**
1. Vérifier que des produits sont ajoutés au panier
2. Vérifier la table `cart_items` :
```bash
php artisan tinker
DB::table('cart_items')->get();
```

### Erreur 2 : "Stripe API Error"
**Log :**
```
[timestamp] local.ERROR: Erreur lors de la création de la session Stripe: ...
```

**Causes possibles :**
- Clés Stripe incorrectes
- Problème de connexion Internet
- Format des données incorrect

**Solution :**
1. Vérifier les clés dans `.env` :
```bash
grep STRIPE .env
```

2. Tester les clés manuellement :
```bash
php artisan tinker
Stripe\Stripe::setApiKey(config('services.stripe.secret'));
Stripe\Customer::all(['limit' => 1]);
```

### Erreur 3 : "unit_amount must be an integer"
**Log :**
```
[timestamp] local.ERROR: Invalid integer: ...
```

**Cause :** Le prix n'est pas converti en entier

**Solution :** Déjà corrigé dans le code avec `(int)($item['price'] * 100)`

### Erreur 4 : "No such image"
**Log :**
```
[timestamp] local.ERROR: No such image: ...
```

**Cause :** URL d'image invalide

**Solution :** Déjà corrigé - les images sont optionnelles maintenant

### Erreur 5 : "Pas de redirection"
**Symptôme :** Le bouton ne fait rien

**Causes possibles :**
- Erreur JavaScript dans la console
- Problème de CSRF token
- Erreur côté serveur non affichée

**Solution :**
1. Ouvrir la console du navigateur (F12)
2. Vérifier les erreurs JavaScript
3. Vérifier les logs Laravel
4. Vérifier que le formulaire a bien le `@csrf`

---

## 🔧 COMMANDES DE DIAGNOSTIC

### Vérifier la configuration Stripe
```bash
php artisan tinker
config('services.stripe.key')
config('services.stripe.secret')
```

### Vérifier le contenu du panier
```bash
php artisan tinker
DB::table('cart_items')->get();
```

### Tester manuellement la création d'une session Stripe
```bash
php artisan tinker
$stripe = new \App\Services\StripeService();
$items = [
    ['name' => 'Test', 'price' => 10, 'quantity' => 1, 'description' => '']
];
$session = $stripe->createCheckoutSession(
    $items,
    'http://localhost:8000/payment/success?session_id={CHECKOUT_SESSION_ID}',
    'http://localhost:8000/payment/cancel'
);
echo $session->url;
```

### Vider le cache Laravel
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📊 VÉRIFICATION DE LA BASE DE DONNÉES

### Vérifier que la table cart_items existe
```bash
php artisan tinker
Schema::hasTable('cart_items')
```

### Voir la structure
```bash
php artisan tinker
DB::select('PRAGMA table_info(cart_items)');
```

### Voir le contenu
```bash
php artisan tinker
DB::table('cart_items')->get();
```

---

## 🎯 CHECKLIST DE VÉRIFICATION

Avant de tester, vérifier :

- [ ] Serveur Laravel démarré (`php artisan serve`)
- [ ] Produits existent dans la boutique
- [ ] On peut ajouter des produits au panier
- [ ] Le panier affiche les produits
- [ ] On est connecté en tant que client
- [ ] Les clés Stripe sont dans `.env`
- [ ] Les logs sont vidés
- [ ] Un terminal affiche les logs en temps réel

---

## 📝 PROCHAINES ÉTAPES

1. **Suivre ce guide pas à pas**
2. **Noter l'erreur exacte** dans les logs si elle apparaît
3. **Vérifier la console du navigateur** (F12) pour les erreurs JavaScript
4. **Copier les logs** et me les envoyer si le problème persiste

---

## ✅ SI ÇA FONCTIONNE

Vous devriez :
1. ✅ Être redirigé vers une page Stripe (checkout.stripe.com)
2. ✅ Voir le formulaire de carte bancaire
3. ✅ Pouvoir entrer la carte de test : `4242 4242 4242 4242`
4. ✅ Être redirigé vers `/payment/success` après validation

---

**🚀 Lancez le test maintenant et observez les logs !**
