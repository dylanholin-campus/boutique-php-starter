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
                    <a href="/produits/<?= (int) $p['id'] ?>">
                        <?= htmlspecialchars($p['name'] ?? '') ?>
                    </a>
                    — <?= htmlspecialchars((string)($p['price'] ?? '')) ?> €
                </li>
                <form method="POST" action="/panier/ajouter">
    <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">

    <label>
        Quantité :
        <input type="number" name="qty" value="1" min="1">
    </label>

    <button type="submit">Ajouter au panier</button>
</form>
<p><a href="/panier">Voir le panier</a></p>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="/">Retour accueil</a></p>
</body>

</html>