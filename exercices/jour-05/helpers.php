<?php

declare(strict_types=1);

/*
Greetings
*/
function greet(): void
{
    echo 'Bienvenue sur la boutique !';
}

function greetClient(string $name): void
{
    echo 'Bonjour ' . htmlspecialchars($name) . ' !';
}

/*
Calculs (return)
*/
function calculateVAT(float $priceExcludingTax, float $rate): float
{
    return $priceExcludingTax * ($rate / 100);
}

function calculateIncludingTax(float $priceExcludingTax, float $rate): float
{
    return $priceExcludingTax + calculateVAT($priceExcludingTax, $rate);
}

function calculateDiscount(float $price, float $percentage): float
{
    return $price * (1 - $percentage / 100);
}

/*
Format prix
*/
function formatPrice(float $amount, string $currency = '€', int $decimals = 2): string
{
    return number_format($amount, $decimals) . ' ' . $currency;
}

/*
Check
*/
function isInStock(int $stock): bool
{
    return $stock > 0;
}

function isOnSale(float $discount): bool
{
    return $discount > 0;
}

function isNew(string $dateAdded, int $days = 30): bool
{
    $daysSince = (time() - strtotime($dateAdded)) / 86400;
    return $daysSince < $days;
}

function canOrder(int $stock, int $quantity): bool
{
    return $stock >= $quantity;
}

/*
Affichage HTML
*/
function displayBadge(string $text, string $color): string
{
    return '<span class="badge" style="background:' . htmlspecialchars($color) . ';">'
        . htmlspecialchars($text)
        . '</span>';
}

function displayPrice(float $price, float $discount = 0, string $currency = '€'): string
{
    $formattedPrice = formatPrice($price, $currency, 2);

    if ($discount > 0) {
        $newPrice = calculateDiscount($price, $discount);
        $formattedNew = formatPrice($newPrice, $currency, 2);

        return '<span style="text-decoration: line-through; color:#6c757d;">' . $formattedPrice . '</span> '
            . '<strong style="color:#e74c3c;">' . $formattedNew . '</strong>';
    }

    return '<strong>' . $formattedPrice . '</strong>';
}


function displayStock(int $quantity): string
{
    if ($quantity <= 0) {
        return '<span style="color:#e74c3c;">Rupture de stock</span>';
    }

    if ($quantity <= 5) {
        return '<span style="color:#f39c12;">Stock faible (' . $quantity . ')</span>';
    }

    return '<span style="color:#27ae60;">En stock (' . $quantity . ')</span>';
}
