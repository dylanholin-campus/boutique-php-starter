<?php

class Product
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

class Cart
{
    private array $items = [];

    public function add(Product $product, int $qty = 1): self
    {
        if (isset($this->items[$product->id])) {
            $this->items[$product->id]['qty'] += $qty;
        } else {
            $this->items[$product->id] = ['product' => $product, 'qty' => $qty];
        }
        return $this; // permet le chaînage
    }

    public function remove(int $productId): self
    {
        unset($this->items[$productId]);
        return $this; // permet le chaînage
    }

    public function items(): array
    {
        return $this->items;
    }

    public function dump(): self
    {
        echo '<pre>';
        print_r($this->items); // affiche le tableau
        echo '</pre>';
        return $this; // optionnel, mais pratique pour chaîner ->dump()
    }
}

$product1 = new Product(1, 'Chaise');
$product2 = new Product(2, 'Table');

$cart = new Cart();

echo '<h3>État initial</h3>';
$cart->dump();

echo '<h3>Après chaînage</h3>';
$cart->add($product1)
     ->add($product2, 3)
     ->remove(1)
     ->dump();
