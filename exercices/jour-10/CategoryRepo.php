<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
    'dev',
    'dev',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

class CategoryRepository
{
    public function __construct(private PDO $pdo)
    {
    }


    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public function findAll(): array
    {
        return $this->pdo->query('SELECT * FROM categories')->fetchAll();
    }

    public function save(string $nom): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO categories (nom) VALUES (:nom)');
        $stmt->execute(['nom' => $nom]);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, string $nom): bool
    {
        $stmt = $this->pdo->prepare('UPDATE categories SET nom = :nom WHERE id = :id');
        $stmt->execute(['id' => $id, 'nom' => $nom]);
        return $stmt->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        // Attention : Si la catégorie a des produits, ça plantera (Contrainte Clé Étrangère)
        // Pour faire simple ici, on tente juste de supprimer.
        $stmt = $this->pdo->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }


    /**
     * Récupere toutes les catégories AVEC leurs produits imbriqués.
     * Utilise un LEFT JOIN pour tout prendre en une seule requête.
     */
    public function findWithProducts(): array
    {
        // je renomme les ID pour ne pas confondre id_categorie et id_produit
        $sql = 'SELECT 
                    c.id as cat_id, 
                    c.nom as cat_nom, 
                    p.id as prod_id, 
                    p.name as prod_name, 
                    p.price 
                FROM categories c
                LEFT JOIN products p ON c.id = p.category_id
                ORDER BY c.id';

        $stmt = $this->pdo->query($sql);

        $categories = [];

        while ($row = $stmt->fetch()) {
            $catId = $row['cat_id'];

            if (!isset($categories[$catId])) {      // Si on n'a pas encore créé cette catégorie dans notre tableau final, on l'initie
                $categories[$catId] = [
                    'id' => $catId,
                    'nom' => $row['cat_nom'],
                    'products' => [] // On prépare la liste vide
                ];
            }

            if ($row['prod_id'] !== null) {   // S'il y a un produit sur cette ligne (LEFT JOIN peut renvoyer NULL s'il n'y a pas de produit)
                $categories[$catId]['products'][] = [
                    'id' => $row['prod_id'],
                    'name' => $row['prod_name'],
                    'price' => $row['price']
                ];
            }
        }

        // array_values transforme le tableau associatif [1 => {...}, 5 => {...}] en liste indexée [0 => {...}, 1 => {...}]
        return array_values($categories);
    }
}

function show(string $title, $data): void
{
    echo "<div style='background:#f4f4f4; padding:10px; margin-bottom:10px; border:1px solid #ddd;'>";
    echo "<h3 style='margin-top:0'>{$title}</h3><pre>";
    print_r($data);
    echo '</pre></div>';
}


$repo = new CategoryRepository($pdo);

// Création
$newId = $repo->save('Nouvelle Collection 2026');
show('1. Save : ID généré', $newId);

// Update
$repo->update($newId, 'Collection Été 2026');
show('2. Update : Vérification', $repo->find($newId));

// findWithProducts
$tree = $repo->findWithProducts();
show('3. FindWithProducts : Catégories + Produits', $tree);

// Delete
$repo->delete($newId);
show('4. Delete : Vérif (doit être vide)', $repo->find($newId));
