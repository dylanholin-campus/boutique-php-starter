<?php

class Category
{
    public $id;
    public $nom;
    public $description;

    public function __construct($id, $nom, $description)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
    }

    public function getSlug()
    {
        return strtolower(str_replace(' ', '-', $this->nom));
    }
}

$categories = [
    new Category(1, 'Électronique Grand Public', 'Produits électroniques pour la maison'),
    new Category(2, 'Accessoires Informatiques', 'Souris, claviers, câbles et accessoires'),
    new Category(3, 'Périphériques Audio Vidéo', 'Casques, haut-parleurs et moniteurs')
];

foreach ($categories as $cat) {
    echo '<br>';
    echo "<br>ID: {$cat->id} | Nom: {$cat->nom} | Slug: {$cat->getSlug()}";
}
