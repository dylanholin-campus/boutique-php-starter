<?php

class Product
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $category_id;

    public function __construct($id, $name, $description, $price, $stock, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->category_id = $category_id;
    }
}

class ProductRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['stock'],
                $row['category_id']
            );
        }

        return null;
    }

    public function findAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM products');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($rows as $row) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['stock'],
                $row['category_id']
            );
        }

        return $products;
    }

    public function save($product)
    {
        if ($product->id === null) {
            $sql = 'INSERT INTO products (name, description, price, stock, category_id) 
                    VALUES (:name, :desc, :price, :stock, :cat)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'name' => $product->name,
                'desc' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'cat'  => $product->category_id
            ]);

            $product->id = $this->pdo->lastInsertId();     // récupère l'ID créé et on le met dans l'objet
        } else {
            $sql = 'UPDATE products 
                    SET name = :name, description = :desc, price = :price, stock = :stock, category_id = :cat 
                    WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id'    => $product->id,
                'name'  => $product->name,
                'desc'  => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'cat'   => $product->category_id
            ]);
        }
    }
}

$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'dev', 'dev');
$repo = new ProductRepository($pdo);

$monProduit = new Product(null, 'Ecran PC', 'Full HD', 150.00, 10, null); // id est null car on ne le connait pas encore
$repo->save($monProduit);
echo "Produit créé avec l'ID : " . $monProduit->id . '<br>';

$p = $repo->find($monProduit->id);
echo "J'ai récupéré l'objet : " . $p->name;
