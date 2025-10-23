#!/bin/bash

# Script de test rapide pour vérifier les corrections
# Usage : ./test-corrections.sh

echo "🔧 TEST DES CORRECTIONS - Stripe & Footer"
echo "=========================================="
echo ""

# Vérifier si le serveur Laravel tourne
echo "1️⃣ Vérification du serveur Laravel..."
if curl -s http://localhost:8000 > /dev/null; then
    echo "✅ Serveur Laravel actif sur http://localhost:8000"
else
    echo "❌ Serveur Laravel non actif"
    echo "💡 Démarrez le serveur avec : php artisan serve"
    exit 1
fi

echo ""
echo "2️⃣ Vérification des fichiers modifiés..."

# Vérifier checkout.blade.php
if grep -q "payment-form.*submit" resources/views/cart/checkout.blade.php 2>/dev/null; then
    echo "✅ checkout.blade.php : Correction appliquée"
else
    echo "⚠️  checkout.blade.php : À vérifier"
fi

# Vérifier app.blade.php
if grep -q ".footer-content p" resources/views/layouts/app.blade.php 2>/dev/null; then
    echo "✅ app.blade.php : Correction appliquée"
else
    echo "⚠️  app.blade.php : À vérifier"
fi

echo ""
echo "3️⃣ Tests manuels à effectuer..."
echo ""
echo "📝 FOOTER :"
echo "   → Ouvrir : http://localhost:8000"
echo "   → Action : Faire défiler jusqu'en bas"
echo "   → Vérifier : Texte blanc visible"
echo ""
echo "💳 PAIEMENT STRIPE :"
echo "   → Étape 1 : http://localhost:8000/client/login (connexion)"
echo "   → Étape 2 : http://localhost:8000/boutique (ajouter au panier)"
echo "   → Étape 3 : http://localhost:8000/cart (finaliser commande)"
echo "   → Étape 4 : Cliquer sur 'Payer avec Stripe'"
echo "   → Vérifier : Redirection vers Stripe (pas de chargement infini)"
echo ""
echo "🧪 PAGE DE TEST :"
echo "   → http://localhost:8000/test-stripe-config.html"
echo ""
echo "=========================================="
echo "✨ Tous les fichiers de correction sont prêts !"
echo "📚 Consultez CORRECTIONS_STRIPE_FOOTER.md pour plus de détails"
