<?php
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    // Traite la connexion de l'utilisateur
    if ($_POST['username'] === 'admin' && $_POST['password'] === '1234') {
        $_SESSION['user'] = $_POST['username'];
        header('Location: dashboard.php');
        exit; // Important : arrête le script après la redirection
    } else {
        $message = 'Identifiants incorrects';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <h1>Connexion</h1>
    <?php if ($message) {
    echo "<p style='color:red'>$message</p>";
} ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
    </form>
</body>

</html>