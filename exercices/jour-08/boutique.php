<?php
// Classe Category pour une boutique e-commerce
// Propriétés : id (int), name (string), slug (string), description (?string)
// Constructeur avec promotion de propriétés PHP 8
// Méthode generateSlug() qui crée le slug à partir du name
// Getters pour toutes les propriétés
class Category
{
    private int $id;
    private string $name;
    private ?string $description;
    private string $slug;

    public function __construct(int $id, string $name, ?string $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->slug = $this->generateSlug();
    }

    private function generateSlug(): string
    {
        return strtolower(str_replace(' ', '-', $this->name));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
// CategoryRepository avec PDO
// Méthodes : find, findAll, findBySlug, save, update, delete
// Utilise des requêtes préparées
// Retourne des objets Category
class CategoryRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function find(int $id): ?Category
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Category($data['id'], $data['name'], $data['description']) : null;
    }

    /**
     * @return array<Category>
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM categories');
        $categories = [];
        if ($stmt) {
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Category($data['id'], $data['name'], $data['description']);
            }
        }
        return $categories;
    }

    public function findBySlug(string $slug): ?Category
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE slug = :slug');
        $stmt->execute(['slug' => $slug]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Category($data['id'], $data['name'], $data['description']) : null;
    }

    public function save(Category $category): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO categories (name, description, slug) VALUES (:name, :description, :slug)');
        $stmt->execute([
            'name' => $category->getName(),
            'description' => $category->getDescription(),
            'slug' => $category->getSlug()
        ]);
    }

    public function update(Category $category): void
    {
        $stmt = $this->pdo->prepare('UPDATE categories SET name = :name, description = :description, slug = :slug WHERE id = :id');
        $stmt->execute([
            'id' => $category->getId(),
            'name' => $category->getName(),
            'description' => $category->getDescription(),
            'slug' => $category->getSlug()
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
