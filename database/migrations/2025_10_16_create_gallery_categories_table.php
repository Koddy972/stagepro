<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insérer les catégories par défaut
        DB::table('gallery_categories')->insert([
            ['name' => 'Voiles', 'slug' => 'voiles', 'description' => 'Confection et réparation de voiles', 'order' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bâches', 'slug' => 'baches', 'description' => 'Fabrication de bâches sur mesure', 'order' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Capitonnage', 'slug' => 'capitonnage', 'description' => 'Travaux de capitonnage', 'order' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Réparation', 'slug' => 'reparation', 'description' => 'Services de réparation', 'order' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Modifier la table gallery_images pour utiliser une clé étrangère
        Schema::table('gallery_images', function (Blueprint $table) {
            // Ajouter une colonne temporaire pour la nouvelle relation
            $table->foreignId('gallery_category_id')->nullable()->after('image_path')->constrained('gallery_categories')->onDelete('cascade');
        });

        // Migrer les données existantes
        $voilesId = DB::table('gallery_categories')->where('slug', 'voiles')->first()->id;
        $bachesId = DB::table('gallery_categories')->where('slug', 'baches')->first()->id;
        $capitonnageId = DB::table('gallery_categories')->where('slug', 'capitonnage')->first()->id;
        $reparationId = DB::table('gallery_categories')->where('slug', 'reparation')->first()->id;

        DB::table('gallery_images')->where('category', 'voiles')->update(['gallery_category_id' => $voilesId]);
        DB::table('gallery_images')->where('category', 'baches')->update(['gallery_category_id' => $bachesId]);
        DB::table('gallery_images')->where('category', 'capitonnage')->update(['gallery_category_id' => $capitonnageId]);
        DB::table('gallery_images')->where('category', 'reparation')->update(['gallery_category_id' => $reparationId]);

        // Supprimer l'ancienne colonne category
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restaurer l'ancienne colonne
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->enum('category', ['voiles', 'baches', 'capitonnage', 'reparation'])->after('image_path');
        });

        // Restaurer les données
        $categories = DB::table('gallery_categories')->get();
        foreach ($categories as $cat) {
            DB::table('gallery_images')
                ->where('gallery_category_id', $cat->id)
                ->update(['category' => $cat->slug]);
        }

        // Supprimer la clé étrangère
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropForeign(['gallery_category_id']);
            $table->dropColumn('gallery_category_id');
        });

        Schema::dropIfExists('gallery_categories');
    }
};
