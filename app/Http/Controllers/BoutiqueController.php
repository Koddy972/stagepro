<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BoutiqueController extends Controller
{
    /**
     * Affiche la page d'accueil avec tous les produits
     */
    public function index()
    {
        // Récupère tous les produits en stock
        $products = Product::where('in_stock', true)->get();
        
        return view('accueil', compact('products'));
    }
}
