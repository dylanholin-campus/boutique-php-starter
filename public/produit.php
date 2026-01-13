<?php
// public/produit.php
require_once "../app/data.php";
require_once "../app/helpers.php";

// Récupération de l'ID depuis l'URL
$id = $_GET['id'] ?? null;
$product = null;

// Recherche du produit dans le tableau
if ($id) {
    foreach ($products as $p) {
        if ($p['id'] == $id) {
            $product = $p;
            break;
        }
    }
}

// Si produit non trouvé
if (!$product) {
    echo "<h1>Produit introuvable</h1><a href='catalogue.php'>Retour au catalogue</a>";
    exit;
}

// Données du produit trouvé
$name = $product['name'];
$description = $product['description'] ?? "Aucune description disponible.";
$priceHT = $product['price'];
$stock = $product['stock'];
$vatPercent = 20;

// Calculs
$priceTTC = calculateIncludingTax($priceHT, $vatPercent);
$vatAmount = calculateVAT($priceHT, $vatPercent);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($name) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">
    <div class="container" style="max-width: 720px;">
        <a href="catalogue.php" class="btn btn-link mb-3">&larr; Retour au catalogue</a>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <span class="badge bg-secondary mb-2"><?= ucfirst($product['category']) ?></span>
                <h1 class="h3 mb-2"><?= htmlspecialchars($name) ?></h1>
                <p class="text-secondary mb-4"><?= htmlspecialchars($description) ?></p>

                <div class="alert alert-light border">
                    <p class="mb-1">Prix HT : <?= number_format($priceHT, 2) ?> €</p>
                    <p class="mb-1">TVA (<?= $vatPercent ?>%) : <?= number_format($vatAmount, 2) ?> €</p>
                    <hr>
                    <p class="mb-0 fs-4">Prix TTC : <strong><?= number_format($priceTTC, 2) ?> €</strong></p>
                </div>

                <div class="mt-3">
                    <?= displayStock($stock) ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
