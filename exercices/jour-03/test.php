<?php

$products = [
    ['nom' => 'T-shirt', 'prix' => 29.99],
    ['nom' => 'Jean', 'prix' => 79.99],
    ['nom' => 'Casquette', 'prix' => 19.99]
];

foreach ($products as $product) {
    echo $product['nom'] . ' : ' . $product['prix'] . '€<br>';
}
