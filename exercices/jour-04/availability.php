<?php

$datedujour = date('Ymd');

$products = [
    [
        'name' => 'T-shirt',
        'active' => true,
        'stock' => 50,
        'promoEndDate' => '20260131'
    ],
    [
        'name' => 'Jean',
        'active' => false,
        'stock' => 30,
        'promoEndDate' => '20260101'
    ],
    [
        'name' => 'Casquette',
        'active' => true,
        'stock' => 100,
        'promoEndDate' => '20250719'
    ],
    [
        'name' => 'Patate',
        'active' => false,
        'stock' => 17,
        'promoEndDate' => '20260106'
    ]
];

if ($products[0]['stock'] > 0 && $products[0]['active'] === true) {
    echo '<br>le produit ' . $products[0]['name'] . ' est disponible';
} else {
    echo '<br>le produit ' . $products[0]['name'] . ' est indisponible';
}

if ($products[0]['promoEndDate'] > $datedujour) {
    echo '<br>le produit ' . $products[0]['name'] . ' a encore une promo active';
} else {
    echo '<br>le produit ' . $products[0]['name'] . " n'a pas de promo active";
}
echo '<br>';

if ($products[1]['stock'] > 0 && $products[1]['active'] === true) {
    echo '<br>le produit ' . $products[1]['name'] . ' est disponible';
} else {
    echo '<br>le produit ' . $products[1]['name'] . ' est indisponible';
}

if ($products[1]['promoEndDate'] >= $datedujour) {
    echo '<br>le produit ' . $products[1]['name'] . ' a encore une promo active';
} else {
    echo '<br>le produit ' . $products[1]['name'] . " n'a pas de promo active";
}
echo '<br>';

if ($products[2]['stock'] > 0 && $products[2]['active'] === true) {
    echo '<br>le produit ' . $products[2]['name'] . ' est disponible';
} else {
    echo '<br>le produit ' . $products[2]['name'] . ' est indisponible';
}

if ($products[2]['promoEndDate'] >= $datedujour) {
    echo '<br>le produit ' . $products[2]['name'] . ' a encore une promo active';
} else {
    echo '<br>le produit ' . $products[2]['name'] . " n'a pas de promo active";
}
echo '<br>';

if ($products[3]['stock'] > 0 && $products[3]['active'] === true) {
    echo '<br>le produit ' . $products[3]['name'] . ' est disponible';
} else {
    echo '<br>le produit ' . $products[3]['name'] . ' est indisponible';
}

if ($products[3]['promoEndDate'] >= $datedujour) {
    echo '<br>le produit ' . $products[3]['name'] . ' a encore une promo active';
} else {
    echo '<br>le produit ' . $products[3]['name'] . " n'a pas de promo active";
}
echo '<br>';
echo "<br>date du jour $datedujour";
