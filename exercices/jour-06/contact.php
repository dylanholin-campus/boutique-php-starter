<?php
// Initialisation des variables pour réafficher les saisies en cas d'erreur
$name = $email = $message = "";
$errors = [];
$success = false;

// Vérification si le formulaire a été soumis en méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Récupération et nettoyage basique des entrées
    // L'opérateur null coalescent (??) évite les erreurs si le champ est manquant
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // 2. Validations

    // Validation du Nom (Requis)
    if (empty($name)) {
        $errors[] = "Le champ 'Nom' est requis.";
    }

    // Validation de l'Email (Requis + Format valide)
    if (empty($email)) {
        $errors[] = "Le champ 'Email' est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // filter_var est la méthode standard et sécurisée pour valider un email
        $errors[] = "L'adresse email n'est pas valide.";
    }

    // Validation du Message (Requis + Longueur min 10 car.)
    if (empty($message)) {
        $errors[] = "Le champ 'Message' est requis.";
    } elseif (mb_strlen($message) < 10) {
        // mb_strlen compte les caractères réels (utf-8) et non les octets
        $errors[] = "Le message doit contenir au moins 10 caractères.";
    }

    // 3. Affichage ou Gestion des erreurs
    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire de Contact</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 600px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .error {
            color: red;
            margin-bottom: 1rem;
        }

        .success {
            color: green;
            background: #e8f5e9;
            padding: 1rem;
            border: 1px solid #c8e6c9;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: .5rem;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: .5rem;
            box-sizing: border-box;
        }

        button {
            padding: .7rem 1.5rem;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

    <?php if ($success): ?>
        <div class="success">
            <h2>Message envoyé avec succès !</h2>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Message :</strong> <?php echo nl2br(htmlspecialchars($message)); ?></p>
        </div>
        <p><a href="">Retour au formulaire</a></p>
    <?php else: ?>

        <?php
        // Affichage des erreurs s'il y en a
        if (!empty($errors)) {
            echo '<div class="error"><ul>';
            foreach ($errors as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul></div>';
        }
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Nom :</label>
                <!-- htmlspecialchars() ici protège contre les XSS si on réaffiche une valeur malveillante -->
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>

            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5"><?php echo htmlspecialchars($message); ?></textarea>
            </div>

            <button type="submit">Envoyer</button>
        </form>

    <?php endif; ?>

</body>

</html>