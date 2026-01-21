<?php

$products = [
    ['name' => 'Pomme',      'price' => 0.60,  'stock' => 12],
    ['name' => 'Banane',     'price' => 0.80,  'stock' => 0],
    ['name' => 'Chocolat',   'price' => 2.50,  'stock' => 7],
    ['name' => 'Cerise',     'price' => 3.90,  'stock' => 0],
    ['name' => 'Lait',       'price' => 1.20,  'stock' => 5],
    ['name' => 'Café',       'price' => 6.50,  'stock' => 3],
    ['name' => 'RTX 5080',   'price' => 1299,  'stock' => 2],
    ['name' => 'Pâtes',      'price' => 1.10,  'stock' => 9],
    ['name' => 'Fromage',    'price' => 4.30,  'stock' => 2],
    ['name' => 'Casque',     'price' => 89.99, 'stock' => 1],
];

foreach ($products as $product) {
    if ($product['stock'] === 0) {
        continue;
    }

    if ($product['price'] > 100) {
        break;
    }

    echo htmlspecialchars($product['name']) .
        ' - prix ' . htmlspecialchars((string)$product['price']) . ' €' .
        ' - stock ' . htmlspecialchars((string)$product['stock']) .
        '<br>';
}
