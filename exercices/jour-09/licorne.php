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
    public $category;

    public function __construct($nom, $category)
    {
        $this->nom = $nom;
        $this->category = $category;
    }
}

$categorie1 = new Category('Peluches Licornes');
$categorie2 = new Category('Accessoires Magiques');
$categorie3 = new Category('Décorations Licornes');

$produit1 = new Product('Licorne Rose en Peluche', $categorie1);
$produit2 = new Product('Licorne Arc-en-ciel', $categorie1);
$produit3 = new Product('Baguette Magique Licorne', $categorie2);
$produit4 = new Product('Poster Licorne Étoilée', $categorie3);
$produit5 = new Product('Couronne de Licorne', $categorie2);
$produit6 = new Product('sceptre du chao Licorne', $categorie2);

echo '<br>Produit : ' . $produit1->nom . ' - Catégorie : ' . $produit1->category->nom . '<br><br>';
echo 'Produit : ' . $produit2->nom . ' - Catégorie : ' . $produit2->category->nom . '<br><br>';
echo 'Produit : ' . $produit3->nom . ' - Catégorie : ' . $produit3->category->nom . '<br><br>';
echo 'Produit : ' . $produit4->nom . ' - Catégorie : ' . $produit4->category->nom . '<br><br>';
echo 'Produit : ' . $produit5->nom . ' - Catégorie : ' . $produit5->category->nom . '<br><br>';
echo 'Produit : ' . $produit6->nom . ' - Catégorie : ' . $produit6->category->nom . '<br><br>';
