<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Cordage Marine Premium',
            'description' => 'Cordage haute qualité pour voiliers, résistant aux UV et à l\'eau salée. Diamètre 10mm, longueur 50m.',
            'price' => 89.99,
            'in_stock' => true
        ]);

        Product::create([
            'name' => 'Gilet de Sauvetage Automatique',
            'description' => 'Gilet de sauvetage gonflable automatique 150N, homologué CE, avec harnais intégré et sifflet.',
            'price' => 159.90,
            'in_stock' => true
        ]);

        Product::create([
            'name' => 'Kit de Maintenance Winch',
            'description' => 'Kit complet pour l\'entretien des winches : graisse marine, joints, ressorts et outils spécialisés.',
            'price' => 45.50,
            'in_stock' => true
        ]);

        Product::create([
            'name' => 'Antifouling Écologique',
            'description' => 'Peinture antifouling sans biocide, respectueuse de l\'environnement. Bidon de 2,5L pour 20m² de coque.',
            'price' => 125.00,
            'in_stock' => false
        ]);

        Product::create([
            'name' => 'Voile de Génois 140%',
            'description' => 'Voile de génois en dacron haute qualité, coupe radiale pour optimiser les performances au près.',
            'price' => 890.00,
            'in_stock' => true
        ]);

        Product::create([
            'name' => 'Ancre Forteresse FX-23',
            'description' => 'Ancre à enfouissement haute performance, idéale pour fonds sableux et vaseux. Poids 4,5 kg.',
            'price' => 320.00,
            'in_stock' => true
        ]);
    }
}
