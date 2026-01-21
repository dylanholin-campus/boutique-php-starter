<?php

class Product
{
    private string $name;
    private float $price;
    private int $stock;

    public function __construct(string $name, float $price, int $stock)
    {
        $this->name  = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getInfo(): string
    {
        return "{$this->name} - {$this->price}€ x {$this->stock}";
    }

    public function getTotal(): float
    {
        return $this->price * $this->stock;
    }

    public function getStock(): int
    {
        return $this->stock;
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
    echo "<br>{$product->getInfo()} = {$product->getTotal()}€";

    $totalStock += $product->getStock();
    $totalValue += $product->getTotal();
}


echo '<br><br>--- RÉSUMÉ ---<br>';
echo "<br>Stock total: {$totalStock} unités<br>";
echo "<br>Valeur totale du catalogue: {$totalValue}€<br>";
