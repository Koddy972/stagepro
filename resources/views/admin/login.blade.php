<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion Administrateur - Caraïbes Voiles</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --dark-blue: #0d2f4f;
            --medium-blue: #1a4f7a;
            --light-blue: #e9f1f7;
            --gold: #de419a;
            --dark-gold: #a98b56;
            --white: #ffffff;
            --light-gray: #f8f9fa;
            --dark-gray: #2d3436;
            --text-gray: #5c5c5c;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-gray);
        }
        
        .login-container {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            margin: 20px;
        }
        
        .login-header {
            background: var(--dark-blue);
            color: var(--white);
            padding: 40px 30px;
            text-align: center;
        }
        
        .login-header i {
            font-size: 3rem;
            color: var(--gold);
            margin-bottom: 15px;
        }
        
        .login-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .login-header p {
            font-size: 0.95rem;
            opacity: 0.9;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-blue);
        }
        
        .form-group label i {
            margin-right: 5px;
            color: var(--gold);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--light-blue);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: 'Montserrat', sans-serif;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(222, 65, 154, 0.1);
        }
        
        .error-message {
            background: #fee;
            border: 1px solid #fcc;
            color: #c33;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .error-message i {
            font-size: 1.2rem;
        }
        
        .btn {
            width: 100%;
            padding: 14px;
            background: var(--gold);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Montserrat', sans-serif;
        }
        
        .btn:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: var(--medium-blue);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .back-link a:hover {
            color: var(--gold);
        }
        
        .back-link i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-shield-alt"></i>
            <h1>Espace Administrateur</h1>
            <p>Caraïbes Voiles Manutention</p>
        </div>
        
        <div class="login-body">
            @if($errors->any())
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first('password') }}</span>
                </div>
            @endif
            
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-key"></i>
                        Mot de passe administrateur
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Entrez le mot de passe"
                        required
                        autofocus
                    >
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </button>
            </form>
            
            <div class="back-link">
                <a href="{{ route('accueil') }}">
                    <i class="fas fa-arrow-left"></i>
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</body>
</html>
