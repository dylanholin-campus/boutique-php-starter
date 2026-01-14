<?php
// config/database.php

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=boutique;charset=utf8mb4",
        "dev", // Votre utilisateur
        "dev", // Votre mot de passe
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les erreurs
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode tableau associatif par défaut
        ]
    );
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}
?>
