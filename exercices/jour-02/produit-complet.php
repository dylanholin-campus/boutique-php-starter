<?php

$product = [
    'name' => 'T-shirt',
    'description' => 'T-shirt en coton',
    'price' => 29.99,

    'images' => [
        'https://parcsaintecroix.com/wp-content/uploads/2024/06/cp-e-wittwer-6-2-500x500-ad0950baee13.png',
        'https://parcsaintecroix.com/wp-content/uploads/2022/09/IMG_8245-bao-scaled-500x500-ad0950baee13.jpg',
        'https://www.lepal.com/uploads/media/default/0001/19/27b2fb71e5f6493f427da6ff7af09f1c34e215a4.jpg',
    ],

    'sizes' => ['S', 'M', 'L', 'XL'],

    'reviews' => [
        ['author' => 'Ayoub', 'rating' => 5, 'comment' => 'Très bon produit'],
        ['author' => 'CapitainCSS', 'rating' => 4, 'comment' => 'Bonne qualité'],
    ],
];

echo '<img src="' . $product['images'][1] . '" alt="Deuxième image" width="250">';
echo '<br>';

echo 'Nombre de tailles : ' . count($product['sizes']);
echo '<br>';

echo 'Note du premier avis : ' . $product['reviews'][0]['rating'];
echo '<br>';
