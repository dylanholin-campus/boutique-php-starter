<?php
$product = [
    'name' => 'T-shirt',
    'description' => 'T-shirt en coton',
    'price' => 29.99,
    'stock' => 50,
    'category' => 'vetement',
    'brand' => 'test'
];

$product['dateAdded'] = date('d / m / Y');
$product['price'] = $product['price'] * 0.9;

//❓ Question : Que se passe-t-il si tu accèdes à une clé qui n'existe pas ?

// En PHP, si j'accèdes à une clé qui n’existe pas (ex: $product["color"]
// alors que color n’est pas dans le tableau),
// PHP renvoie null et déclenche en général un avertissement/notice du type “Undefined array key”

?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Fiche produit</title>
</head>

<body>
    <h1><?= $product['name'] ?></h1>
    <p><?= $product['description'] ?></p>
    <ul>
        <li>Prix : <?= $product['price'] ?> €</li>
        <li>Stock : <?= $product['stock'] ?></li>
        <li>Catégorie : <?= $product['category'] ?></li>
        <li>Marque : <?= $product['brand'] ?></li>
        <li>Ajouté le : <?= $product['dateAdded'] ?></li>
    </ul>
</body>

</html>