<?php

namespace App\Http\Controllers;

use App\Models\AdminLoginAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Afficher la page de connexion admin
     */
    public function showLoginForm()
    {
        // Forcer la déconnexion si on arrive sur la page de login
        // Cela évite le problème du bouton retour
        session()->forget('admin_authenticated');
        // Ne pas utiliser flush() car il supprime aussi le token CSRF
        // session()->flush();

        // Vérifier si l'IP est bloquée
        $ipAddress = request()->ip();
        $maxAttempts = config('auth.admin_max_attempts', env('ADMIN_MAX_LOGIN_ATTEMPTS', 5));
        $lockoutDuration = config('auth.admin_lockout_duration', env('ADMIN_LOCKOUT_DURATION', 15));
        
        if (AdminLoginAttempt::isBlocked($ipAddress, $maxAttempts, $lockoutDuration)) {
            $remainingTime = $lockoutDuration;
            return view('admin.login', compact('remainingTime'));
        }

        return view('admin.login');
    }

    /**
     * Gérer la connexion admin
     */
    public function login(Request $request)
    {
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();
        $maxAttempts = env('ADMIN_MAX_LOGIN_ATTEMPTS', 5);
        $lockoutDuration = env('ADMIN_LOCKOUT_DURATION', 15);

        // Vérifier si l'IP est bloquée
        if (AdminLoginAttempt::isBlocked($ipAddress, $maxAttempts, $lockoutDuration)) {
            Log::warning('Tentative de connexion depuis une IP bloquée', [
                'ip' => $ipAddress,
                'user_agent' => $userAgent
            ]);

            return back()->withErrors([
                'password' => "Trop de tentatives échouées. Réessayez dans {$lockoutDuration} minutes.",
            ])->withInput();
        }

        $request->validate([
            'password' => 'required|string',
        ]);

        $passwordHash = env('ADMIN_PASSWORD_HASH');

        // Vérifier le mot de passe avec Hash
        if (Hash::check($request->password, $passwordHash)) {
            // Connexion réussie
            AdminLoginAttempt::logAttempt($ipAddress, true, $userAgent);
            
            Log::info('Connexion admin réussie', [
                'ip' => $ipAddress,
                'user_agent' => $userAgent
            ]);

            // Déconnecter tout utilisateur client connecté
            if (\Illuminate\Support\Facades\Auth::check()) {
                \Illuminate\Support\Facades\Auth::logout();
                Log::info('Déconnexion automatique du client lors de la connexion admin', [
                    'ip' => $ipAddress
                ]);
            }

            // Régénérer la session pour éviter la fixation de session
            $request->session()->regenerate();
            
            session(['admin_authenticated' => true]);
            return redirect()->route('products.index')->with('success', 'Connexion réussie!');
        }

        // Mot de passe incorrect
        AdminLoginAttempt::logAttempt($ipAddress, false, $userAgent);
        
        $remainingAttempts = $maxAttempts - AdminLoginAttempt::getRecentFailedAttempts($ipAddress, $lockoutDuration);

        Log::warning('Tentative de connexion admin échouée', [
            'ip' => $ipAddress,
            'user_agent' => $userAgent,
            'remaining_attempts' => $remainingAttempts
        ]);

        return back()->withErrors([
            'password' => "Mot de passe incorrect. Il vous reste {$remainingAttempts} tentative(s).",
        ])->withInput();
    }

    /**
     * Déconnexion admin
     */
    public function logout()
    {
        $ipAddress = request()->ip();
        
        Log::info('Déconnexion admin', [
            'ip' => $ipAddress
        ]);

        // Supprimer uniquement l'authentification admin
        session()->forget('admin_authenticated');
        // Ne pas utiliser flush() pour préserver le token CSRF
        // session()->flush();
        
        return redirect()->route('accueil')->with('success', 'Déconnexion réussie!');
    }

    /**
     * Afficher les commandes des clients
     */
    public function showOrders()
    {
        $orders = \App\Models\Order::with(['user', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.orders', compact('orders'));
    }

    /**
     * Voir les détails d'une commande
     */
    public function showOrderDetails($orderId)
    {
        $order = \App\Models\Order::with(['user', 'items.product'])
            ->findOrFail($orderId);

        return view('admin.order-details', compact('order'));
    }

    /**
     * Mettre à jour le statut d'une commande
     */
    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = \App\Models\Order::findOrFail($orderId);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Statut de la commande mis à jour.');
    }
}
    
