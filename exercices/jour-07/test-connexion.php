<?php

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=boutique;charset=utf8mb4',
        'dev',
        'dev',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo '✅ Connexion réussie !';
} catch (PDOException $e) {
    echo '❌ Erreur : ' . $e->getMessage();
}
