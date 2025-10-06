<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    // Afficher la page galerie publique
    public function index()
    {
        $images = GalleryImage::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('galerie', compact('images'));
    }

    // Interface de gestion admin
    public function manage()
    {
        $images = GalleryImage::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.gallery', compact('images'));
    }

    // Stocker une nouvelle image
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category' => 'required|in:voiles,baches,capitonnage,reparation',
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
                'category' => $request->category,
                'order' => $request->order ?? 0
            ]);

            return redirect()->route('gallery.manage')
                ->with('success', 'Image ajoutée avec succès à la galerie');
        }

        return redirect()->route('gallery.manage')
            ->with('error', 'Erreur lors de l\'upload de l\'image');
    }

    // Mettre à jour une image
    public function update(Request $request, GalleryImage $image)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:voiles,baches,capitonnage,reparation',
            'order' => 'nullable|integer',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        // Si nouvelle image, supprimer l'ancienne
        if ($request->hasFile('new_image')) {
            // Supprimer l'ancienne image
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }

            $newImage = $request->file('new_image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/galerie'), $imageName);
            $image->image_path = 'images/galerie/' . $imageName;
        }

        $image->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
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

        return redirect()->route('gallery.manage')
            ->with('success', 'Image supprimée avec succès');
    }
}
