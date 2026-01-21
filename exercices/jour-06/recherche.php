<?php
$products = [
    ['name' => 'T-shirt blanc', 'price' => 15],
    ['name' => 'Jean bleu', 'price' => 50],
    ['name' => 'Baskets noires', 'price' => 80],
    ['name' => 'Casquette rouge', 'price' => 20],
    ['name' => 'Sac à dos', 'price' => 45],
    ['name' => 'Écharpe laine', 'price' => 25],
    ['name' => 'Montre sport', 'price' => 120],
    ['name' => 'Lunettes soleil', 'price' => 90],
    ['name' => 'Ceinture cuir', 'price' => 35],
    ['name' => 'Chaussettes', 'price' => 8]
];

$search = $_GET['search'] ?? '';
$results = [];
$resultsprice = [];

if ($search) {
    foreach ($products as $product1) {
        // !== false permet de ne pas confondre la position 0 (début du mot) avec false (pas trouvé).
        if (stripos($product1['name'], $search) !== false) {
            $results[] = $product1;
        }
    }
} else {
    $results = $products;     // ici j'affiche tout les produits de mon tableau par défaut, un peu comme un catalogue
}
?>
<form method="GET">
    Recherche : <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Rechercher</button>
</form>

<hr>

<?php if (empty($results)): ?>
    <p>Aucun résultat.</p>
<?php else: ?>
    <ul>
        <?php foreach ($results as $item): ?>
            <li>
                <?php echo htmlspecialchars($item['name']); ?>
                - <?php echo $item['price']; ?> €
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>