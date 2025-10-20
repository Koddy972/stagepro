<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'gallery_category_id',
        'order'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    /**
     * Relation avec la catégorie de galerie
     */
    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class);
    }

    /**
     * Accessor pour compatibilité (si besoin)
     */
    public function getCategoryAttribute()
    {
        return $this->galleryCategory ? $this->galleryCategory->slug : null;
    }
}
