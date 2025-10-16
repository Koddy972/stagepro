<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Voiles',
                'description' => 'Confection et réparation de voiles pour bateaux - Voiles de course, croisière et régate',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Bâches',
                'description' => 'Bâches de protection marines - Bâches d\'hivernage, capotes, tauds de soleil',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Capitonnage',
                'description' => 'Sellerie marine et capitonnage - Coussins, matelas, rembourrage pour bateaux',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Accessoires Nautiques',
                'description' => 'Accessoires et équipements pour la navigation - Cordages, mousquetons, poulies',
                'order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'Équipements de Pont',
                'description' => 'Équipements et aménagements de pont - Filières, chandeliers, supports',
                'order' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Réparations',
                'description' => 'Services de réparation et entretien - Réparation de voiles, bâches et équipements',
                'order' => 6,
                'is_active' => true
            ]
        ];

        foreach ($categories as $categoryData) {
            // Vérifier si la catégorie existe déjà
            $exists = Category::where('name', $categoryData['name'])->first();
            
            if (!$exists) {
                Category::create($categoryData);
                $this->command->info("Catégorie '{$categoryData['name']}' créée avec succès.");
            } else {
                $this->command->warn("Catégorie '{$categoryData['name']}' existe déjà.");
            }
        }
        
        $this->command->info('Seeding des catégories terminé !');
    }
}
