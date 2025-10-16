# Test de création de catégories - Instructions

## Étape 1 : Vérifier la structure de la base de données

### Commandes à exécuter

```bash
# Se placer dans le dossier du projet
cd C:\Users\koddy\laravel\stagepro

# Vérifier les migrations
php artisan migrate:status

# Si la table categories n'existe pas, exécuter les migrations
php artisan migrate
```

---

## Étape 2 : Test manuel via l'interface admin

### Accéder à la page de gestion des produits
1. Ouvrir le navigateur
2. Aller sur : `http://localhost:8000/admin/login`
3. Se connecter avec les identifiants admin
4. Accéder à : `http://localhost:8000/products`

### Tester l'onglet Gestion des Catégories
1. Cliquer sur l'onglet **"🏷️ Gestion des Catégories"**
2. Le tableau des catégories doit s'afficher
3. Cliquer sur **"➕ Ajouter une Catégorie"**
4. Le modal doit s'ouvrir avec :
   - Champ "Nom de la catégorie"
   - Champ "Description"
   - Champ "Ordre d'affichage"
   - Checkbox "Catégorie active"

### Créer une catégorie test
**Exemple 1 : Voiles**
- Nom : `Voiles`
- Description : `Voiles pour bateaux et équipements nautiques`
- Ordre : `1`
- Active : ✓ (coché)

**Exemple 2 : Bâches**
- Nom : `Bâches`
- Description : `Bâches de protection et couvertures marines`
- Ordre : `2`
- Active : ✓ (coché)

**Exemple 3 : Accessoires**
- Nom : `Accessoires`
- Description : `Accessoires nautiques et équipements divers`
- Ordre : `3`
- Active : ✓ (coché)

**Exemple 4 : Capitonnage**
- Nom : `Capitonnage`
- Description : `Travaux de capitonnage et sellerie marine`
- Ordre : `4`
- Active : ✓ (coché)

---

## Étape 3 : Vérifier l'affichage dans la boutique

### Une fois les catégories créées
1. Aller sur la page boutique : `http://localhost:8000/boutique`
2. Les catégories doivent apparaître dans le menu de filtrage
3. Vérifier que le filtre fonctionne correctement

---

## Étape 4 : Test avec des produits

### Créer des produits dans chaque catégorie
1. Aller sur **"📦 Gestion des Produits"**
2. Cliquer sur **"➕ Ajouter un Produit"**
3. Sélectionner une catégorie dans le menu déroulant
4. Remplir les informations du produit
5. Sauvegarder

### Vérifier l'affichage
1. Retourner dans l'onglet **"🏷️ Gestion des Catégories"**
2. La colonne "Nb Produits" doit afficher le nombre de produits
3. Exemple : `2 produit(s)` si 2 produits sont dans cette catégorie

---

## Étape 5 : Test des fonctionnalités

### Modifier une catégorie
1. Dans le tableau des catégories
2. Cliquer sur **"✏️ Modifier"** pour une catégorie
3. Le modal s'ouvre avec les informations pré-remplies
4. Modifier les informations
5. Cliquer sur **"Mettre à jour"**
6. Vérifier que les modifications sont enregistrées

### Désactiver une catégorie
1. Modifier une catégorie
2. Décocher **"Catégorie active"**
3. Sauvegarder
4. La catégorie doit afficher **"Inactive"** dans le statut
5. Vérifier qu'elle n'apparaît plus sur la page boutique

### Supprimer une catégorie vide
1. Supprimer tous les produits d'une catégorie
2. Cliquer sur **"🗑️ Supprimer"** pour cette catégorie
3. Confirmer la suppression
4. La catégorie doit disparaître du tableau

### Tenter de supprimer une catégorie avec produits
1. Cliquer sur **"🗑️ Supprimer"** pour une catégorie contenant des produits
2. Un message d'erreur doit apparaître :
   `"Impossible de supprimer une catégorie contenant des produits"`
3. La catégorie reste dans le tableau

---

## Étape 6 : Vérification en base de données

### Avec un client SQL
```sql
-- Voir toutes les catégories
SELECT * FROM categories;

-- Voir les catégories avec leur nombre de produits
SELECT 
    c.id,
    c.name,
    c.slug,
    c.is_active,
    COUNT(p.id) as product_count
FROM categories c
LEFT JOIN products p ON c.id = p.category_id
GROUP BY c.id, c.name, c.slug, c.is_active
ORDER BY c.order, c.name;
```

### Avec Artisan Tinker
```bash
php artisan tinker

# Voir toutes les catégories
Category::all();

# Voir une catégorie avec ses produits
Category::with('products')->find(1);

# Créer une catégorie via tinker
Category::create([
    'name' => 'Test',
    'description' => 'Catégorie de test',
    'order' => 99,
    'is_active' => true
]);
```

---

## Messages attendus

### Création réussie
✅ `"Catégorie créée avec succès !"`

### Modification réussie
✅ `"Catégorie mise à jour avec succès !"`

### Suppression réussie
✅ `"Catégorie supprimée avec succès !"`

### Erreur de suppression
❌ `"Impossible de supprimer une catégorie contenant des produits."`

### Erreur de validation
❌ `"Le nom de la catégorie est requis"`
❌ `"Ce nom de catégorie existe déjà"`

---

## Checklist complète

### Interface Admin
- [ ] Onglet "Gestion des Catégories" cliquable
- [ ] Tableau des catégories visible
- [ ] Bouton "Ajouter une Catégorie" fonctionne
- [ ] Modal s'ouvre correctement
- [ ] Formulaire complet et fonctionnel

### CRUD Catégories
- [ ] Création d'une nouvelle catégorie
- [ ] Modification d'une catégorie existante
- [ ] Suppression d'une catégorie vide
- [ ] Erreur sur suppression avec produits
- [ ] Activation/Désactivation d'une catégorie

### Intégration Boutique
- [ ] Catégories visibles dans le filtre boutique
- [ ] Filtre par catégorie fonctionne
- [ ] Seules les catégories actives sont affichées
- [ ] Ordre d'affichage respecté

### Base de données
- [ ] Table categories existe
- [ ] Slug auto-généré
- [ ] Relation avec products fonctionne
- [ ] Contraintes respectées

---

## Problèmes courants et solutions

### Le modal ne s'ouvre pas
**Solution** : Vérifier la console JavaScript (F12) pour les erreurs

### Erreur "Table categories doesn't exist"
**Solution** : Exécuter `php artisan migrate`

### Les catégories ne s'affichent pas dans la boutique
**Solution** : Vérifier que `is_active = 1` dans la base de données

### Erreur lors de la création
**Solution** : Vérifier que le nom est unique et non vide

### Le bouton "Gestion des Catégories" ne fait rien
**Solution** : Vérifier que le JavaScript `switchTab()` est chargé

---

## Script de test automatique (optionnel)

### Créer un seeder de catégories
```php
// database/seeders/CategorySeeder.php
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Voiles',
                'description' => 'Voiles pour bateaux et équipements nautiques',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Bâches',
                'description' => 'Bâches de protection et couvertures marines',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Accessoires',
                'description' => 'Accessoires nautiques et équipements divers',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Capitonnage',
                'description' => 'Travaux de capitonnage et sellerie marine',
                'order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'Réparations',
                'description' => 'Services de réparation et entretien',
                'order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
```

### Exécuter le seeder
```bash
php artisan db:seed --class=CategorySeeder
```

---

## Résultat attendu

Après avoir créé quelques catégories, vous devriez voir :

### Dans l'admin (onglet Catégories)
```
┌─────────────┬─────────────────┬───────┬─────────────┬────────┬──────────┐
│ Nom         │ Description     │ Ordre │ Nb Produits │ Statut │ Actions  │
├─────────────┼─────────────────┼───────┼─────────────┼────────┼──────────┤
│ Voiles      │ Voiles pour...  │   1   │  0 produits │ Active │ ✏️ 🗑️   │
│ Bâches      │ Bâches de...    │   2   │  0 produits │ Active │ ✏️ 🗑️   │
│ Accessoires │ Accessoires...  │   3   │  0 produits │ Active │ ✏️ 🗑️   │
│ Capitonnage │ Travaux de...   │   4   │  0 produits │ Active │ ✏️ 🗑️   │
└─────────────┴─────────────────┴───────┴─────────────┴────────┴──────────┘
```

### Dans la boutique (menu de filtre)
```
Catégories :
☑️ Toutes
☐ Voiles
☐ Bâches
☐ Accessoires
☐ Capitonnage
```

---

## Support

Si vous rencontrez des problèmes :
1. Vérifier les logs : `storage/logs/laravel.log`
2. Vider les caches : `php artisan cache:clear`
3. Consulter la documentation : `DOCUMENTATION_TECHNIQUE_AUTH.md`

---

**Date de création** : 16 Octobre 2024  
**Statut** : ✅ Prêt pour les tests
