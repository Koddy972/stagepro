@extends('layouts.app')

@section('content')
<style>
    .orders-section {
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
        font-size: 2.2rem;
        margin: 0;
    }

    .btn-back {
        background-color: #0d2f4f;
        color: #ffffff;
        padding: 12px 25px;
        text-decoration: none;        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background-color: #de419a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .orders-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
    }

    .stat-card i {
        font-size: 2rem;
        color: #de419a;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;        color: #0d2f4f;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #5c5c5c;
        font-size: 0.9rem;
    }

    .orders-table {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .orders-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .orders-table th {
        background-color: #0d2f4f;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }

    .orders-table td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .orders-table tr:hover {
        background-color: #f8f9fa;
    }

    .order-number {
        font-weight: 600;
        color: #0d2f4f;
    }
    .client-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .client-email {
        color: #5c5c5c;
        font-size: 0.85rem;
    }

    .badge {
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
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

    .btn-view {
        background-color: #de419a;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .btn-view:hover {
        background-color: #0d2f4f;        transform: translateY(-2px);
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
    }

    .pagination a, .pagination span {
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-decoration: none;
        color: #0d2f4f;
    }

    .pagination a:hover {
        background-color: #de419a;
        color: white;
        border-color: #de419a;
    }

    .pagination .active {
        background-color: #0d2f4f;
        color: white;
        border-color: #0d2f4f;
    }

    @media (max-width: 992px) {
        .orders-table {
            overflow-x: auto;
        }

        .section-header {
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;
        }
    }
</style>

<section class="orders-section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Gestion des Commandes</h1>
            <a href="{{ route('products.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour au tableau de bord
            </a>
        </div>
        <!-- Statistiques -->
        <div class="orders-stats">
            <div class="stat-card">
                <i class="fas fa-shopping-cart"></i>
                <div class="stat-value">{{ $orders->total() }}</div>
                <div class="stat-label">Total Commandes</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <div class="stat-value">{{ $orders->where('status', 'pending')->count() }}</div>
                <div class="stat-label">En Attente</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-cog"></i>
                <div class="stat-value">{{ $orders->where('status', 'processing')->count() }}</div>
                <div class="stat-label">En Traitement</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle"></i>
                <div class="stat-value">{{ $orders->where('status', 'completed')->count() }}</div>
                <div class="stat-label">Terminées</div>
            </div>
        </div>

        <!-- Liste des commandes -->
        <div class="orders-table">
            @if($orders->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>N° Commande</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <span class="order-number">#{{ $order->order_number }}</span>
                                </td>
                                <td>
                                    <div class="client-info">
                                        <div>
                                            <div><strong>{{ $order->user->name }}</strong></div>
                                            <div class="client-email">{{ $order->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td><strong>{{ number_format($order->total_amount, 2, ',', ' ') }}€</strong></td>
                                <td>
                                    @if($order->status === 'pending')
                                        <span class="badge badge-pending">En Attente</span>
                                    @elseif($order->status === 'processing')
                                        <span class="badge badge-processing">En Traitement</span>
                                    @elseif($order->status === 'completed')
                                        <span class="badge badge-completed">Terminée</span>
                                    @else
                                        <span class="badge badge-cancelled">Annulée</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.order.details', $order->id) }}" class="btn-view">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $orders->links() }}
                </div>            @else
                <div style="text-align: center; padding: 60px 20px;">
                    <i class="fas fa-inbox" style="font-size: 4rem; color: #de419a; margin-bottom: 20px;"></i>
                    <h3 style="color: #0d2f4f; margin-bottom: 15px;">Aucune commande</h3>
                    <p style="color: #5c5c5c;">Les commandes apparaîtront ici une fois que les clients auront passé des achats.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
