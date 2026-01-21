<?php
class Product
{
    private $id;
    private $nom;
    private $description;
    private $prix;
    private $stock;
    private $categorie;

    public function __construct($id, $nom, $description, $prix, $stock, $categorie)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->categorie = $categorie;
    }

    public function getPriceIncludingTax(float $vat = 20): float
    {
        return $this->prix * (1 + $vat / 100);
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function reduceStock(int $quantity): void
    {
        if ($quantity > 0 && $quantity <= $this->stock) {
            $this->stock -= $quantity;
        }
    }

    public function applyDiscount(float $percentage): void
    {
        if ($percentage > 0 && $percentage <= 100) {
            $this->prix *= (1 - $percentage / 100);
        }
    }
}
?>



