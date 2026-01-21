<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($title) ?></h1>

    <?php if (empty($products)): ?>
        <p>Aucun produit.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($products as $p): ?>
                <li>
                    <a href="/produit?id=<?= (int) $p['id'] ?>">
                        <?= htmlspecialchars($p['name'] ?? '') ?>
                    </a>
                    — <?= htmlspecialchars((string)($p['price'] ?? '')) ?> €
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="/">Retour accueil</a></p>
</body>
</html>
