<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        GalleryCategory::create($validated);

        return redirect()->back()->with('success', 'Catégorie de galerie créée avec succès !');
    }

    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories,name,' . $galleryCategory->id,
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $galleryCategory->update($validated);

        return redirect()->back()->with('success', 'Catégorie de galerie mise à jour avec succès !');
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        // Vérifier si des images sont liées
        if ($galleryCategory->images()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer une catégorie contenant des images.');
        }

        $galleryCategory->delete();

        return redirect()->back()->with('success', 'Catégorie de galerie supprimée avec succès !');
    }
}
