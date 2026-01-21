<?php
// Variables produit
$name = 'Chaussures Nike Air Max';
$description = 'Chaussures confortables pour un usage quotidien.';
$priceExcludingTax = 99.99; // HT
$vatPercent = 20;           // TVA en %
$stock = 3;

// Calculs
$vatRate = $vatPercent / 100;               // 20 -> 0.20
$vatAmount = $priceExcludingTax * $vatRate; // TVA sur 1 unité
$priceTTC = $priceExcludingTax + $vatAmount;

// Formatage (2 décimales)
$priceHTFormatted = number_format($priceExcludingTax, 2, '.', '');
$priceTTCFormatted = number_format($priceTTC, 2, '.', '');
$vatAmountFormatted = number_format($vatAmount, 2, '.', '');

// Badge Bootstrap (simple)
$badgeClass = ($stock > 0) ? 'text-bg-success' : 'text-bg-danger';
$badgeText  = ($stock > 0) ? "En stock ($stock)" : 'Rupture de stock';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $name ?></title>

    <!-- Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light py-4">
    <div class="container" style="max-width: 720px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3 mb-2"><?= $name ?></h1>
                <p class="text-secondary mb-4"><?= $description ?></p>

                <p class="mb-1">Prix HT : <strong><?= $priceHTFormatted ?> €</strong></p>
                <p class="mb-1">TVA (<?= $vatPercent ?>%) : <?= $vatAmountFormatted ?> €</p>
                <p class="mb-3">Prix TTC : <strong><?= $priceTTCFormatted ?> €</strong></p>

                <span class="badge rounded-pill <?= $badgeClass ?>">
                    <?= $badgeText ?>
                </span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>