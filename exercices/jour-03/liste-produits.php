<?php
$products = [
    [
        'name' => 'Pomme',
        'price' => 0.60,
        'stock' => 42,
    ],
    [
        'name' => 'Banane',
        'price' => 0.80,
        'stock' => 18,
    ],
    [
        'name' => 'Chocolat',
        'price' => 2.50,
        'stock' => 7,
    ],
    [
        'name' => 'Cerise',
        'price' => 3.90,
        'stock' => 0,
    ],
    [
        'name' => 'RTX 5080',
        'price' => 1299.00,
        'stock' => 2,
    ],
];
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Catalogue</title>
</head>

<body>
    <?php foreach ($products as $product): ?>
        <article>
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p>Prix : <?= htmlspecialchars((string)$product['price']) ?> €</p>
            <p>Stock : <?= htmlspecialchars((string)$product['stock']) ?></p>
        </article>
        <br>
    <?php endforeach; ?>
</body>

</html>