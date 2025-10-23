@extends('layouts.app')

@section('title', 'Devis Envoyé - Caraïbes Voiles Manutention')

@push('styles')
<style>
    .success-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
    }

    .success-container {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .success-icon {
        font-size: 5rem;
        color: #2ecc71;
        margin-bottom: 30px;
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

    .success-title {
        color: #2c3e50;
        font-size: 2rem;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .success-message {
        color: #7f8c8d;
        font-size: 1.1rem;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .quote-details {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
        margin: 30px 0;
        text-align: left;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e0e6ed;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #2c3e50;
    }

    .detail-value {
        color: #555;
    }

    .btn-home {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 40px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-home:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }
</style>
@endpush

@section('content')
<div class="success-section">
    <div class="container">
        <div class="success-container">
            <div class="success-icon">✅</div>
            
            <h1 class="success-title">Demande Envoyée avec Succès!</h1>
            
            <p class="success-message">
                Merci pour votre demande de devis! Nous avons bien reçu vos informations 
                et notre équipe vous contactera dans les plus brefs délais.
            </p>

            @if(session('quote_data'))
            <div class="quote-details">
                <h3 style="margin-bottom: 20px; color: #2c3e50;">📋 Récapitulatif</h3>
                
                <div class="detail-row">
                    <span class="detail-label">Nom:</span>
                    <span class="detail-value">{{ session('quote_data')['name'] }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ session('quote_data')['email'] }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Téléphone:</span>
                    <span class="detail-value">{{ session('quote_data')['phone'] }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Service:</span>
                    <span class="detail-value">{{ ucfirst(str_replace('_', ' ', session('quote_data')['service_type'])) }}</span>
                </div>
            </div>
            @endif

            <a href="{{ route('accueil') }}" class="btn-home">
                🏠 Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection
