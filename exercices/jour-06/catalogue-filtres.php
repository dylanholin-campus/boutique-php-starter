<?php
$products = [
    ['name' => 'Pikachu',    'price' => 10, 'category' => 'Électrik', 'inStock' => true],
    ['name' => 'Bulbizarre', 'price' => 15, 'category' => 'Plante',   'inStock' => false],
    ['name' => 'Salamèche',  'price' => 20, 'category' => 'Feu',      'inStock' => true],
    ['name' => 'Carapuce',   'price' => 12, 'category' => 'Eau',      'inStock' => true],
    ['name' => 'Rondoudou',  'price' => 8,  'category' => 'Normal',   'inStock' => true],
    ['name' => 'Miaouss',    'price' => 14, 'category' => 'Normal',   'inStock' => false],
    ['name' => 'Psykokwak',  'price' => 11, 'category' => 'Eau',      'inStock' => true],
    ['name' => 'Ronflex',    'price' => 25, 'category' => 'Normal',   'inStock' => true],
    ['name' => 'Évoli',      'price' => 18, 'category' => 'Normal',   'inStock' => true],
    ['name' => 'Mewtwo',     'price' => 50, 'category' => 'Psy',      'inStock' => false],
    ['name' => 'Ectoplasma', 'price' => 22, 'category' => 'Spectre',  'inStock' => false],
    ['name' => 'Onix',       'price' => 16, 'category' => 'Roche',    'inStock' => true],
    ['name' => 'Magicarpe',  'price' => 5,  'category' => 'Eau',      'inStock' => true],
    ['name' => 'Lokhlass',   'price' => 30, 'category' => 'Eau',      'inStock' => false],
    ['name' => 'Métamorph',  'price' => 9,  'category' => 'Normal',   'inStock' => true],
];

$nameFilter = $_GET['name'] ?? '';
$catFilter = $_GET['category'] ?? '';
$priceFilter = $_GET['price'] ?? '';
$stockOnly = isset($_GET['stock']);

$results = [];

foreach ($products as $p) {     // Filtre

    if ($nameFilter && stripos($p['name'], $nameFilter) === false) {
        continue;
    }

    if ($catFilter && $p['category'] !== $catFilter) {
        continue;
    }

    if ($priceFilter && $p['price'] > $priceFilter) {
        continue;
    }

    if ($stockOnly && !$p['inStock']) {
        continue;
    } // Filtre Stock (Si coché et que le produit n'est PAS en stock -> on passe)

    $results[] = $p;
}

$categories = array_unique(array_column($products, 'category'));
sort($categories);
?>

<!DOCTYPE html>
<html lang="fr">

<body>

    <form method="GET">
        <input type="text" name="name" placeholder="Nom..." value="<?= htmlspecialchars($nameFilter) ?>">
        <select name="category">
            <option value="">Toutes catégories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat ?>" <?= $cat === $catFilter ? 'selected' : '' ?>>
                    <?= $cat ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="number" name="price" placeholder="Afficher prix inferieur" value="<?= htmlspecialchars($priceFilter) ?>">

        <label>
            <input type="checkbox" name="stock" <?= $stockOnly ? 'checked' : '' ?>>
            En stock uniquement
        </label>

        <button type="submit">Filtrer</button>
    </form>

    <hr>
    <?php if (empty($results)): ?>
        <p>Aucun résultat.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($results as $item): ?>
                <li>
                    <strong><?= htmlspecialchars($item['name']) ?></strong>
                    (<?= $item['category'] ?>) - <?= $item['price'] ?> €
                    <?= $item['inStock'] ? '<span style="color:green">[En stock]</span>' : '<span style="color:red">[Rupture]</span>' ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>

</html>