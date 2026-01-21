<?php
session_start();

if (isset($_GET['reset'])) {
    $_SESSION['visits'] = 0;
}

if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 0;
}
$_SESSION['visits']++;


echo '<br>Vous avez visité cette page ' . $_SESSION['visits'] . ' fois';
?>
<br>
<br>
<a href="?reset=1"> - Réinitialiser</a>
<br>
<br>
<a href="http://localhost:8000/exercices/jour-07/compteur.php"> - smash</a>
<br>
<br>
<ul>Que se passe-t-il si tu ouvres la page dans un autre navigateur ?</ul>
<li> compteur repart à 1.</li>
<li> Les sessions fonctionnent grâce à un identifiant unique (le PHPSESSID) stocké dans un cookie sur ton navigateur.</li>
<li> Comme Chrome et Firefox ne partagent pas leurs cookies, pour le serveur, ce sont deux visiteurs totalement différents</li>
<br>
<br>
<ul>Que se passe-t-il si tu fermes et rouvres ton navigateur ?</ul>
<li> En théorie, le compteur repart à 1.</li>
<li> Par défaut, le cookie de session est configuré pour s'autodétruire à la fermeture du navigateur.</li>
<li> Note : Les navigateurs modernes (comme Chrome ou Edge) ont souvent une option "Reprendre où vous vous êtes arrêté" activée par défaut.</li>
<li> Dans ce cas précis, ils peuvent "tricher" et garder la session active même après fermeture pour améliorer l'expérience utilisateur</li>