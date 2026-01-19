On crée un Repository pour isoler l’accès aux données (SQL, PDO, requêtes) du reste de l’application, 
afin que le code “métier” (logique de l’app) ne soit pas mélangé avec la base de données. 
Concrètement, au lieu d’écrire des SELECT/INSERT partout (dans tes pages, contrôleurs, etc.), 
tu centralises ça dans des classes dédiées : plus lisible, plus simple à maintenir, et plus facile à tester.

Pourquoi on le crée ?

    Séparation des responsabilités : le contrôleur gère la requête HTTP et choisit quoi faire, le repository gère comment lire/écrire en base.

    Réutilisation : la requête “trouver un user par email” est à un seul endroit, pas copiée 5 fois.

    Maintenance : si tu changes la structure de la table, ou une requête, tu modifies un seul fichier.

    Tests plus simples : tu peux tester ta logique métier en “simulant” le repository (mock) sans toucher une vraie base.

À quoi ça ressemble en PHP ?

En général, un repository correspond à une “entité” (User, Product, Category).
Exemple minimaliste d’un UserRepository qui utilise PDO :

<?php

class UserRepository
{
    public function __construct(private PDO $pdo) {}

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT id, nom, email, role, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT id, nom, email, role, created_at FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function create(string $nom, string $email, string $passwordHash, string $role = 'user'): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (nom, email, password, role, created_at)
            VALUES (:nom, :email, :password, :role, NOW())
        ");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'password' => $passwordHash,
            'role' => $role,
        ]);

        return (int)$this->pdo->lastInsertId();
    }
}



Comment ça s’utilise (dans un contrôleur, par exemple)
L’idée : ton contrôleur ne connaît pas le SQL, il appelle juste des méthodes “humaines” :


$pdo = Database::getInstance();
$userRepo = new UserRepository($pdo);

$users = $userRepo->findAll();