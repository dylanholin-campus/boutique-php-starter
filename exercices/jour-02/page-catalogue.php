<?php
$products = [
    ['name' => 'T-shirt',    'price' => 29.99, 'stock' => 50],
    ['name' => 'Jean',       'price' => 79.99, 'stock' => 30],
    ['name' => 'Pull',       'price' => 39.99, 'stock' => 12],
    ['name' => 'Casquette',  'price' => 19.99, 'stock' => 100],
    ['name' => 'Ceinture',   'price' => 24.99, 'stock' => 18],
    ['name' => 'Lunettes',   'price' => 59.99, 'stock' => 7],
];
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Catalogue</title>
</head>

<body>

    <div>
        <h2><?= $products[0]['name'] ?></h2>
        <p><?= $products[0]['price'] ?> €</p>
        <p>Stock : <?= $products[0]['stock'] ?></p>
    </div>

    <div>
        <h2><?= $products[1]['name'] ?></h2>
        <p><?= $products[1]['price'] ?> €</p>
        <p>Stock : <?= $products[1]['stock'] ?></p>
    </div>

    <div>
        <h2><?= $products[2]['name'] ?></h2>
        <p><?= $products[2]['price'] ?> €</p>
        <p>Stock : <?= $products[2]['stock'] ?></p>
    </div>

    <div>
        <h2><?= $products[3]['name'] ?></h2>
        <p><?= $products[3]['price'] ?> €</p>
        <p>Stock : <?= $products[3]['stock'] ?></p>
    </div>

    <div>
        <h2><?= $products[4]['name'] ?></h2>
        <p><?= $products[4]['price'] ?> €</p>
        <p>Stock : <?= $products[4]['stock'] ?></p>
    </div>

    <div>
        <h2><?= $products[5]['name'] ?></h2>
        <p><?= $products[5]['price'] ?> €</p>
        <p>Stock : <?= $products[5]['stock'] ?></p>
    </div>

</body>

</html>