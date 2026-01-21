<?php

class ProductRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT id, name, price FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public function findAll(): array
    {
        return $this->pdo->query('SELECT id, name, price FROM products')->fetchAll();
    }

    public function findByCategory(int $categoryId): array     /*Trouve tous les produits d'une catégorie donnée (par ID de catégorie)*/
    {
        $stmt = $this->pdo->prepare('
            SELECT p.id, p.name, p.price 
            FROM products p 
            INNER JOIN categories c ON p.category_id = c.id 
            WHERE c.id = :category_id
        ');
        $stmt->execute(['category_id' => $categoryId]);
        return $stmt->fetchAll();
    }

    public function findInStock(): array  /* Trouve les produits en stock (suppose une colonne stock INT dans products)*/
    {                                          /*Trouve les produits en stock (suppose une colonne stock INT dans products)*/
        $stmt = $this->pdo->prepare('SELECT id, name, price FROM products WHERE stock > 0');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findByPriceRange(float $min, float $max): array /*Trouve les produits dans une fourchette de prix*/
    {
        $stmt = $this->pdo->prepare('SELECT id, name, price FROM products WHERE price BETWEEN :min AND :max');
        $stmt->execute(['min' => $min, 'max' => $max]);
        return $stmt->fetchAll();
    }

    public function search(string $term): array     /*Recherche des produits par nom (recherche partielle avec LIKE)*/
    {
        $stmt = $this->pdo->prepare('SELECT id, name, price FROM products WHERE name LIKE :term');
        $stmt->execute(['term' => '%' . $term . '%']);
        return $stmt->fetchAll();
    }
}


$pdo = new PDO(
    'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
    'dev',
    'dev',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

$repo = new ProductRepository($pdo);

function show(string $title, $data): void
{
    echo "<h3>{$title}</h3><pre>";
    print_r($data);
    echo '</pre>';
}

show('findAll()', $repo->findAll()); // Tests des nouvelles méthodes (adapte les IDs selon tes données)

echo '<h3>find(1)</h3><pre>';
print_r($repo->find(1));
echo '</pre>';

show('findByCategory(1) - Vêtements', $repo->findByCategory(1));
show('findByPriceRange(10, 50)', $repo->findByPriceRange(10, 50));
show("search('test')", $repo->search('test'));
show('findInStock()', $repo->findInStock());
