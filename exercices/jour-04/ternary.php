<?php
$datedujour = date('Ymd');

$products = [
    [
        'name' => 'T-shirt',
        'active' => true,
        'stock' => 50,
        'prix' => 29.99,
        'promoEndDate' => '20260131'
    ],
    [
        'name' => 'Jean',
        'active' => false,
        'stock' => 30,
        'prix' => 59.99,
        'promoEndDate' => '20260101'
    ],
    [
        'name' => 'Casquette',
        'active' => true,
        'stock' => 100,
        'prix' => 14.99,
        'promoEndDate' => '20250719'
    ],
    [
        'name' => 'Patate',
        'active' => false,
        'stock' => 17,
        'prix' => 1.99,
        'promoEndDate' => '20260110'
    ]
];

if ($products[0]['stock'] > 0 && $products[0]['active'] === true) {
    $resultdispo0 = 'disponible';
} else {
    $resultdispo0 = 'indisponible';
}
if ($products[0]['promoEndDate'] > $datedujour) {
    $resultpromo0 = '🔥 PROMO';
} else {
    $resultpromo0 = 'PAS DE PROMO';
}
if ($products[0]['promoEndDate'] > $datedujour) {
    $newprice00 = $products[0]['prix'] * 0.8;
    $newprice0 = number_format($newprice00, 2, ',', ' ');
}



if ($products[1]['stock'] > 0 && $products[1]['active'] === true) {
    $resultdispo1 = 'disponible';
} else {
    $resultdispo1 = 'indisponible';
}
if ($products[1]['promoEndDate'] > $datedujour) {
    $resultpromo1 = '🔥 PROMO';
} else {
    $resultpromo1 = 'PAS DE PROMO';
}
if ($products[1]['promoEndDate'] > $datedujour) {
    $newprice11 = $products[1]['prix'] * 0.8;
    $newprice1 = number_format($newprice11, 2, ',', ' ');
}



if ($products[2]['stock'] > 0 && $products[2]['active'] === true) {
    $resultdispo2 = 'disponible';
} else {
    $resultdispo2 = 'indisponible';
}
if ($products[2]['promoEndDate'] > $datedujour) {
    $resultpromo2 = '🔥 PROMO';
} else {
    $resultpromo2 = 'PAS DE PROMO';
}
if ($products[2]['promoEndDate'] > $datedujour) {
    $newprice22 = $products[2]['prix'] * 0.8;
    $newprice2 = number_format($newprice22, 2, ',', ' ');
}



if ($products[3]['stock'] > 0 && $products[3]['active'] === true) {
    $resultdispo3 = 'disponible';
} else {
    $resultdispo3 = 'indisponible';
}
if ($products[3]['promoEndDate'] > $datedujour) {
    $resultpromo3 = '🔥 PROMO';
} else {
    $resultpromo3 = 'PAS DE PROMO';
}
if ($products[3]['promoEndDate'] > $datedujour) {
    $newprice33 = $products[3]['prix'] * 0.8;
    $newprice3 = number_format($newprice33, 2, ',', ' ');
}



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

                <p class="mb-1">Nom du produit : <strong><?= $products[0]['name'] ?></strong></p>
                <p class="mb-1">le produit est : <strong><?= $resultdispo0 ?></strong></p>
                <p class="mb-1">Il y a une promo ? : <strong><?= $resultpromo0 ?></strong></p>
                <p class="mb-1">Prix :
                    <?php if ($products[0]['promoEndDate'] > $datedujour) : ?>
                        <span class="text-decoration-line-through text-muted"><?= $products[0]['prix'] ?> €</span>
                        <strong><?= $newprice0 ?> €</strong>
                    <?php else : ?>
                        <strong><?= $products[0]['prix'] ?> €</strong>
                    <?php endif; ?>
                </p>

                <br>
                <p class="mb-1">Nom du produit : <strong><?= $products[1]['name'] ?></strong></p>
                <p class="mb-1">le produit est : <strong><?= $resultdispo1 ?></strong></p>
                <p class="mb-1">Il y a une promo ? : <strong><?= $resultpromo1 ?></strong></p>
                <p class="mb-1">Prix :
                    <?php if ($products[1]['promoEndDate'] > $datedujour) : ?>
                        <span class="text-decoration-line-through text-muted"><?= $products[1]['prix'] ?> €</span>
                        <strong><?= $newprice1 ?> €</strong>
                    <?php else : ?>
                        <strong><?= $products[1]['prix'] ?> €</strong>
                    <?php endif; ?>
                </p>

                <br>
                <p class="mb-1">Nom du produit : <strong><?= $products[2]['name'] ?></strong></p>
                <p class="mb-1">le produit est : <strong><?= $resultdispo2 ?></strong></p>
                <p class="mb-1">Il y a une promo ? : <strong><?= $resultpromo2 ?></strong></p>
                <p class="mb-1">Prix :
                    <?php if ($products[2]['promoEndDate'] > $datedujour) : ?>
                        <span class="text-decoration-line-through text-muted"><?= $products[2]['prix'] ?> €</span>
                        <strong><?= $newprice2 ?> €</strong>
                    <?php else : ?>
                        <strong><?= $products[2]['prix'] ?> €</strong>
                    <?php endif; ?>
                </p>

                <br>
                <p class="mb-1">Nom du produit : <strong><?= $products[3]['name'] ?></strong></p>
                <p class="mb-1">le produit est : <strong><?= $resultdispo3 ?></strong></p>
                <p class="mb-1">Il y a une promo ? : <strong><?= $resultpromo3 ?></strong></p>
                <p class="mb-1">Prix :
                    <?php if ($products[3]['promoEndDate'] > $datedujour) : ?>
                        <span class="text-decoration-line-through text-muted"><?= $products[3]['prix'] ?> €</span>
                        <strong><?= $newprice3 ?> €</strong>
                    <?php else : ?>
                        <strong><?= $products[3]['prix'] ?> €</strong>
                    <?php endif; ?>
                </p>

                <span class="badge rounded-pill <?= $badgeClass ?>">
                    <?= $badgeText ?>
                </span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>