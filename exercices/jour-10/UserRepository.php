<?php
declare(strict_types=1);

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * Enregistre un nouvel utilisateur.
     * Le mot de passe est hashé automatiquement pour la sécurité.
     */
    public function save(string $nom, string $email, string $password, string $role = 'user'): int
    {
        // On ne stocke jamais le mot de passe en clair !
        // password_hash crée une empreinte sécurisée (ex: $2y$10$Of...)
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare('
            INSERT INTO users (nom, email, password, role) 
            VALUES (:nom, :email, :password, :role)
        ');

        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':password' => $hash, // On envoie le hash dans la BDD
            ':role' => $role
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Cherche un utilisateur par son email.
     * Retourne le tableau des données ou NULL si pas trouvé.
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch();

        // Si fetch() renvoie false, on retourne null, sinon on retourne le tableau
        return $user === false ? null : $user;
    }
}

// -- A. Connexion à la base de données --
// (Vérifie bien ton mot de passe, ici j'ai mis vide "")
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
        'dev',
        'dev',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

$repo = new UserRepository($pdo);
$emailTest = 'test_user@boutique.fr';
$passwordTest = 'MonSuperMotDePasse123';

// -- B. Nettoyage (pour pouvoir rejouer le test sans erreur "Duplicate entry") --
$pdo->exec("DELETE FROM users WHERE email = '$emailTest'");

// -- C. Affichage HTML pour suivre le test --
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test UserRepository</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 2rem auto; padding: 1rem; line-height: 1.6; }
        .success { color: green; font-weight: bold; }
        .fail { color: red; font-weight: bold; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 5px; }
        h3 { border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 30px; }
    </style>
</head>
<body>
    <h1>Test complet UserRepository</h1>

    <h3>1. Création de l'utilisateur (Save)</h3>
    <?php
    try {
        $newId = $repo->save('Utilisateur Test', $emailTest, $passwordTest, 'user');
        echo "<div class='success'>[OK] Utilisateur créé avec l'ID : $newId</div>";
    } catch (Exception $e) {
        echo "<div class='fail'>[ERREUR] " . $e->getMessage() . '</div>';
    }
    ?>

    <h3>2. Récupération (findByEmail)</h3>
    <?php
    $user = $repo->findByEmail($emailTest);

    if ($user) {
        echo "<div class='success'>[OK] Utilisateur trouvé en base !</div>";
        echo '<p>Voici ce qui est stocké en base :</p>';
        echo '<pre>';
        print_r($user);
        echo '</pre>';
    } else {
        echo "<div class='fail'>[ERREUR] L'utilisateur n'a pas été trouvé.</div>";
    }
    ?>

    <h3>3. Simulation de Login (Vérification mot de passe)</h3>
    <?php
    if ($user) {
        // On compare le mot de passe "clair" ($passwordTest) avec le Hash stocké ($user['password'])
        if (password_verify($passwordTest, $user['password'])) {
            echo "<div class='success'>[OK] password_verify a fonctionné : Le mot de passe est valide.</div>";
        } else {
            echo "<div class='fail'>[ERREUR] Mot de passe incorrect.</div>";
        }

        echo "<br>Test avec un mauvais mot de passe ('123456') : ";
        if (password_verify('123456', $user['password'])) {
            echo "<span class='fail'>Aie, il a validé un mauvais mot de passe !</span>";
        } else {
            echo "<span class='success'>[OK] Il a bien rejeté le mauvais mot de passe.</span>";
        }
    }
    ?>
</body>
</html>
