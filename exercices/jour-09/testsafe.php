<?php
$commentaire = $_POST['commentaire'] ?? '';
$commentaireSafe = htmlspecialchars($commentaire);
$commentaireSafe2 = $commentaire; // a copier pour faire le test : <script>alert('test')</script>
?>

<form method="POST">
    <label>Ton commentaire :</label><br>
    <input type="text" name="commentaire" value="">
    <button type="submit">Envoyer</button>
</form>

<hr>

<h3>Affichage SAFE (protégé)</h3>
<p><?php echo $commentaireSafe; ?></p>

<h3>Affichage PAS SAFE (vulnérable)</h3>
<p><?php echo $commentaireSafe2; ?></p>