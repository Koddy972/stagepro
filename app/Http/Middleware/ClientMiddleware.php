<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('client.login')
                ->with('info', 'Veuillez vous connecter pour continuer.');
        }

        $user = Auth::user();
        
        // Autoriser les clients et les utilisateurs sans rôle défini
        if ($user->isClient() || $user->role === null) {
            // Mettre à jour le rôle si nécessaire
            if ($user->role === null) {
                $user->update(['role' => 'client']);
            }
            return $next($request);
        }

        Auth::logout();
        return redirect()->route('client.login')
            ->with('error', 'Accès refusé.');
    }
}
