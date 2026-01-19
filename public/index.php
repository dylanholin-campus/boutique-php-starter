<?php
// public/index.php devient par exemple /

// recuperation de l'URI demandée (le chemin après le domaine)
$uri = $_SERVER['REQUEST_URI'];

// recupération de la méthode HTTP (GET, POST, etc..)
$method = $_SERVER['REQUEST_METHOD'];

echo "<h1>Front Controller</h1>";
echo "<p><strong>URI demandée :</strong> " . htmlspecialchars($uri) . "</p>";
echo "<p><strong>Méthode HTTP :</strong> " . htmlspecialchars($method) . "</p>";

echo "<hr>";
if ($uri === '/') {
    echo "🏠 Bienvenue sur l'accueil !"; //  http://localhost:8000/
} elseif ($uri === '/produits') {
    echo "📦 Liste des produits";   //       http://localhost:8000/produits
} elseif (strpos($uri, '/test') === 0) { 
    echo "🧪 Page de test détectée"; //     http://localhost:8000/test
} else {
    echo "❌ Page non trouvée (404)"; //      http://localhost:8000/index.php
}
?>