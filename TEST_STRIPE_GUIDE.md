# 🧪 GUIDE DE TEST STRIPE - DÉMARRAGE RAPIDE

## ⚡ Test en 2 minutes

### Méthode 1 : Page de test directe (LA PLUS RAPIDE)

1. **Démarrer le serveur Laravel**
   ```bash
   cd C:\Users\koddy\laravel\stagepro
   php artisan serve
   ```

2. **Ouvrir dans le navigateur**
   ```
   http://localhost:8000/test-stripe.html
   ```

3. **Cliquer sur "Payer avec Stripe"**
   - Vous serez redirigé vers Stripe Checkout

4. **Entrer la carte de test**
   - Numéro : `4242 4242 4242 4242`
   - Date : `12/25` (ou n'importe quelle date future)
   - CVC : `123` (ou n'importe quel 3 chiffres)
   - Nom : Votre nom

5. **Valider le paiement**
   - Vous serez redirigé vers la page de succès

---

### Méthode 2 : Test avec le flux complet

1. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

2. **Accéder à la boutique**
   ```
   http://localhost:8000/boutique
   ```

3. **Ajouter un produit au panier**
   - Cliquer sur "Ajouter au panier" sur n'importe quel produit

4. **Voir le panier**
   - Cliquer sur l'icône panier dans la navbar
   - Ou aller sur `http://localhost:8000/cart`

5. **Se connecter (si pas déjà connecté)**
   - Cliquer sur "Se connecter pour payer"
   - Ou utiliser un compte client existant

6. **Procéder au paiement**
   - Cliquer sur "Procéder au paiement"
   - Puis "Payer avec Stripe"

7. **Payer sur Stripe**
   - Carte : `4242 4242 4242 4242`
   - Date : `12/25`
   - CVC : `123`

---

## 💳 Cartes de test

### ✅ Paiement réussi
```
4242 4242 4242 4242
```

### ⚠️ Authentification 3D Secure
```
4000 0027 6000 3184
```

### ❌ Carte refusée
```
4000 0000 0000 0002
```

### 💰 Fonds insuffisants
```
4000 0000 0000 9995
```

**Pour toutes les cartes :**
- Date : N'importe quelle date future
- CVC : N'importe quel 3 chiffres

---

## 🎯 Ce qui devrait se passer

### ✅ Paiement réussi
1. Redirection vers `/payment/success`
2. Message de confirmation avec numéro de transaction
3. Panier vidé automatiquement
4. Possibilité de voir les commandes ou continuer les achats

### ❌ Paiement annulé
1. Redirection vers `/payment/cancel`
2. Message expliquant l'annulation
3. Panier conservé
4. Possibilité de retourner au panier

---

## 🔍 Vérification

### Dans le dashboard Stripe

1. **Accéder au dashboard**
   ```
   https://dashboard.stripe.com/test/payments
   ```

2. **Voir les paiements de test**
   - Tous vos paiements de test apparaîtront ici
   - Vous verrez le montant, la date, le statut

---

## 🚨 Problèmes courants

### Le bouton "Payer avec Stripe" ne fait rien
- Ouvrir la console navigateur (F12)
- Vérifier les erreurs JavaScript
- Vérifier que le token CSRF est présent

### Erreur 419 (CSRF Token Mismatch)
- Vider le cache du navigateur
- Redémarrer le serveur Laravel
- Vérifier que `@csrf` est dans le formulaire

### Erreur 403 (Accès refusé)
- Se connecter en tant que client
- Vérifier que le middleware `client` fonctionne

### Page blanche après paiement
- Vérifier les logs : `storage/logs/laravel.log`
- Vérifier que les vues existent dans `resources/views/payment/`

---

## 📝 Commandes utiles

### Démarrer le serveur
```bash
cd C:\Users\koddy\laravel\stagepro
php artisan serve
```

### Voir les logs en temps réel
```bash
tail -f storage/logs/laravel.log
```

### Vider le cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Créer un compte client de test
```
Email : test@example.com
Mot de passe : password123
```

---

## ✅ Checklist de test

- [ ] Serveur Laravel démarré
- [ ] Page de test accessible (`/test-stripe.html`)
- [ ] Clic sur le bouton de paiement fonctionne
- [ ] Redirection vers Stripe Checkout
- [ ] Formulaire de carte s'affiche
- [ ] Carte de test acceptée
- [ ] Redirection vers page de succès
- [ ] Message de confirmation affiché
- [ ] Paiement visible dans dashboard Stripe

---

## 🎉 Résultat attendu

Après un paiement réussi, vous devriez voir :

```
✅ Paiement réussi!

Merci pour votre commande

Détails de votre commande
Numéro de transaction : cs_test_XXXXXXXXX

Prochaines étapes
Un email de confirmation vous a été envoyé...

[Voir mes commandes] [Continuer mes achats]
```

---

## 📞 Besoin d'aide ?

- Vérifier les logs : `storage/logs/laravel.log`
- Tester avec la page HTML : `http://localhost:8000/test-stripe.html`
- Consulter la documentation : `GUIDE_INTEGRATION_STRIPE.md`

---

**🚀 Bon test !**
