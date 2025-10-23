<!DOCTYPE html>
<html>
<head>
    <title>Debug Galerie</title>
</head>
<body>
    <h1>Debug - Catégories et Images</h1>
    
    <?php
    // Charger Laravel
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    // Récupérer les catégories avec images
    $categories = \App\Models\GalleryCategory::with('images')->get();
    
    echo "<h2>Catégories trouvées : " . $categories->count() . "</h2>";
    
    foreach($categories as $cat) {
        echo "<div style='border:1px solid #ccc; padding:15px; margin:10px 0;'>";
        echo "<h3>Catégorie : {$cat->name}</h3>";
        echo "<p>Slug : <strong>{$cat->slug}</strong></p>";
        echo "<p>Active : " . ($cat->is_active ? 'OUI' : 'NON') . "</p>";
        echo "<p>Nombre d'images : <strong>{$cat->images->count()}</strong></p>";
        
        if($cat->images->count() > 0) {
            echo "<h4>Images :</h4>";
            foreach($cat->images as $img) {
                echo "<div style='margin:5px 0;'>";
                echo "- {$img->title} (ID: {$img->id})<br>";
                echo "<img src='/{$img->image_path}' style='width:100px;height:100px;object-fit:cover;'><br>";
                echo "</div>";
            }
        } else {
            echo "<p style='color:red;'>❌ Aucune image dans cette catégorie</p>";
        }
        echo "</div>";
    }
    ?>
</body>
</html>
