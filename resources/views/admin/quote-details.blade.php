<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Détail du Devis #{{ $quote->id }}</title>
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
        }

        .admin-header {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .detail-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-label {
            font-weight: 600;
            color: var(--dark-blue);
            width: 150px;
        }

        .info-value {
            flex: 1;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <h1><i class="fas fa-file-invoice"></i> Détail du Devis #{{ $quote->id }}</h1>
        </div>
    </div>

    <div class="container">
        <a href="{{ route('admin.quotes') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Retour
        </a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Informations client -->
        <div class="detail-card">
            <h3>Informations Client</h3>
            <div class="info-row">
                <div class="info-label">Nom :</div>
                <div class="info-value">{{ $quote->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email :</div>
                <div class="info-value">
                    <a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Téléphone :</div>
                <div class="info-value">
                    <a href="tel:{{ $quote->phone }}">{{ $quote->phone }}</a>
                </div>
            </div>
            @if($quote->company)
            <div class="info-row">
                <div class="info-label">Entreprise :</div>
                <div class="info-value">{{ $quote->company }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">Sujet :</div>
                <div class="info-value"><strong>{{ $quote->subject }}</strong></div>
            </div>
            <div class="info-row">
                <div class="info-label">Date :</div>
                <div class="info-value">{{ $quote->created_at->format('d/m/Y à H:i') }}</div>
            </div>
        </div>

        <!-- Message -->
        <div class="detail-card">
            <h3>Message</h3>
            <p>{{ $quote->message }}</p>
        </div>

        <!-- Gestion du statut -->
        <div class="detail-card">
            <h3>Gestion du devis</h3>
            <form action="{{ route('admin.quote.status', $quote) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ $quote->status == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="in_progress" {{ $quote->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                        <option value="quoted" {{ $quote->status == 'quoted' ? 'selected' : '' }}>Devis envoyé</option>
                        <option value="accepted" {{ $quote->status == 'accepted' ? 'selected' : '' }}>Accepté</option>
                        <option value="rejected" {{ $quote->status == 'rejected' ? 'selected' : '' }}>Refusé</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes internes</label>
                    <textarea name="admin_notes" class="form-control" rows="4">{{ $quote->admin_notes }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </form>
        </div>

        <!-- Actions -->
        <div class="detail-card">
            <h3>Actions</h3>
            <div class="d-flex gap-2">
                <a href="mailto:{{ $quote->email }}" class="btn btn-success">
                    <i class="fas fa-reply"></i> Répondre par email
                </a>
                <a href="tel:{{ $quote->phone }}" class="btn btn-info">
                    <i class="fas fa-phone"></i> Appeler
                </a>
                <form action="{{ route('admin.quote.delete', $quote) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce devis ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
