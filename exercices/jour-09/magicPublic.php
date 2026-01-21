<?php

class Category
{
    public string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }
}

class Product
{
    public string $nom;
    public float $prix;
    public Category $category;

    public function __construct(string $nom, float $prix, Category $category)
    {
        $this->nom = $nom;
        $this->prix = (float) $prix;
        $this->category = $category;
    }
}

class CartItem
{
    public Product $product;
    public int $quantite;

    public function __construct(Product $product, int $quantite)
    {
        $this->product = $product;
        $this->quantite = max(0, (int) $quantite);
    }

    public function getTotal(): float
    {
        return $this->product->prix * $this->quantite;
    }
}

class Cart
{
    public array $items = [];

    public function add(Product $product, int $quantite = 1): void
    {
        $nomProduit = $product->nom;
        $quantite = max(0, (int) $quantite);
        if ($quantite === 0) {
            return;
        }

        if (isset($this->items[$nomProduit])) {
            $this->items[$nomProduit]->quantite += $quantite;
        } else {
            $this->items[$nomProduit] = new CartItem($product, $quantite);
        }
    }

    public function remove(string $nomProduit): void
    {
        if (isset($this->items[$nomProduit])) {
            unset($this->items[$nomProduit]);
        }
    }

    public function update(string $nomProduit, int $nouvelleQuantite): void
    {
        $nouvelleQuantite = max(0, (int) $nouvelleQuantite);
        if (!isset($this->items[$nomProduit])) {
            return;
        }

        if ($nouvelleQuantite === 0) {
            $this->remove($nomProduit);
            return;
        }

        $this->items[$nomProduit]->quantite = $nouvelleQuantite;
    }

    public function getTotal(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function clear(): void
    {
        $this->items = [];
    }
}

function afficherPanier(Cart $panier, string $titre): void
{
    echo '<strong>' . $titre . '</strong><br>';
    echo "Nombre d'articles différents : " . $panier->count() . '<br>';
    echo 'Total panier : ' . number_format($panier->getTotal(), 2) . ' €<br>';

    if ($panier->count() === 0) {
        echo '(panier vide)<br><br>';
        return;
    }

    foreach ($panier->items as $nomProduit => $item) {
        echo '- ' . $nomProduit
            . ' | catégorie: ' . $item->product->category->nom
            . ' | prix: ' . number_format($item->product->prix, 2) . ' €'
            . ' | quantité: ' . $item->quantite
            . ' | sous-total: ' . number_format($item->getTotal(), 2) . ' €<br>';
    }

    echo '<br>';
}

$catCreatures = new Category('Créatures');
$catPoudres = new Category('Poudres magiques');

$oeufDragon = new Product('Oeuf de dragon', 12.50, $catCreatures);
$poussiereLicorne = new Product('Poussière de licorne', 4.20, $catPoudres);
$plumePhenix = new Product('Plume de phénix', 7.90, $catCreatures);

$panierMagique = new Cart();

afficherPanier($panierMagique, 'État initial');

$panierMagique->add($oeufDragon, 2);
afficherPanier($panierMagique, 'Après add(Oeuf de dragon, 2)');

$panierMagique->add($poussiereLicorne, 1);
afficherPanier($panierMagique, 'Après add(Poussière de licorne, 1)');

$panierMagique->add($poussiereLicorne, 3);
afficherPanier($panierMagique, 'Après add(Poussière de licorne, 3) (cumul)');

$panierMagique->update('Oeuf de dragon', 1);
afficherPanier($panierMagique, 'Après update(Oeuf de dragon => 1)');

$panierMagique->add($plumePhenix, 2);
afficherPanier($panierMagique, 'Après add(Plume de phénix, 2)');

$panierMagique->remove('Poussière de licorne');
afficherPanier($panierMagique, 'Après remove(Poussière de licorne)');

$panierMagique->update('Plume de phénix', 0);
afficherPanier($panierMagique, 'Après update(Plume de phénix => 0) (suppression)');

$panierMagique->clear();
afficherPanier($panierMagique, 'Après clear()');
