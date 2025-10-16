<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ClientAuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->isClient()) {
            return redirect()->route('cart.checkout');
        }
        return view('auth.client-login');
    }

    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        if (Auth::check() && Auth::user()->isClient()) {
            return redirect()->route('cart.checkout');
        }
        return view('auth.client-register');
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Déconnecter l'admin s'il est connecté
        if (session('admin_authenticated')) {
            session()->forget('admin_authenticated');
            \Illuminate\Support\Facades\Log::info('Déconnexion automatique de l\'admin lors de la connexion client');
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Vérifier que c'est bien un client
            if ($user->isClient() || $user->role === null) {
                // Mettre à jour le rôle si nécessaire
                if ($user->role === null) {
                    $user->update(['role' => 'client']);
                }
                
                $request->session()->regenerate();
                return redirect()->intended(route('cart.checkout'))
                    ->with('success', 'Connexion réussie !');
            }
            
            Auth::logout();
            return back()->withErrors([
                'email' => 'Ces identifiants ne correspondent pas à un compte client.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'Ces identifiants sont incorrects.',
        ])->onlyInput('email');
    }

    // Traiter l'inscription
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'name.required' => 'Le pseudo est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        // Déconnecter l'admin s'il est connecté
        if (session('admin_authenticated')) {
            session()->forget('admin_authenticated');
            \Illuminate\Support\Facades\Log::info('Déconnexion automatique de l\'admin lors de l\'inscription client');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'client',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('cart.checkout')
            ->with('success', 'Compte créé avec succès !');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('accueil')
            ->with('success', 'Déconnexion réussie.');
    }
}
