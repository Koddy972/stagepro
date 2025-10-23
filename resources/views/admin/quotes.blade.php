<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion des Devis - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dark-blue: #0d2f4f;
            --medium-blue: #1a4f7a;
            --gold: #d4af37;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-header {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .admin-header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card .icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .stats-card .value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--dark-blue);
        }

        .stats-card .label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .stats-card.unread {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
        }

        .stats-card.unread .value {
            color: white;
        }

        .stats-card.pending {
            background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%);
            color: white;
        }

        .stats-card.pending .value {
            color: white;
        }

        .quote-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .quote-card:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        .quote-card.unread {
            border-left-color: #ff6b6b;
            background: #fff5f5;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <h1><i class="fas fa-file-invoice"></i> Gestion des Devis</h1>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card unread">
                    <div class="value">{{ $unreadCount }}</div>
                    <div class="label">Non lus</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card pending">
                    <div class="value">{{ $pendingCount }}</div>
                    <div class="label">En attente</div>
                </div>
            </div>
        </div>

        <!-- Liste -->
        @forelse($quotes as $quote)
            <div class="quote-card {{ $quote->read_at ? '' : 'unread' }}">
                <h3>{{ $quote->subject }}</h3>
                <p>{{ $quote->name }} - {{ $quote->email }}</p>
                <a href="{{ route('admin.quote.details', $quote) }}">Voir</a>
            </div>
        @empty
            <p>Aucun devis</p>
        @endforelse

        {{ $quotes->links() }}
    </div>
</body>
</html>
