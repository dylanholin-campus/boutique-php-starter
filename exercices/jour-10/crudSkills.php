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

            $product->id = $this->pdo->lastInsertId();
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

    // AJOUT NECESSAIRE POUR CRUD COMPLET : DELETE
    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}

// ====== Connexion + Repository (injection PDO) ======
$pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8mb4', 'dev', 'dev');
$repo = new ProductRepository($pdo);

// ====== Variables d'affichage ======
$message = null;
$found = null;
$all = null;

// Petits helpers d’affichage (optionnel)
function e($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// ====== Traitement des actions CRUD via POST ======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $name = $_POST['name'] ?? 'Ecran PC';
        $description = $_POST['description'] ?? 'Full HD';
        $price = (float)($_POST['price'] ?? 150.00);
        $stock = (int)($_POST['stock'] ?? 10);
        $category_id = $_POST['category_id'] === '' ? null : (int)($_POST['category_id'] ?? 0);

        $product = new Product(null, $name, $description, $price, $stock, $category_id);
        $repo->save($product);

        $message = "CREATE OK — Produit créé avec l'ID : " . $product->id;
        $found = $repo->find($product->id);
    }

    if ($action === 'find') {
        $id = (int)($_POST['id'] ?? 0);
        $found = $repo->find($id);
        $message = $found ? "READ (find) OK — Produit trouvé (id=$id)." : "READ (find) — Aucun produit trouvé (id=$id).";
    }

    if ($action === 'findAll') {
        $all = $repo->findAll();
        $message = 'READ (findAll) OK — ' . count($all) . ' produit(s) chargé(s).';
    }

    if ($action === 'update') {
        $id = (int)($_POST['id'] ?? 0);

        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = (float)($_POST['price'] ?? 0);
        $stock = (int)($_POST['stock'] ?? 0);
        $category_id = $_POST['category_id'] === '' ? null : (int)($_POST['category_id'] ?? 0);

        // Option simple : on reconstruit un Product avec l'id et les champs du formulaire
        $product = new Product($id, $name, $description, $price, $stock, $category_id);
        $repo->save($product);

        $message = "UPDATE OK — Produit mis à jour (id=$id).";
        $found = $repo->find($id);
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $repo->delete($id);
        $message = "DELETE OK — Tentative de suppression du produit (id=$id).";
        $found = null;
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Products - Repository</title>

    <!-- Bootstrap 5 (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-4">

    <h1 class="mb-3">Test CRUD (Repository)</h1>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= e($message) ?></div>
    <?php endif; ?>

    <div class="row g-3">
        <!-- CREATE -->
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Create (INSERT)</div>
                <div class="card-body">
                    <form method="post" class="row g-2">
                        <input type="hidden" name="action" value="create">

                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input class="form-control" name="name" value="Ecran PC">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <input class="form-control" name="description" value="Full HD">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Price</label>
                            <input class="form-control" name="price" value="150">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Stock</label>
                            <input class="form-control" name="stock" value="10">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Category ID (optionnel)</label>
                            <input class="form-control" name="category_id" value="">
                        </div>

                        <div class="col-12">
                            <button class="btn btn-success w-100" type="submit">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- READ ONE + DELETE -->
        <div class="col-12 col-lg-6">
            <div class="card mb-3">
                <div class="card-header">Read (find) + Delete</div>
                <div class="card-body">
                    <form method="post" class="row g-2 mb-3">
                        <input type="hidden" name="action" value="find">
                        <div class="col-8">
                            <label class="form-label">ID</label>
                            <input class="form-control" name="id" placeholder="ex: 1">
                        </div>
                        <div class="col-4 d-flex align-items-end">
                            <button class="btn btn-primary w-100" type="submit">Lire</button>
                        </div>
                    </form>

                    <form method="post" class="row g-2">
                        <input type="hidden" name="action" value="delete">
                        <div class="col-8">
                            <label class="form-label">ID</label>
                            <input class="form-control" name="id" placeholder="ex: 1">
                        </div>
                        <div class="col-4 d-flex align-items-end">
                            <button class="btn btn-danger w-100" type="submit">Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- FIND ALL -->
            <div class="card">
                <div class="card-header">Read (findAll)</div>
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="action" value="findAll">
                        <button class="btn btn-secondary w-100" type="submit">Lister tous les produits</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- UPDATE -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">Update (UPDATE via save)</div>
                <div class="card-body">
                    <form method="post" class="row g-2">
                        <input type="hidden" name="action" value="update">

                        <div class="col-12 col-md-2">
                            <label class="form-label">ID</label>
                            <input class="form-control" name="id" placeholder="ex: 1" required>
                        </div>

                        <div class="col-12 col-md-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" name="name" placeholder="Nouveau nom" required>
                        </div>

                        <div class="col-12 col-md-3">
                            <label class="form-label">Description</label>
                            <input class="form-control" name="description" placeholder="Nouvelle description" required>
                        </div>

                        <div class="col-6 col-md-2">
                            <label class="form-label">Price</label>
                            <input class="form-control" name="price" placeholder="ex: 199.99" required>
                        </div>

                        <div class="col-6 col-md-2">
                            <label class="form-label">Stock</label>
                            <input class="form-control" name="stock" placeholder="ex: 5" required>
                        </div>

                        <div class="col-12 col-md-2">
                            <label class="form-label">Category ID</label>
                            <input class="form-control" name="category_id" placeholder="optionnel">
                        </div>

                        <div class="col-12">
                            <button class="btn btn-warning w-100" type="submit">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Résultat find -->
        <div class="col-12">
            <?php if ($found): ?>
                <div class="card">
                    <div class="card-header">Résultat find()</div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>ID: <?= e($found->id) ?></li>
                            <li>Name: <?= e($found->name) ?></li>
                            <li>Description: <?= e($found->description) ?></li>
                            <li>Price: <?= e($found->price) ?></li>
                            <li>Stock: <?= e($found->stock) ?></li>
                            <li>Category ID: <?= e($found->category_id) ?></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Résultat findAll -->
        <div class="col-12">
            <?php if (is_array($all)): ?>
                <div class="card">
                    <div class="card-header">Résultat findAll()</div>
                    <div class="card-body table-responsive">
                        <table class="table table-sm table-striped mb-0">
                            <thead>
                            <tr>
                                <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Stock</th><th>Category</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all as $p): ?>
                                <tr>
                                    <td><?= e($p->id) ?></td>
                                    <td><?= e($p->name) ?></td>
                                    <td><?= e($p->description) ?></td>
                                    <td><?= e($p->price) ?></td>
                                    <td><?= e($p->stock) ?></td>
                                    <td><?= e($p->category_id) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
