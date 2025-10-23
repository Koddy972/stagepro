# Script de test rapide pour vérifier les corrections
# Usage PowerShell : .\test-corrections.ps1

Write-Host "🔧 TEST DES CORRECTIONS - Stripe & Footer" -ForegroundColor Cyan
Write-Host "==========================================" -ForegroundColor Cyan
Write-Host ""

# Vérifier si le serveur Laravel tourne
Write-Host "1️⃣ Vérification du serveur Laravel..." -ForegroundColor Yellow

try {
    $response = Invoke-WebRequest -Uri "http://localhost:8000" -TimeoutSec 5 -ErrorAction Stop
    Write-Host "✅ Serveur Laravel actif sur http://localhost:8000" -ForegroundColor Green
} catch {
    Write-Host "❌ Serveur Laravel non actif" -ForegroundColor Red
    Write-Host "💡 Démarrez le serveur avec : php artisan serve" -ForegroundColor Yellow
    exit 1
}

Write-Host ""
Write-Host "2️⃣ Vérification des fichiers modifiés..." -ForegroundColor Yellow

# Vérifier checkout.blade.php
$checkoutFile = "resources\views\cart\checkout.blade.php"
if (Test-Path $checkoutFile) {
    $content = Get-Content $checkoutFile -Raw
    if ($content -match "payment-form.*submit") {
        Write-Host "✅ checkout.blade.php : Correction appliquée" -ForegroundColor Green
    } else {
        Write-Host "⚠️  checkout.blade.php : À vérifier" -ForegroundColor Yellow
    }
} else {
    Write-Host "❌ checkout.blade.php : Fichier non trouvé" -ForegroundColor Red
}

# Vérifier app.blade.php
$appFile = "resources\views\layouts\app.blade.php"
if (Test-Path $appFile) {
    $content = Get-Content $appFile -Raw
    if ($content -match "\.footer-content p") {
        Write-Host "✅ app.blade.php : Correction appliquée" -ForegroundColor Green
    } else {
        Write-Host "⚠️  app.blade.php : À vérifier" -ForegroundColor Yellow
    }
} else {
    Write-Host "❌ app.blade.php : Fichier non trouvé" -ForegroundColor Red
}

Write-Host ""
Write-Host "3️⃣ Tests manuels à effectuer..." -ForegroundColor Yellow
Write-Host ""

Write-Host "📝 FOOTER :" -ForegroundColor Cyan
Write-Host "   → Ouvrir : http://localhost:8000" -ForegroundColor White
Write-Host "   → Action : Faire défiler jusqu'en bas" -ForegroundColor White
Write-Host "   → Vérifier : Texte blanc visible" -ForegroundColor White
Write-Host ""

Write-Host "💳 PAIEMENT STRIPE :" -ForegroundColor Cyan
Write-Host "   → Étape 1 : http://localhost:8000/client/login (connexion)" -ForegroundColor White
Write-Host "   → Étape 2 : http://localhost:8000/boutique (ajouter au panier)" -ForegroundColor White
Write-Host "   → Étape 3 : http://localhost:8000/cart (finaliser commande)" -ForegroundColor White
Write-Host "   → Étape 4 : Cliquer sur 'Payer avec Stripe'" -ForegroundColor White
Write-Host "   → Vérifier : Redirection vers Stripe (pas de chargement infini)" -ForegroundColor White
Write-Host ""

Write-Host "🧪 PAGE DE TEST :" -ForegroundColor Cyan
Write-Host "   → http://localhost:8000/test-stripe-config.html" -ForegroundColor White
Write-Host ""

Write-Host "==========================================" -ForegroundColor Cyan
Write-Host "✨ Tous les fichiers de correction sont prêts !" -ForegroundColor Green
Write-Host "📚 Consultez CORRECTIONS_STRIPE_FOOTER.md pour plus de détails" -ForegroundColor Yellow

Write-Host ""
Write-Host "Voulez-vous ouvrir le navigateur pour tester ? (O/N)" -ForegroundColor Yellow
$response = Read-Host

if ($response -eq "O" -or $response -eq "o") {
    Write-Host "🌐 Ouverture du navigateur..." -ForegroundColor Green
    Start-Process "http://localhost:8000"
    Start-Sleep -Seconds 2
    Start-Process "http://localhost:8000/test-stripe-config.html"
}

Write-Host ""
Write-Host "✅ Script terminé !" -ForegroundColor Green
