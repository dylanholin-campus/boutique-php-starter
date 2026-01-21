<?php

function formatPrice(float $amount, string $currency = '€', int $decimals = 2): string
{
    $formatted = number_format($amount, $decimals);
    return $formatted . $currency;
}

$message1 = formatPrice(99.999);
$message2 = formatPrice(99.999, '$');
$message3 = formatPrice(99.999, '€', 0);

echo "Le montant est $message1<br>";
echo "Le montant est $message2<br>";
echo "Le montant est $message3<br>";
