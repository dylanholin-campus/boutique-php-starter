<?php

$priceExcludingTax = 100;
$vat = 20;      // en %
$quantity = 3;

$vatAmount = $priceExcludingTax * ($vat / 100);
$priceIncludingTax = $priceExcludingTax * (1 + ($vat / 100));
$total = $priceIncludingTax * $quantity;

echo "Montant TVA : $vatAmount €\n";
echo "Prix TTC unitaire : $priceIncludingTax €\n";
echo "Total pour $quantity : $total €\n";
