<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($product['name'] ?? '') ?></h1>

    <p><strong>ID</strong> : <?= (int)($product['id'] ?? 0) ?></p>
    <p><strong>Description</strong> : <?= htmlspecialchars((string)($product['description'] ?? '')) ?></p>
    <p><strong>Prix</strong> : <?= htmlspecialchars((string)($product['price'] ?? '')) ?> €</p>
    <p><strong>Stock</strong> : <?= htmlspecialchars((string)($product['stock'] ?? '')) ?></p>

    <p><a href="/produits">Retour au catalogue</a></p>
</body>
</html>
