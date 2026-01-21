<?php

function calculateVAT(float $priceExcludingTax, float $rate)
{
    return $priceExcludingTax * $rate;
}

function calculateIncludingTax(float $priceExcludingTax, float $rate)
{
    return $priceExcludingTax + $rate;
}

function calculateDiscount(float $price, float $percentage)
{
    return $price * $percentage;
}

$produit = 100;
$tva = 0.2;
$remise = 0.9;


$message = calculateVAT($produit, $tva);
$message2 = calculateIncludingTax($produit, $message);
$message3 = calculateDiscount($message2, $remise);
echo 'le montant de la TVA pour' . $produit . "€ est $message €<br>";
echo 'le montant TTC pour' . $produit . "€ est $message2 €<br>";
echo 'le montant apres remise pour' . $message2 . "€ est $message3 €<br>";
