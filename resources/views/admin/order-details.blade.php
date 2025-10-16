@extends('layouts.app')

@section('content')
<style>
    .order-details-section {
        padding: 90px 0;
        background-color: #f8f9fa;
        min-height: 80vh;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid #de419a;
    }

    .section-title {
        color: #0d2f4f;
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        margin: 0;
    }

    .btn-back {
        background-color: #0d2f4f;
        color: #ffffff;
        padding: 12px 25px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background-color: #de419a;
        transform: translateY(-2px);
    }

    .details-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
    }

    .card-title {
        color: #0d2f4f;
        font-size: 1.3rem;
        margin-bottom: 20px;
        font-weight: 600;
        border-bottom: 2px solid #de419a;
        padding-bottom: 10px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-label {
        color: #5c5c5c;
        font-weight: 600;
    }

    .info-value {
        color: #0d2f4f;
        text-align: right;
    }

    .order-item {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex-grow: 1;
    }

    .item-name {
        color: #0d2f4f;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .item-price {
        color: #5c5c5c;
        font-size: 0.9rem;
    }

    .item-total {
        font-weight: 600;
        color: #0d2f4f;
        text-align: right;
    }

    .badge {
        padding: 8px 15px;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
    }

    .badge-pending {
        background-color: #ffeaa7;
        color: #d63031;
    }

    .badge-processing {
        background-color: #74b9ff;
        color: #0984e3;
    }

    .badge-completed {
        background-color: #55efc4;
        color: #00b894;
    }

    .badge-cancelled {
        background-color: #fab1a0;
        color: #d63031;
    }

    .status-form {
        margin-top: 20px;
    }

    .status-form select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .btn-update {
        width: 100%;
        background-color: #de419a;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-update:hover {
        background-color: #0d2f4f;
        transform: translateY(-2px);
    }

    @media (max-width: 992px) {
        .details-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="order-details-section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Détails de la commande #{{ $order->order_number }}</h1>
            <a href="{{ route('admin.orders') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour aux commandes
            </a>
        </div>

        <div class="details-grid">
            <!-- Informations principales -->
            <div>
                <!-- Informations client -->
                <div class="card">
                    <h2 class="card-title"><i class="fas fa-user"></i> Informations Client</h2>
                    <div class="info-row">
                        <span class="info-label">Nom</span>
                        <span class="info-value">{{ $order->user->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $order->user->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Téléphone</span>
                        <span class="info-value">{{ $order->phone }}</span>
                    </div>
                    @if($order->notes)
                        <div class="info-row">
                            <span class="info-label">Notes</span>
                            <span class="info-value" style="text-align: right; max-width: 60%;">
                                {{ $order->notes }}
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Articles commandés -->
                <div class="card">
                    <h2 class="card-title"><i class="fas fa-shopping-bag"></i> Articles Commandés</h2>
                    @foreach($order->items as $item)
                        <div class="order-item">
                            <div class="item-image">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         alt="{{ $item->product_name }}">
                                @else
                                    <img src="https://placehold.co/80x80/1a4f7a/ffffff?text=P" 
                                         alt="{{ $item->product_name }}">
                                @endif
                            </div>
                            <div class="item-details">
                                <div class="item-name">{{ $item->product_name }}</div>
                                <div class="item-price">
                                    {{ number_format($item->product_price, 2, ',', ' ') }}€ × {{ $item->quantity }}
                                </div>
                            </div>
                            <div class="item-total">
                                {{ number_format($item->subtotal, 2, ',', ' ') }}€
                            </div>
                        </div>
                    @endforeach

                    <div class="info-row" style="margin-top: 20px; font-size: 1.2rem; font-weight: 700;">
                        <span class="info-label">Total</span>
                        <span class="info-value">{{ number_format($order->total_amount, 2, ',', ' ') }}€</span>
                    </div>
                </div>
            </div>

            <!-- Résumé de la commande -->
            <div>
                <div class="card">
                    <h2 class="card-title"><i class="fas fa-info-circle"></i> Résumé</h2>
                    <div class="info-row">
                        <span class="info-label">N° Commande</span>
                        <span class="info-value">#{{ $order->order_number }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date</span>
                        <span class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Statut actuel</span>
                        <span class="info-value">
