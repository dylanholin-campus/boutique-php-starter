<?php

// true si stock > 0
function isInStock(int $stock): bool
{
    return $stock > 0;
}

// true si discount > 0
function isOnSale(float $discount): bool
{
    return $discount > 0;
}

// true si ajouté il y a moins de 30 jours
function isNew(string $dateAdded): bool
{
    $daysSince = (time() - strtotime($dateAdded)) / 86400;
    echo "<br>$daysSince<br>";
    return $daysSince < 30 && $daysSince >= 0;
}

// true si stock >= quantity
function canOrder(int $stock, int $quantity): bool
{
    return $stock >= $quantity;
}

echo 'isInStock(0) = '  . (isInStock(0) ? 'true' : 'false') . '<br>';
echo 'isInStock(1) = '  . (isInStock(1) ? 'true' : 'false') . '<br>';
echo 'isInStock(10) = ' . (isInStock(10) ? 'true' : 'false') . '<br>';

echo 'isOnSale(0) = '    . (isOnSale(0) ? 'true' : 'false') . '<br>';
echo 'isOnSale(5) = '    . (isOnSale(5) ? 'true' : 'false') . '<br>';
echo 'isOnSale(20.5) = ' . (isOnSale(20.5) ? 'true' : 'false') . '<br>';

echo 'isNew(2024-01-15) = ' . (isNew('2026-01-08') ? 'true' : 'false') . '<br>';
echo 'isNew(today) = '      . (isNew(date('Y-m-d')) ? 'true' : 'false') . '<br>';

echo 'canOrder(3,1) = ' . (canOrder(3, 1) ? 'true' : 'false') . '<br>';
echo 'canOrder(3,3) = ' . (canOrder(3, 3) ? 'true' : 'false') . '<br>';
echo 'canOrder(3,4) = ' . (canOrder(3, 4) ? 'true' : 'false') . '<br>';
