<?php

$products = [
    [
        'name' => 'T-shirt',
        'price' => 29.99,
        'stock' => 50
    ],
    [
        'name' => 'Jean',
        'price' => 79.99,
        'stock' => 30
    ],
    [
        'name' => 'Casquette',
        'price' => 19.99,
        'stock' => 100
    ],
    [
        'name' => 'Pikachu',
        'price' => 1.99,
        'stock' => 1
    ],
    [
        'name' => 'Pull',
        'price' => 39.99,
        'stock' => 34
    ]
];

echo ' 3ieme name : ' . $products[2]['name'];
echo '<br>';
echo ' 1ieme prix : ' . $products[0]['price'];
echo '<br>';
echo ' stock de mon dernier article : ' . $products[4]['stock'];
echo '<br>';

$products[1]['stock'] += 10;

echo 'Stock du 2ème produit : ' . $products[1]['stock'];
