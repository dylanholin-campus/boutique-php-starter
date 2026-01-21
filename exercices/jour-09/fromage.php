<?php

class Category
{
    public $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }
}

class Product
{
    public $nom;
    public $prix;
    public $category;

    public function __construct($nom, $prix, $category)
    {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->category = $category;
    }
}

class quantity
{
    public $product;
    public $quantite;

    public function __construct($product, $quantite)
    {
        $this->product = $product;
        $this->quantite = max(0, (int)$quantite);
    }

    public function getTotal()
    {
        return $this->product->prix * $this->quantite;
    }

    public function incrementequantity($pas = 1)
    {
        $this->quantite += max(0, (int)$pas);
    }

    public function decrementequantity($pas = 1)
    {
        $this->quantite = max(0, $this->quantite - max(0, (int)$pas));
    }
}

class weight
{
    public $product;
    public $weight;

    public function __construct($product, $weight)
    {
        $this->product = $product;
        $this->weight = max(0, (float)$weight);
    }

    public function incrementeWeight($pas = 1)
    {
        $this->weight += max(0, (float)$pas);
    }

    public function decrementeWeight($pas = 1)
    {
        $this->weight = max(0, $this->weight - max(0, (float)$pas));
    }
}

$categorieFromages = new Category('Fromages');

$produitBrie = new Product('Brie', 3.50, $categorieFromages);
$produitComte = new Product('Comté', 4.20, $categorieFromages);
$produitRoquefort = new Product('Roquefort', 5.10, $categorieFromages);
$produitEmmental = new Product('Emmental', 2.10, $categorieFromages);

$quantityBrie = new quantity($produitBrie, 2);
$quantityComte = new quantity($produitComte, 1);
$quantityRoquefort = new quantity($produitRoquefort, 3);
$quantityEmmental = new quantity($produitEmmental, 245);

$weightBrie = new weight($produitBrie, 2.5);
$weightComte = new weight($produitComte, 1.5);
$weightRoquefort = new weight($produitRoquefort, 3);
$weightEmmental = new weight($produitEmmental, 5);

function afficherLigne($weightLocal, $quantityLocal)
{
    echo ' - ' . $weightLocal->weight . ' Kilo - '
        . $quantityLocal->product->nom . ' (' . $quantityLocal->product->category->nom . ') x' . $quantityLocal->quantite
        . ' = ' . number_format($quantityLocal->getTotal(), 2) . ' €<br>';
}

afficherLigne($weightBrie, $quantityBrie);
afficherLigne($weightComte, $quantityComte);
afficherLigne($weightRoquefort, $quantityRoquefort);
afficherLigne($weightEmmental, $quantityEmmental);
echo '<br>';


$quantityComte->incrementequantity(2);
$quantityRoquefort->decrementequantity(1);
$weightEmmental->decrementeweight(2.5);

echo 'Après modification :<br>';
echo $quantityComte->product->nom . ' x' . $quantityComte->quantite . ' = ' . number_format($quantityComte->getTotal(), 2) . ' €<br>';
echo $quantityRoquefort->product->nom . ' x' . $quantityRoquefort->quantite . ' = ' . number_format($quantityRoquefort->getTotal(), 2) . ' €<br>';
echo ' Nouveau poids de ' . $quantityEmmental->product->nom . ' - ' . $weightEmmental->weight . ' Kilo - <br>';
