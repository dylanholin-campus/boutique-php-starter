<?php

class Product
{
    public $id;
    public $nom;
    public $description;
    public $prix;
    public $stock;
    public $categorie;

    public function __construct($id, $nom, $description, $prix, $stock, $categorie)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->categorie = $categorie;
    }

    public function getPriceIncludingTax($vat = 20)
    {
        return $this->prix * (1 + $vat / 100);
    }

    public function isInStock()
    {
        return $this->stock > 0;
    }

    public function reduceStock($quantity)
    {
        if ($quantity <= $this->stock) {
            $this->stock -= $quantity;
            return true;
        }
        return false;
    }

    public function applyDiscount($percentage)
    {
        $this->prix *= (1 - $percentage / 100);
    }
}
