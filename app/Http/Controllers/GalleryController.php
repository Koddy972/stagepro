<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    // Afficher la page galerie publique
    public function index(Request $request)
    {
        $images = GalleryImage::with('galleryCategory')
            ->whereHas('galleryCategory', function($query) {
                $query->where('is_active', true);
            })
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $categories = \App\Models\GalleryCategory::where('is_active', true)
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        
        // Récupérer la catégorie sélectionnée depuis l'URL
        $selectedCategory = $request->get('category', null);
            
        return view('galerie', compact('images', 'categories', 'selectedCategory'));
    }

    // Interface de gestion admin
    public function manage()
    {
        $images = GalleryImage::with('galleryCategory')->orderBy('order')->orderBy('created_at', 'desc')->get();
        $categories = \App\Models\GalleryCategory::orderBy('order')->orderBy('name')->get();
        return view('admin.gallery', compact('images', 'categories'));
    }

    // Stocker une nouvelle image
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'order' => 'nullable|integer'
        ]);

        // Traitement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Sauvegarder dans public/images/galerie
            $image->move(public_path('images/galerie'), $imageName);
            $imagePath = 'images/galerie/' . $imageName;

            GalleryImage::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $imagePath,
                'gallery_category_id' => $request->gallery_category_id,
                'order' => $request->order ?? 0
            ]);

            return redirect()->route('gallery.manage')
                ->with('success', 'Image ajoutée avec succès à la galerie');
        }

        return redirect()->route('gallery.manage')
            ->with('error', 'Erreur lors de l\'upload de l\'image');
    }

    // Récupérer les données d'une image pour l'édition
    public function edit(GalleryImage $image)
    {
        return response()->json([
            'success' => true,
            'image' => $image
        ]);
    }

    // Mettre à jour une image
    public function update(Request $request, GalleryImage $image)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        // Si nouvelle image, supprimer l'ancienne
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }

            $newImage = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/galerie'), $imageName);
            $image->image_path = 'images/galerie/' . $imageName;
        }

        $image->update([
            'title' => $request->title,
            'description' => $request->description,
            'gallery_category_id' => $request->gallery_category_id,
            'order' => $request->order ?? $image->order,
            'image_path' => $image->image_path
        ]);

        return redirect()->route('gallery.manage')
            ->with('success', 'Image mise à jour avec succès');
    }

    // Supprimer une image
    public function destroy(GalleryImage $image)
    {
        // Supprimer le fichier
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }

        $image->delete();

        // Si la requête attend du JSON (AJAX), retourner JSON
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Image supprimée avec succès'
            ]);
        }

        return redirect()->route('gallery.manage')
            ->with('success', 'Image supprimée avec succès');
    }

    // Récupérer les images d'une catégorie pour le hover (AJAX)
    public function getImagesByCategory($categorySlug)
    {
        $category = \App\Models\GalleryCategory::where('slug', $categorySlug)->first();
        
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        $images = GalleryImage::where('gallery_category_id', $category->id)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->limit(6) // Maximum 6 images pour le hover
            ->get()
            ->map(function($image) {
                return [
                    'id' => $image->id,
                    'title' => $image->title,
                    'image_url' => asset($image->image_path)
                ];
            });

        return response()->json([
            'success' => true,
            'images' => $images
        ]);
    }
}
