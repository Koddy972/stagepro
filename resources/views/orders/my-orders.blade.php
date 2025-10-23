@extends('layouts.app')

@section('title', 'Mes Commandes')

@section('content')
<style>
    .orders-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 2.5rem;
        color: var(--dark-blue);
        margin-bottom: 10px;
    }

    .page-header p {
        color: var(--text-gray);
        font-size: 1.1rem;
    }

    .orders-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .order-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .order-header {
        background: linear-gradient(135deg, var(--dark-blue), var(--medium-blue));
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .order-number {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .order-date {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .order-status {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .order-status.pending {
        background-color: #ffc107;
        color: #856404;
    }

    .order-status.processing {
        background-color: #17a2b8;
        color: white;
    }

    .order-status.completed {
        background-color: #28a745;
        color: white;
    }

    .order-status.cancelled {
        background-color: #dc3545;
        color: white;
    }

    .order-body {
        padding: 20px;
    }

    .order-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }
    .info-label {
        font-size: 0.85rem;
        color: var(--text-gray);
        margin-bottom: 5px;
        font-weight: 500;
    }

    .info-value {
        font-size: 1rem;
        color: var(--dark-blue);
        font-weight: 600;
    }

    .order-items {
        border-top: 1px solid #e0e0e0;
        padding-top: 15px;
    }

    .order-items h4 {
        font-size: 1rem;
        color: var(--dark-blue);
        margin-bottom: 15px;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-name {
        font-weight: 500;
        color: var(--dark-blue);
    }
    .item-quantity {
        color: var(--text-gray);
        font-size: 0.9rem;
    }

    .item-price {
        font-weight: 600;
        color: var(--gold);
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: var(--light-gray);
        border-top: 2px solid var(--gold);
    }

    .total-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-blue);
    }

    .view-details-btn {
        background-color: var(--gold);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .view-details-btn:hover {
        background-color: var(--dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .empty-orders {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .empty-orders i {
        font-size: 4rem;
        color: var(--gold);
        margin-bottom: 20px;
    }

    .empty-orders h3 {
        font-size: 1.5rem;
        color: var(--dark-blue);
        margin-bottom: 10px;
    }

    .empty-orders p {
        color: var(--text-gray);
        margin-bottom: 20px;
    }

    .shop-btn {
        display: inline-block;
        background-color: var(--gold);
        color: white;
        padding: 12px 30px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .shop-btn:hover {
        background-color: var(--dark-blue);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .order-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-info {
            grid-template-columns: 1fr;
        }

        .order-footer {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
    }
</style>

<div class="orders-container">
    <div class="page-header">
        <h1>Mes Commandes</h1>
        <p>Suivez l'état de vos commandes en temps réel</p>
    </div>

    @if($orders->isEmpty())
        <div class="empty-orders">
            <i class="fas fa-shopping-bag"></i>
            <h3>Aucune commande</h3>
            <p>Vous n'avez pas encore passé de commande</p>
            <a href="{{ route('boutique') }}" class="shop-btn">
                Découvrir la boutique
            </a>
        </div>
    @else
        <div class="orders-list">
            @foreach($orders as $order)                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-number">
                                <i class="fas fa-hashtag"></i>
                                {{ $order->order_number }}
                            </div>
                            <div class="order-date">
                                <i class="far fa-calendar-alt"></i>
                                {{ $order->created_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                        <span class="order-status {{ $order->status }}">
                            @switch($order->status)
                                @case('pending')
                                    En attente
                                    @break
                                @case('processing')
                                    En préparation
                                    @break
                                @case('completed')
                                    Terminée
                                    @break
                                @case('cancelled')
                                    Annulée
                                    @break
                            @endswitch
                        </span>
                    </div>

                    <div class="order-body">
                        <div class="order-info">
                            <div class="info-item">
                                <span class="info-label">Articles</span>
                                <span class="info-value">{{ $order->items->count() }} produit(s)</span>
                            </div>                            <div class="info-item">
                                <span class="info-label">Téléphone</span>
                                <span class="info-value">{{ $order->phone }}</span>
                            </div>
                        </div>

                        <div class="order-items">
                            <h4><i class="fas fa-box"></i> Produits commandés</h4>
                            @foreach($order->items->take(3) as $item)
                                <div class="item-row">
                                    <div>
                                        <div class="item-name">{{ $item->product_name }}</div>
                                        <div class="item-quantity">Quantité: {{ $item->quantity }}</div>
                                    </div>
                                    <div class="item-price">{{ number_format($item->subtotal, 2, ',', ' ') }} €</div>
                                </div>
                            @endforeach
                            @if($order->items->count() > 3)
                                <div style="text-align: center; padding: 10px; color: var(--text-gray);">
                                    ... et {{ $order->items->count() - 3 }} autre(s) produit(s)
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="total-amount">
                            Total: {{ number_format($order->total_amount, 2, ',', ' ') }} €
                        </div>
                        <a href="{{ route('order.show', $order->id) }}" class="view-details-btn">
                            <i class="fas fa-eye"></i>
                            Voir les détails
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection