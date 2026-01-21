<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;   // Protection : si la variable de session n'existe pas, on dégage
}
?>

<!DOCTYPE html>
<html lang="fr">
<body>
    <h1>Bonjour <?php echo $_SESSION['user']; ?> !</h1>
    <p>Bienvenue sur votre espace privé.</p>
    
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
