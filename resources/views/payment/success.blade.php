@extends('layouts.app')

@section('title', 'Paiement réussi')

@push('styles')
<style>
    .success-page {
        padding: 90px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    .success-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .success-card {
        background: white;
        border-radius: 20px;
        padding: 50px 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        text-align: center;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .success-icon svg {
        width: 50px;
        height: 50px;
        stroke: white;
        stroke-width: 3;
    }

    .success-title {
        font-size: 2rem;
        color: #0d2f4f;
        margin-bottom: 15px;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
    }

    .success-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 35px;
    }

    .order-info {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        text-align: left;
    }

    .order-info-title {
        font-weight: 700;
        color: #0d2f4f;
        margin-bottom: 20px;
        font-size: 1.2rem;
    }

    .order-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #dee2e6;
    }

    .order-info-item:last-child {
        border-bottom: none;
    }

    .order-info-label {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .order-info-value {
        font-weight: 600;
        color: #0d2f4f;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
    }

    .next-steps {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        text-align: left;
    }

    .next-steps-icon {
        color: #0369a1;
        font-size: 1.5rem;
        margin-right: 15px;
    }

    .next-steps-title {
        font-weight: 700;
        color: #0c4a6e;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .next-steps-text {
        color: #075985;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-primary-action {
        flex: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 16px 30px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        min-width: 200px;
    }

    .btn-primary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        color: white;
    }

    .btn-secondary-action {
        flex: 1;
        background: white;
        color: #667eea;
        padding: 16px 30px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: 2px solid #667eea;
        min-width: 200px;
    }

    .btn-secondary-action:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }

    .email-notice {
        margin-top: 25px;
        padding: 15px;
        background: #fff8e1;
        border-left: 4px solid #f59e0b;
        border-radius: 6px;
        color: #92400e;
        font-size: 0.9rem;
        text-align: left;
    }

    @media (max-width: 576px) {
        .success-card {
            padding: 35px 25px;
        }

        .success-title {
            font-size: 1.6rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-primary-action,
        .btn-secondary-action {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="success-page">
    <div class="success-container">
        <div class="success-card">
            <!-- Icône de succès -->
            <div class="success-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="success-title">Paiement réussi !</h1>
            <p class="success-subtitle">Merci pour votre commande chez Caraïbes Voiles</p>

            <!-- Informations de commande -->
            <div class="order-info">
                <h2 class="order-info-title">Détails de votre commande</h2>
                
                <div class="order-info-item">
                    <span class="order-info-label">
                        <i class="fas fa-hashtag"></i> Numéro de transaction
                    </span>
                    <span class="order-info-value">{{ substr($sessionId, 0, 20) }}...</span>
                </div>

                <div class="order-info-item">
                    <span class="order-info-label">
                        <i class="fas fa-calendar-check"></i> Date
                    </span>
                    <span class="order-info-value">{{ now()->format('d/m/Y à H:i') }}</span>
                </div>

                <div class="order-info-item">
                    <span class="order-info-label">
                        <i class="fas fa-credit-card"></i> Méthode de paiement
                    </span>
                    <span class="order-info-value">
                        <svg style="height: 16px; display: inline-block; vertical-align: middle;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 14" fill="none">
                            <path fill="#635BFF" d="M14.3 6.79c0-1.27-.62-2.28-1.83-2.28-1.22 0-2.04 1.01-2.04 2.27 0 1.5.91 2.27 2.2 2.27.63 0 1.1-.14 1.53-.36v-1.19c-.43.19-.88.31-1.42.31-.56 0-1.06-.2-1.13-.88h2.66c.01-.04.03-.44.03-.64zm-2.68-.68c0-.66.4-.93.83-.93.42 0 .79.27.79.93h-1.62zm-2.46-2.28c-.5 0-.83.24-1.01.4l-.07-.33h-1.35v7.92l1.54-.33.01-1.92c.19.13.47.32.92.32 1.17 0 2.24-.95 2.24-2.58 0-1.63-1.05-2.48-2.28-2.48zm-.37 3.87c-.31 0-.49-.11-.61-.25l-.01-1.97c.13-.16.32-.27.62-.27.47 0 .8.53.8 1.24 0 .72-.32 1.25-.8 1.25zM4.97 2.28L3.42 2.61v1.14l1.55-.33V2.28zM3.42 4.07h1.55v4.7H3.42v-4.7zm-.76.33c-.12-.34-.38-.52-.77-.52-.57 0-1.01.5-1.2 1.16L1 4.07H.15v3.7h1.55v-2.5c0-.69.31-1.04.75-1.04.44 0 .64.35.64.99v2.55h1.55v-2.97c0-1.3-.62-1.9-1.62-1.9z"/>
                        </svg>
                        Stripe
                    </span>
                </div>
            </div>

            <!-- Prochaines étapes -->
            <div class="next-steps">
                <div style="display: flex; align-items: flex-start;">
                    <i class="fas fa-info-circle next-steps-icon"></i>
                    <div style="flex: 1;">
                        <h3 class="next-steps-title">Prochaines étapes</h3>
                        <p class="next-steps-text">
                            Un email de confirmation a été envoyé avec tous les détails de votre commande. 
                            Vous pouvez suivre l'état de votre commande dans votre espace client.
                            <br><br>
                            <strong>Important :</strong> Les commandes sont à retirer à notre atelier à Ducos.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="action-buttons">
                <a href="{{ route('my.orders') }}" class="btn-primary-action">
                    <i class="fas fa-box"></i>
                    Voir mes commandes
                </a>
                <a href="{{ route('boutique') }}" class="btn-secondary-action">
                    <i class="fas fa-shopping-bag"></i>
                    Continuer mes achats
                </a>
            </div>

            <!-- Note email -->
            <div class="email-notice">
                <i class="fas fa-envelope"></i>
                <strong>Vérifiez vos emails</strong> - Si vous ne recevez pas de confirmation, pensez à vérifier vos spams.
            </div>
        </div>
    </div>
</div>
@endsection
