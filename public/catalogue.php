<?php
// public/catalogue.php
require_once "../app/data.php";
require_once "../app/helpers.php";

$tva = 20.0;

// Logique de filtrage
$filteredProducts = $products;

// 1. Recherche par mot-clé
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $search = strtolower(trim($_GET['q']));
    $filteredProducts = array_filter($filteredProducts, function ($p) use ($search) {
        return str_contains(strtolower($p['name']), $search);
    });
}

// 2. Filtre par catégorie
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $cat = $_GET['category'];
    $filteredProducts = array_filter($filteredProducts, function ($p) use ($cat) {
        return $p['category'] === $cat;
    });
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Catalogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .produit { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
    </style>
</head>
<body class="container py-4">
    <h1>Notre Catalogue</h1>

    <!-- Barre de recherche et Filtres -->
    <div class="row mb-4 align-items-end">
        <div class="col-md-6">
            <form action="catalogue.php" method="GET" class="d-flex gap-2">
                <input type="text" name="q" class="form-control" placeholder="Rechercher un produit..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>
        <div class="col-md-6">
            <a href="catalogue.php" class="btn btn-outline-secondary">Tout</a>
            <a href="catalogue.php?category=vetements" class="btn btn-outline-secondary">Vêtements</a>
            <a href="catalogue.php?category=accessoires" class="btn btn-outline-secondary">Accessoires</a>
        </div>
    </div>

    <!-- Liste des produits -->
    <div class="row">
        <?php if (empty($filteredProducts)): ?>
            <div class="alert alert-warning">Aucun produit trouvé.</div>
        <?php else: ?>
            <?php foreach ($filteredProducts as $product): 
                $priceHT = $product["price"];
                $prixTTC = calculateIncludingTax($priceHT, $tva);
            ?>
                <div class="col-md-4">
                    <div class="produit h-100 d-flex flex-column">
                        <h2><?= htmlspecialchars($product["name"]) ?></h2>
                        <p>Prix TTC : <strong><?= number_format($prixTTC, 2) ?> €</strong></p>
                        <p>Stock : <?= displayStock($product["stock"]) ?></p>
                        
                        <div class="mt-auto">
                            <a href="produit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-dark w-100">Voir détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
