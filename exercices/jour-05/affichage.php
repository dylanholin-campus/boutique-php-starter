<?php
function displayBadge(string $text, string $color): string
{
    return '<span class="badge" style="background: ' . $color . ';">' . $text . '</span>';
}

function displayPrice(float $price, float $discount = 0, string $currency = '€'): string
{
    $formattedPrice = number_format($price, 2);
    if ($discount > 0) {
        $newPrice = $price * (1 - $discount / 100);
        $formattedNew = number_format($newPrice, 2);
        return '<span class="text-decoration-line-through text-muted">' . $formattedPrice . ' ' . $currency . '</span> '
            . '<strong style="color:#e74c3c;">' . $formattedNew . ' ' . $currency . '</strong>';
    }
    return '<strong>' . $formattedPrice . ' ' . $currency . '</strong>';
}

function displayStock(int $quantity): string
{
    if ($quantity === 0) {
        return '<span style="color:red;">Rupture</span>';
    }
    if ($quantity < 5) {
        return '<span style="color:orange;">Stock limité (' . $quantity . ')</span>';
    }
    return '<span style="color:green;">En stock</span>';
}

// Exemple produit
$product = [
    'name' => 'T-shirt',
    'stock' => 10,
    'price' => 29.99,
    'discount' => 20
];
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($product['name']) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>
    <h1><?= htmlspecialchars($product['name']) ?></h1>

    <p>Prix : <?= displayPrice($product['price'], $product['discount']) ?></p>
    <p>Stock : <?= displayStock($product['stock']) ?></p>

    <p><?= displayBadge('Je sais pas quoi mettre ici', '#3498db') ?></p>
</body>

</html>