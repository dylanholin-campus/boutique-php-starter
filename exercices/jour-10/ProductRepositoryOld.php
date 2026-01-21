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

echo '<h3>findAll()</h3><pre>';
print_r($repo->findAll());
echo '</pre>';

echo '<h3>find(1)</h3><pre>';
print_r($repo->find(1));
echo '</pre>';
