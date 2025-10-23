# Guide de Test - Paiement Stripe & Footer

## 🚀 Démarrage rapide

### 1. Démarrer le serveur Laravel
```bash
cd C:\Users\koddy\laravel\stagepro
php artisan serve
```

## ✅ Tests à effectuer

### Test du Footer (Texte invisible)

1. **Ouvrir n'importe quelle page du site**
   - Exemple : http://localhost:8000

2. **Faire défiler jusqu'en bas de la page**
   - Vérifier que vous voyez clairement :
     - "CARAÏBES VOILES"
     - "MANUTENTION & CONFECTION"
     - "Expert en confection et réparation de voiles, bâches et articles de capitonnage."
     - "© 2024 Caraïbes Voiles Manutention - Tous droits réservés"

3. **Le texte doit être blanc et bien visible** sur le fond bleu foncé

---

### Test du Paiement Stripe (Chargement infini)

#### Étape 1 : Se connecter en tant que client
```
URL : http://localhost:8000/client/login
```

**Si vous n'avez pas de compte :**
1. Aller sur : http://localhost:8000/client/register
2. Créer un compte client avec :
   - Nom
   - Email
   - Mot de passe

#### Étape 2 : Ajouter un produit au panier
1. Aller sur : http://localhost:8000/boutique
2. Cliquer sur un produit
3. Cliquer sur "Ajouter au panier"
4. Vérifier que le compteur du panier augmente

#### Étape 3 : Aller au checkout
1. Cliquer sur l'icône du panier (en haut à droite)
2. Cliquer sur "Finaliser ma commande"
3. Vous devez voir la page de checkout avec :
   - Récapitulatif des produits
   - Total à payer
   - Bouton "Payer avec Stripe"

#### Étape 4 : Tester le paiement
1. **Cliquer sur "Payer avec Stripe"**
2. **Vérifications** :
   - ✅ Le bouton doit afficher : "🔄 Redirection vers Stripe..."
   - ✅ Le bouton doit être désactivé (grisé)
   - ✅ La page doit rediriger vers Stripe Checkout (nouvelle page)
   - ❌ PAS de chargement infini !

3. **Sur la page Stripe Checkout :**
   - Vous devez voir le formulaire de paiement Stripe
   - Utiliser une carte de test :
     - Numéro : `4242 4242 4242 4242`
     - Date : n'importe quelle date future (ex: 12/25)
     - CVC : n'importe quel 3 chiffres (ex: 123)
     - Nom : votre nom

4. **Cliquer sur "Payer"**
   - Vous devez être redirigé vers la page de succès
   - Le panier doit être vidé

---

## 🔧 En cas de problème

### Problème : Redirection vers la page de connexion
**Cause** : Vous n'êtes pas connecté en tant que client

**Solution** :
1. Aller sur http://localhost:8000/client/login
2. Se connecter avec un compte client
3. Réessayer

### Problème : Erreur "Session expired" ou "CSRF token mismatch"
**Solution** :
```bash
php artisan cache:clear
php artisan config:clear
php artisan session:clear
```
Puis rafraîchir la page (Ctrl + F5)

### Problème : Le bouton ne fait rien
**Solution** :
1. Ouvrir la console du navigateur (F12)
2. Aller dans l'onglet "Console"
3. Cliquer sur "Payer avec Stripe"
4. Noter les erreurs JavaScript qui apparaissent

### Problème : Erreur Stripe
**Vérifier les clés Stripe** dans le fichier `.env` :
```
STRIPE_PUBLIC_KEY=pk_test_...
STRIPE_SECRET_KEY=sk_test_...
```

Les clés doivent commencer par `pk_test_` et `sk_test_` pour le mode test.

---

## 📝 Checklist finale

- [ ] Footer : Texte bien visible en blanc sur fond bleu
- [ ] Footer : "CARAÏBES VOILES" et "MANUTENTION & CONFECTION" visibles
- [ ] Footer : Texte de description visible
- [ ] Footer : Copyright visible
- [ ] Connexion client fonctionne
- [ ] Ajout au panier fonctionne
- [ ] Page checkout accessible
- [ ] Bouton "Payer avec Stripe" affiche le loader
- [ ] Redirection vers Stripe Checkout fonctionne
- [ ] PAS de chargement infini
- [ ] Paiement test réussi
- [ ] Panier vidé après paiement
- [ ] Page de succès affichée

---

## 💡 Cartes de test Stripe

### Carte qui fonctionne
```
Numéro : 4242 4242 4242 4242
Date : 12/25 (ou toute date future)
CVC : 123
```

### Autres cartes de test
- **Paiement refusé** : 4000 0000 0000 0002
- **Carte expirée** : 4000 0000 0000 0069
- **CVC incorrect** : 4000 0000 0000 0127

Pour plus d'informations : https://stripe.com/docs/testing
