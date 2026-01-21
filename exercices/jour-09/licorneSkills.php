<?php

declare(strict_types=1);

final class Category
{
    private string $name;

    private array $products = []; // contiendra des Product

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}

final class Product
{
    private string $name;
    private Category $category;

    public function __construct(string $name, Category $category)
    {
        $this->name = $name;
        $this->category = $category;

        $category->addProduct($this);         // interaction : le produit s'ajoute dans la catégorie
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}

$peluches = new Category('Peluches Licornes');
$accessoires = new Category('Accessoires Magiques');

new Product('Licorne Rose en Peluche', $peluches);
new Product('Couronne de Licorne', $accessoires);

foreach ([$peluches, $accessoires] as $category) {
    echo '<h3>Catégorie : ' . htmlspecialchars($category->getName()) . '</h3>';
    foreach ($category->getProducts() as $product) {
        echo 'Produit : ' . htmlspecialchars($product->getName()) . '<br>';
    }
}
