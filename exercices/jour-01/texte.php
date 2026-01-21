<?php

$brand = 'Nike';
$model = 'Air Max';

// 1) Concaténation (.)
echo 'Chaussures ' . $brand . ' ' . $model;

// 2) Interpolation ("...")
echo "Chaussures $brand $model";

// 3) sprintf()
echo sprintf('Chaussures %s %s', $brand, $model);

$price = 99.99;
echo "Prix : $price €";  // Que s'affiche-t-il ? Affiche : Prix : 99.99 €
echo 'Prix : $price €';  // Et là ? Affiche : Prix : $price €
