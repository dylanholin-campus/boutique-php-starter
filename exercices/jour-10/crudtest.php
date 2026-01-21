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
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public function findAll(): array
    {
        return $this->pdo->query('SELECT id, name, price FROM products')->fetchAll();
    }

    public function save(string $name, float $price): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO products (name, price) VALUES (:name, :price)');
        $stmt->execute(['name' => $name, 'price' => $price]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, string $name, float $price): bool
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $stmt = $this->pdo->prepare(
            'UPDATE products SET name = ?, price = ? WHERE id = ?'
        );
        //var_dump($stmt);
        $result = $stmt->execute([$name, $price, $id]);
        //echo "$name";
        //var_dump($this->pdo->errorInfo());
        if ($result) {
            echo 'vrai';
        } else {
            echo 'faux';
        }
        return $stmt->rowCount() > 0;         // rowCount = nb de lignes affectées par UPDATE/DELETE/INSERT
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }
}

function show(string $title, $data): void
{
    echo "<h3>{$title}</h3><pre>";
    print_r($data);
    echo '</pre>';
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

$newId = $repo->save('Produit test', 9.99); // Créer
show("Après save() (id = $newId)", $repo->find($newId));

$repo->update($newId, 'Produit test MODIF', 19.99); // Modifier
show('Après update()', $repo->find($newId));

//$repo->delete($newId); // Supprimer
//show("Après delete() => find(id) doit être null", $repo->find($newId));

show('findAll()', $repo->findAll()); // voir tout
