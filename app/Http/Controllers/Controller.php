<?php

namespace App\Http\Controllers;

abstract class Controller
{
 // Dans votre contrôleur de page
public function boutique()
{
    $products = \App\Models\Product::where('in_stock', true)->get();
    return view('boutique', compact('products'));
}   //
}
