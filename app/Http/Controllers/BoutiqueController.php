<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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

    /**
     * Affiche la page boutique complète avec filtres de catégories
     */
    public function boutique(Request $request)
    {
        // Récupère toutes les catégories actives
        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        
        // Construction de la requête des produits
        $query = Product::where('in_stock', true)->with('category');
        
        // Filtrage par catégorie si spécifié
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Tri des produits
        $sortBy = $request->get('sort', 'name');
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
            default:
                $query->orderBy('name', 'asc');
                break;
        }
        
        $products = $query->get();
        
        return view('boutiquepage', compact('products', 'categories'));
    }
}
