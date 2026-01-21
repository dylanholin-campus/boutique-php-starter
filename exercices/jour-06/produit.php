<?php

$products = [
    1 => ['name' => 'T-shirt', 'price' => 29.99],
    2 => ['name' => 'Jean', 'price' => 79.99],
    3 => ['name' => 'Baskets', 'price' => 89.90],
    4 => ['name' => 'Casquette', 'price' => 15.00],
    5 => ['name' => 'Sac à dos', 'price' => 45.50]
];

$id = $_GET['id'] ?? null;

if ($id && array_key_exists($id, $products)) {
    $product = $products[$id];
    echo '<h1>Produit : ' . htmlspecialchars($product['name']) . '</h1>';
    echo '<p>Prix : ' . htmlspecialchars($product['price']) . ' €</p>';
} else {
    echo '<h1>Produit non trouvé</h1>';
}

// je test avec http://localhost:8000/exercices/jour-06/produit.php?id=4 pour voir l'ID 4 donc la casquette
