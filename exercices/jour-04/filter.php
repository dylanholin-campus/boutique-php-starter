<?php
$products = [
    ['name' => 'T-shirt', 'stock' => 50, 'price' => 29.99, 'category' => 'Vêtements'],
    ['name' => 'Jean', 'stock' => 30, 'price' => 59.99, 'category' => 'Vêtements'],
    ['name' => 'Casquette', 'stock' => 100, 'price' => 14.99, 'category' => 'Accessoires'],
    ['name' => 'Patate', 'stock' => 17, 'price' => 1.99, 'category' => 'Alimentation'],
    ['name' => 'Laptop', 'stock' => 5, 'price' => 999.99, 'category' => 'Électronique'],
    ['name' => 'Chaussettes', 'stock' => 0, 'price' => 5.00, 'category' => 'Vêtements'],
    ['name' => 'Souris Gamer', 'stock' => 12, 'price' => 45.00, 'category' => 'Électronique'],
    ['name' => 'Clavier', 'stock' => 8, 'price' => 120.00, 'category' => 'Électronique'],
    ['name' => 'Stylo', 'stock' => 200, 'price' => 2.50, 'category' => 'Bureautique'],
    ['name' => 'Lampe', 'stock' => 0, 'price' => 25.00, 'category' => 'Décoration']
];

$totalProduits = count($products);
$produitsTrouves = 0;

$filteredProducts = [];
foreach ($products as $product) {
    if ($product['stock'] > 0 && $product['price'] < 50) {
        $filteredProducts[] = $product;
    }
}
$produitsTrouves = count($filteredProducts);
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filtrer un catalogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light py-4">
    <div class="container" style="max-width: 720px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3 mb-4">Résultats de la recherche</h1>

                <div class="alert alert-info">
                    <strong><?= $produitsTrouves ?></strong> produits trouvés sur <strong><?= $totalProduits ?></strong>
                </div>
                <?php foreach ($filteredProducts as $product) : ?>
                    <div class="border-bottom pb-2 mb-2">
                        <p class="mb-1">Nom : <strong><?= $product['name'] ?></strong></p>
                        <p class="mb-1">Catégorie : <span class="badge text-bg-secondary"><?= $product['category'] ?></span></p>
                        <p class="mb-1">Prix : <strong class="text-success"><?= number_format($product['price'], 2, ',', ' ') ?> €</strong></p>
                        <p class="mb-0 text-muted small">En stock : <?= $product['stock'] ?> unités</p>
                    </div>
                <?php endforeach; ?>

                <?php if ($produitsTrouves === 0) : ?>
                    <p class="text-center text-muted">Aucun produit ne correspond à vos critères.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>