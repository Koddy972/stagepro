<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Client - Caraïbes Voiles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            margin: 20px auto;
        }
        .auth-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .auth-header h2 {
            font-weight: 700;
            margin: 0;
            font-size: 28px;
        }
        .auth-body {
            padding: 40px 30px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 10px;
        }
        .text-muted a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        .text-muted a:hover {
            text-decoration: underline;
        }
        .password-requirements {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <i class="fas fa-user-plus fa-3x mb-3"></i>
            <h2>Inscription</h2>
            <p class="mb-0">Créez votre compte client</p>
        </div>
        <div class="auth-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('client.register.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-user me-2"></i>Pseudo</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" required autofocus placeholder="Entrez votre pseudo">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" required placeholder="votre@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-lock me-2"></i>Mot de passe</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           required placeholder="Minimum 8 caractères">
                    <div class="password-requirements">
                        <i class="fas fa-info-circle me-1"></i>
                        Le mot de passe doit contenir au moins 8 caractères
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="fas fa-lock me-2"></i>Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" 
                           required placeholder="Retapez votre mot de passe">
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-user-plus me-2"></i>Créer mon compte
                </button>

                <div class="text-center text-muted">
                    Vous avez déjà un compte ?
                    <a href="{{ route('client.login') }}">Se connecter</a>
                </div>

                <div class="text-center text-muted mt-3">
                    <a href="{{ route('accueil') }}">
                        <i class="fas fa-arrow-left me-2"></i>Retour à l'accueil
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
