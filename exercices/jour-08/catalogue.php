<?php

class Product
{
    public $name;
    public $price;
    public $stock;

    public function __construct(string $name, $price, $stock)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }
}

$products = [
    new Product('Laptop', 999.99, 5),
    new Product('Mouse', 25.50, 15),
    new Product('Keyboard', 79.99, 8),
    new Product('Monitor', 299.99, 3),
    new Product('Headphones', 149.99, 12)
];

$totalStock = 0;
$totalValue = 0;

foreach ($products as $product) {
    echo "<br>{$product->name} - {$product->price}€ x {$product->stock} = " . ($product->price * $product->stock) . "€\n";
    $totalStock += $product->stock;
    $totalValue += $product->price * $product->stock;
}

echo '<br><br>--- RÉSUMÉ ---<br>';
echo "<br>Stock total: {$totalStock} unités<br>";
echo "<br>Valeur totale du catalogue: {$totalValue}€<br>";
