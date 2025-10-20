# Guide de Gestion des Catégories de Galerie

## 🎯 Ce qui a été ajouté

### 1. **Bouton "Gérer Catégories"**
Un nouveau bouton gris a été ajouté dans l'en-tête de la page de gestion de la galerie admin, entre les boutons existants.

### 2. **Modal de Gestion des Catégories**
Un modal complet permettant de :
- ✅ Créer de nouvelles catégories
- ✅ Modifier les catégories existantes
- ✅ Désactiver/Activer des catégories
- ✅ Supprimer des catégories (uniquement si elles ne contiennent pas d'images)
- ✅ Définir un ordre d'affichage
- ✅ Ajouter une description

### 3. **Fonctionnalités**

#### Création de catégorie
- **Nom** : Nom de la catégorie (obligatoire)
- **Description** : Description optionnelle
- **Ordre** : Ordre d'affichage (0 par défaut)
- **Active** : Case à cocher pour activer/désactiver

#### Modification de catégorie
- Tous les champs sont modifiables directement dans la liste
- Bouton "Sauver" pour enregistrer les modifications

#### Suppression de catégorie
- Protection : impossible de supprimer une catégorie contenant des images
- Message d'erreur clair si tentative de suppression d'une catégorie avec images

### 4. **Catégories par défaut**
La migration a créé 4 catégories par défaut :
- **Voiles** (ordre 1)
- **Bâches** (ordre 2)
- **Capitonnage** (ordre 3)
- **Réparation** (ordre 4)

Toutes les images existantes ont été automatiquement migrées vers ces nouvelles catégories.

## 📋 Comment utiliser

### Accéder à la gestion des catégories
1. Allez sur `/admin/gallery`
2. Cliquez sur le bouton **"Gérer Catégories"** (gris, avec icône dossier)

### Créer une nouvelle catégorie
1. Dans le modal, remplissez le formulaire en haut :
   - Nom (obligatoire)
   - Description (optionnel)
   - Ordre (0 par défaut)
   - Cochez "Catégorie active" si elle doit être utilisable immédiatement
2. Cliquez sur **"Ajouter"**

### Modifier une catégorie
1. Dans la liste des catégories, modifiez directement les champs
2. Cliquez sur **"Sauver"** pour enregistrer

### Désactiver une catégorie
1. Décochez la case "Active"
2. Cliquez sur "Sauver"
3. ⚠️ La catégorie ne sera plus visible dans les listes de sélection

### Supprimer une catégorie
1. Cliquez sur le bouton rouge avec icône poubelle
2. ⚠️ Vous ne pouvez supprimer que les catégories vides (sans images)

### Ajouter une image avec catégorie
1. Dans le formulaire d'ajout d'image
2. Sélectionnez une catégorie dans le menu déroulant
3. Seules les catégories actives sont affichées

## 🔧 Modifications techniques

### Fichiers modifiés

1. **resources/views/admin/gallery.blade.php**
   - Ajout du bouton "Gérer Catégories"
   - Ajout du modal de gestion
   - Mise à jour des formulaires d'ajout/édition
   - Mise à jour de l'affichage des catégories dans les cartes
   - Ajout des fonctions JavaScript

2. **app/Http/Controllers/GalleryController.php**
   - Méthode `manage()` : passe les catégories à la vue
   - Méthode `store()` : utilise `gallery_category_id` au lieu de `category`
   - Méthode `update()` : utilise `gallery_category_id` au lieu de `category`

3. **Database**
   - Migration exécutée : `2025_10_16_create_gallery_categories_table.php`
   - Nouvelle table : `gallery_categories`
   - Modification de `gallery_images` : ajout de `gallery_category_id`
   - Suppression de l'ancien champ `category` (enum)

### Routes existantes (déjà configurées)
```php
Route::post('/gallery-categories', [GalleryCategoryController::class, 'store'])
Route::put('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'update'])
Route::delete('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'destroy'])
```

### Modèles
- **GalleryCategory** : déjà configuré avec relation vers GalleryImage
- **GalleryImage** : déjà configuré avec relation vers GalleryCategory

## ✅ Avantages du nouveau système

1. **Flexibilité** : Vous pouvez créer autant de catégories que nécessaire
2. **Gestion dynamique** : Plus besoin de modifier le code pour ajouter une catégorie
3. **Protection** : Impossible de supprimer une catégorie contenant des images
4. **Organisation** : Ordre personnalisable pour l'affichage
5. **Contrôle** : Possibilité d'activer/désactiver des catégories
6. **Description** : Chaque catégorie peut avoir une description

## 🎨 Interface utilisateur

### Design
- Modal moderne avec fond semi-transparent
- Section d'ajout en haut (fond gris clair)
- Liste des catégories en dessous avec défilement
- Chaque catégorie a une bordure colorée :
  - **Dorée** : catégorie active
  - **Grise** : catégorie désactivée
- Compteur d'images pour chaque catégorie
- Badges visuels pour les catégories désactivées

### Couleurs
- Bouton "Gérer Catégories" : gris (#6c757d)
- Bordure active : or (var(--gold))
- Bordure inactive : gris (#ddd)
- Bouton supprimer : rouge (#dc3545)

## 📝 Notes importantes

1. **Migration automatique** : Toutes les anciennes images ont été migrées vers les nouvelles catégories
2. **Compatibilité** : Le système est rétrocompatible
3. **Validation** : Tous les formulaires sont validés côté serveur et client
4. **Sécurité** : Routes protégées par middleware admin

## 🚀 Prochaines étapes possibles

- Ajouter des icônes personnalisées par catégorie
- Permettre le réordonnancement par drag & drop
- Ajouter des statistiques par catégorie
- Créer un système de filtrage sur la page publique

---

✅ **Système opérationnel et prêt à l'emploi !**
