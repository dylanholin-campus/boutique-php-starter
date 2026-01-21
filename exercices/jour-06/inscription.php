<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirmation'] ?? '';

    if (strlen($username) < 3 || strlen($username) > 20 || !ctype_alnum($username)) {
        $errors['username'] = 'Username invalide (3-20 caractères alphanumériques)';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email invalide';
    }

    if (strlen($password) < 8) {
        $errors['password'] = 'Mot de passe trop court (min 8)';
    }

    if ($password !== $confirm) {
        $errors['confirm'] = 'Confirmation incorrecte';
    }

    if (empty($errors)) {
        echo '<h1>Inscription OK</h1>';
        exit;
    }
}
?>

<form method="POST">

    Username : <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">

    <!-- Affiche erreur si existe -->
    <?php if (isset($errors['username'])) {
    echo "<br><span style='color:red'>" . $errors['username'] . '</span>';
} ?>
    <br><br>

    Email : <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <?php if (isset($errors['email'])) {
    echo "<br><span style='color:red'>" . $errors['email'] . '</span>';
} ?>
    <br><br>

    Password : <input type="password" name="password">
    <?php if (isset($errors['password'])) {
    echo "<br><span style='color:red'>" . $errors['password'] . '</span>';
} ?>
    <br><br>

    Confirmation : <input type="password" name="confirmation">
    <?php if (isset($errors['confirm'])) {
    echo "<br><span style='color:red'>" . $errors['confirm'] . '</span>';
} ?>
    <br><br>

    <button type="submit">Envoyer</button>
</form>