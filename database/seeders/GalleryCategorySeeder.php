<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GalleryCategory;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tauds et Voiles',
                'slug' => 'tauds-voiles',
                'description' => 'Fabrication et réparation de voiles sur mesure',
            ],
            [
                'name' => 'Bâches de Protection',
                'slug' => 'baches-protection',
                'description' => 'Bâches sur mesure pour tous types de protection',
            ],
            [
                'name' => 'Capitonnage',
                'slug' => 'capitonnage',
                'description' => 'Réfection de sièges et ameublements',
            ],
            [
                'name' => 'Biminis',
                'slug' => 'biminis',
                'description' => 'Conception et installation de biminis sur mesure',
            ],
            [
                'name' => 'Sièges et Coussins',
                'slug' => 'sieges-coussins',
                'description' => 'Création et rénovation de sièges et coussins',
            ],
            [
                'name' => 'Solutions Sur Mesure',
                'slug' => 'solutions-sur-mesure',
                'description' => 'Projets personnalisés selon vos besoins',
            ],
        ];

        foreach ($categories as $category) {
            GalleryCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('Catégories de galerie créées avec succès !');
    }
}
