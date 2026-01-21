<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // On vérifie juste si le formulaire est envoyé

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    $errors = []; // Tableau simple pour lister les problèmes

    if (empty($name)) {
        $errors[] = 'Nom requis';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email invalide ou requis';
    }

    if (empty($message) || strlen($message) < 10) {
        $errors[] = 'Message trop court (min 10)';
    }

    if (empty($errors)) {
        echo '<h1>Données reçues :</h1>';
        echo 'Nom : ' . htmlspecialchars($name) . '<br>';
        echo 'Email : ' . htmlspecialchars($email) . '<br>';
        echo 'Message : ' . htmlspecialchars($message) . '<br>';
        exit;         // J'arrête le script ici pour ne pas réafficher le formulaire en dessous
    } else {
        foreach ($errors as $err) {
            echo "<p style='color:red'>$err</p>";
        }
    }
}
?>

<form method="POST">
    Nom : <input type="text" name="name"><br><br>
    Email : <input type="text" name="email"><br><br>
    Message : <textarea name="message"></textarea><br><br>
    <button type="submit">Envoyer</button>
</form>