@extends('layouts.app')

@section('title', 'Paiement annulé')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <!-- Icône d'annulation -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-yellow-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Paiement annulé</h1>
            <p class="text-gray-600">Votre paiement n'a pas été effectué</p>
        </div>

        <!-- Message d'information -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Que s'est-il passé ?</h2>
                    <p class="text-gray-600 mb-4">
                        Vous avez annulé le processus de paiement. Aucun montant n'a été débité de votre compte.
                    </p>
                    <p class="text-gray-600">
                        Vos articles sont toujours dans votre panier. Vous pouvez revenir quand vous le souhaitez pour finaliser votre commande.
                    </p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('cart.index') }}" class="flex-1 bg-blue-600 text-white text-center py-3 px-6 rounded-lg hover:bg-blue-700 transition">
                Retour au panier
            </a>
            <a href="{{ route('boutique') }}" class="flex-1 bg-gray-200 text-gray-800 text-center py-3 px-6 rounded-lg hover:bg-gray-300 transition">
                Continuer mes achats
            </a>
        </div>

        <!-- Besoin d'aide -->
        <div class="mt-8 text-center">
            <p class="text-gray-600">
                Vous rencontrez un problème ? 
                <a href="{{ route('quote.create') }}" class="text-blue-600 hover:underline">Contactez-nous</a>
            </p>
        </div>
    </div>
</div>
@endsection
