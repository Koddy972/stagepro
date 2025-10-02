# 🔐 Sécurité Admin - Documentation

## Vue d'ensemble

Le système d'authentification admin a été complètement sécurisé avec les fonctionnalités suivantes :

### ✅ Fonctionnalités implémentées

1. **Mot de passe hashé** - Le mot de passe est stocké de manière sécurisée dans `.env`
2. **Rate limiting** - Limitation des tentatives de connexion (5 par défaut)
3. **Logging complet** - Enregistrement de toutes les tentatives (IP, succès/échec, user agent)
4. **Protection anti-cache** - Empêche le navigateur de mettre en cache les pages admin
5. **Régénération de session** - Protection contre la fixation de session
6. **Commandes artisan** - Outils pour gérer le système

---

## 📋 Configuration

### Variables d'environnement (.env)

```env
# Le hash du mot de passe (généré automatiquement)
ADMIN_PASSWORD_HASH='$2y$12$...'

# Nombre maximum de tentatives échouées avant blocage
ADMIN_MAX_LOGIN_ATTEMPTS=5

# Durée du blocage en minutes
ADMIN_LOCKOUT_DURATION=15
```

---

## 🛠️ Commandes Artisan

### 1. Changer le mot de passe admin

```bash
php artisan admin:change-password
```

Cette commande vous permet de changer le mot de passe de manière sécurisée.
Le nouveau hash sera automatiquement enregistré dans `.env`.

**Exemple d'utilisation :**
```bash
$ php artisan admin:change-password

🔐 Changement du mot de passe administrateur

Entrez le nouveau mot de passe: ********
Confirmez le nouveau mot de passe: ********
✅ Mot de passe changé avec succès!
⚠️  N'oubliez pas de redémarrer votre serveur Laravel.
```

---

### 2. Voir les tentatives de connexion

```bash
# Voir toutes les tentatives (50 dernières)
php artisan admin:view-login-attempts

# Voir seulement les dernières 24h
php artisan admin:view-login-attempts --recent
```

**Exemple de sortie :**
```
📊 Historique des tentatives de connexion admin

+----+---------------+----------+---------------------+-------------------------+
| ID | IP            | Status   | Date                | User Agent              |
+----+---------------+----------+---------------------+-------------------------+
| 15 | 127.0.0.1     | ✅ Succès| 2025-10-02 16:30:15 | Mozilla/5.0...          |
| 14 | 192.168.1.100 | ❌ Échec | 2025-10-02 16:29:45 | Chrome/120...           |
+----+---------------+----------+---------------------+-------------------------+

Total: 15 tentatives
✅ Réussies: 8
❌ Échouées: 7
```

---

### 3. Nettoyer les anciennes tentatives

```bash
php artisan admin:clean-login-attempts
```

Supprime les tentatives de plus de 24h pour maintenir la base de données propre.
